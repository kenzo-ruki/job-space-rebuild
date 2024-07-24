<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\JobCategory;
use App\Models\JobSubCategory;
use App\Models\JobType;
use App\Models\Country;
use App\Models\Zone;
use App\Models\City;
use App\Utilities\Sanitizer;
use App\Utilities\RecruiterCredits;
use SimpleXMLElement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class JobsImport
{
    const JOBTYPEMAP = [
        "Full time" => 1,
        "Part time" => 2,
        "Contractor" => 3,
        "Permanent" => 4,
        "Temporary" => 5,
        "Fixed term" => 6,
        "Casual" => 7,
        "Contractor" => 8,
    ];

    public function importFromDirectory(string $directoryPath, Command $command)
    {
        if (!is_dir($directoryPath)) {
            $command->error("Directory does not exist: {$directoryPath}");
            Log::channel('jobadder')->error("Directory does not exist: {$directoryPath}");
            return;
        }

        $command->line("Directory: {$directoryPath}");
        $files = glob($directoryPath . '/*');
        $command->line("Found " . count($files) . " files");

        foreach ($files as $file) {
            $this->importFromFile($file, $command);
        }
    }

    public function importFromFile(string $filePath, Command $command)
    {
        try {
            $xml = new SimpleXMLElement(file_get_contents($filePath));
            $email = (string) $xml['username'];
            $recruiter = Recruiter::where('recruiter_email_address', $email)->first();
            if (!$recruiter) {
                $user = User::where('email', $email)->first();
                if (!$user) {
                    $command->error("Recruiter with email {$email} does not exist.");
                    Log::channel('jobadder')->error("User with email {$email} does not exist.");
                    return;
                }
                $recruiter = Recruiter::where('id', $user->recruiter_id)->first();
            }
        
            if (!$recruiter) {
                $command->error("Recruiter with email: {$recruiter->recruiter_email_address} does not exist.");
                Log::channel('jobadder')->error("Recruiter with email: {$recruiter->recruiter_email_address} does not exist.");
                return;
            }
        
            $command->line("Recruiter: {$recruiter->recruiter_email_address}");
            $command->line("Email: {$email}");
            $jobCount = 0;
            foreach ($xml->Job as $jobData) {
                    // Check if the recruiter has job credits
                if (RecruiterCredits::hasJobCredits($recruiter)) {
                    // Deduct a job credit
                    RecruiterCredits::deductJobCredit($recruiter);
                    $jobCount++;
                } else {
                    $command->error("Recruiter with email: {$recruiter->recruiter_email_address} has no job credits left.");
                    Log::channel('jobadder')->error("Recruiter with email: {$recruiter->recruiter_email_address} has no job credits left.");
                    break;
                }
                $ja_id = trim((string) $jobData['jid']);
                if (Job::where('job_reference', $ja_id)->exists()) {
                    $command->error("Job already created for ID: {$ja_id}");
                    Log::channel('jobadder')->error("Job already created for ID: {$ja_id}");
                    continue;
                }
                $job = new Job();
                $sal_MinValue = trim((string) $jobData->Salary->MinValue);
                $sal_MaxValue = trim((string) $jobData->Salary->MaxValue);
                $sal_period = trim((string) $jobData->Salary->Text);
                $job->display_id = $ja_id;
                $job->job_reference = $ja_id;
                $job->recruiter_id = $recruiter->recruiter_id;
                $job->job_source = 'jobadder';
                $job->created_at = trim((string) $jobData['datePosted']);
                $job->updated_at = trim((string) $jobData['dateUpdated']);
                // Set re_adv to now
                $job->re_adv = Carbon::now();
                // Set expired to 35 days from now
                $job->expired = Carbon::now()->addDays(30);
                $job->job_title = trim((string) $jobData->Title);
                $job->job_description = (string) Sanitizer::HTML($jobData->Description);
                $job->job_short_description = strip_tags((string) Sanitizer::HTML($jobData->Summary));
                $job->job_short_description = html_entity_decode(
                    strip_tags(
                        (string) Sanitizer::HTML($jobData->Summary)
                    ),
                    ENT_QUOTES | ENT_HTML401,
                    'ISO-8859-1'
                );
                $job->salary_from = trim((string) $jobData->Salary->MinValue);
                $job->salary_to = trim((string) $jobData->Salary->MaxValue);
                $job->salary_description = $sal_MinValue.' - '.$sal_MaxValue.' '.$sal_period;
                //TODO add in for live site
                //$job->job_email_to = trim((string) $jobData->Apply->EmailTo); // Get email from Apply->EmailTo
                $job->job_email_to = 'seth@jobspace.co.nz'; // Get email from Apply->EmailTo
                $job->url = trim((string) $jobData->Apply->Url);
                $job->job_featured = (RecruiterCredits::hasFeatured($recruiter)) ? 'Yes' : 'No';

                // Find and assign country
                $country = Country::where('name', $this->getClassificationValue($jobData->Classifications, 'Allowed Countries'))->first();
                if ($country) {
                    $job->job_country_id = $country->id;
                }

                // Find and assign zone (region)
                $regionValue = trim($this->getClassificationValue($jobData->Classifications, 'Region'));
                $zone = Zone::where('zone_name', 'like', '%' . $regionValue . '%')->first();
                if ($zone) {
                    $job->job_state_id = $zone->zone_id;
                }

                // Find and assign city
                $locationValue = trim($this->getClassificationValue($jobData->Classifications, 'Location'));
                $city = City::where('city_name', 'like', $locationValue . '%')->first();
                if ($city) {
                    $job->job_city_id = $city->city_id;
                }

                // Handle job types
                $jobTypes = $this->getClassificationValues($jobData->Classifications, 'Job Types');
                if (is_array($jobTypes)) {
                    $mappedJobTypes = array_map(function ($jobType) {
                        return self::JOBTYPEMAP[$jobType] ?? $jobType;
                    }, $jobTypes);
                    $job->job_type = count($mappedJobTypes) > 1 ? implode(', ', $mappedJobTypes) : $mappedJobTypes[0];
                } else {
                    $job->job_type = self::JOBTYPEMAP[$jobTypes] ?? $jobTypes;
                }

                Log::channel('jobadder')->info($job->toJson());
                
                // Save the job
                $job->save();

                // Find and assign job category
                $jobCategory = JobCategory::where('category_name', $this->getClassificationValue($jobData->Classifications, 'Category'))->first();
                if ($jobCategory) {
                    $job->jobCategories()->attach($jobCategory->id);
                }

                // Find and assign job sub-category
                $jobSubCategory = JobSubCategory::where('sub_category_name', $this->getClassificationValue($jobData->Classifications, 'Sub Category'))->first();
                if ($jobSubCategory) {
                    $job->jobSubCategories()->attach($jobSubCategory->id);
                }

                $jobCount++;
            }
            Log::channel('jobadder')->info("{$jobCount} jobs added for Recruiter: {$recruiter->recruiter_email_address}");
        } catch (\Exception $e) {
            $command->error("Could not parse file as XML: {$filePath}");
            $command->error("Error: " . $e->getMessage());
            Log::channel('jobadder')->error('Could not parse file as XML: ' . $filePath);
            Log::channel('jobadder')->error('Error: ' . $e->getMessage());
            return;
        }
    }

    private function getClassificationValue($classifications, $name)
    {
        foreach ($classifications->Classification as $classification) {
            if ((string) $classification['name'] === $name) {
                // Trim the value to remove trailing whitespace
                $value = str_replace("\xc2\xa0", '', (string) $classification);
                $value = trim((string) $value);
                
                // If the value contains " - ", take only the part before it
                if (strpos($value, ' - ') !== false) {
                    $value = explode(' - ', $value)[0];
                }
                Log::channel('jobadder')->info( $name . ': ' . $value);
    
                return $value;
            }
        }
        return null;
    }
    
    private function getClassificationValues($classifications, $name)
    {
        $values = [];
        foreach ($classifications->Classification as $classification) {
            if ((string) $classification['name'] === $name) {
                // Trim the value to remove trailing whitespace
                $value = trim((string) $classification);
    
                // If the value contains " - ", take only the part before it
                if (strpos($value, ' - ') !== false) {
                    $value = explode(' - ', $value)[0];
                }
    
                $values[] = $value;
            }
        }
        return $values;
    }

    public function prettyDump(SimpleXMLElement $xml, Command $command)
    {
        // Pretty print XML data
        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $prettyXml = $dom->saveXML();
    
        $command->line($prettyXml);
        die();

    }
}
