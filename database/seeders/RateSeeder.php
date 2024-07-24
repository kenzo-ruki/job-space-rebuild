<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rates = [
            [
                'plan_type_name' => 'Single Job - Standard',
                'time_period_months' => 1,
                'fee' => 157.00,
                'number_of_postable_jobs' => 1,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 7,
                'plan_description' => "One job posting credit should be utilized within 30 days from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => 'Single Job - Featured',
                'time_period_months' => 1,
                'fee' => 237.00,
                'number_of_postable_jobs' => 1,
                'jobs_show_as_featured' => true,
                'search_cvs' => 0,
                'priority' => 8,
                'plan_description' => "One featured job posting credit should be utilized within 30 days from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Featured jobs are displayed on the Homepage under featured jobs
                Featured jobs are marked with a Hot job tag, thus making them stand out in the list of jobs.
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => '3 Job Pack',
                'time_period_months' => 12,
                'fee' => 456.00,
                'number_of_postable_jobs' => 3,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 2,
                'plan_description' => "A pack of 5 Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => '5 Job Pack',
                'time_period_months' => 12,
                'fee' => 745.00,
                'number_of_postable_jobs' => 5,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 3,
                'plan_description' => "A pack of 3 Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => '10 Job Pack',
                'time_period_months' => 12,
                'fee' => 1413.00,
                'number_of_postable_jobs' => 10,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 4,
                'plan_description' => "A pack of 10 Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => '25 Job Pack',
                'time_period_months' => 12,
                'fee' => 3140.00,
                'number_of_postable_jobs' => 25,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 5,
                'plan_description' => "A pack of 25 Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => '50 Job Pack',
                'time_period_months' => 12,
                'fee' => 5887.00,
                'number_of_postable_jobs' => 50,
                'jobs_show_as_featured' => false,
                'search_cvs' => 0,
                'priority' => 6,
                'plan_description' => "A pack of 50 Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.",
            ],
            [
                'plan_type_name' => 'Annual Standard Subscription',
                'time_period_months' => 12,
                'fee' => 1597.00,
                'number_of_postable_jobs' => -1,
                'jobs_show_as_featured' => false,
                'search_cvs' => 100,
                'priority' => 1,
                'plan_description' => "100% Money back guarantee at the end of your term.
                Unlimited Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.
                Please Note:You cannot use the Annual Membership to advertise for named third parties - if you want to do that we suggest you look at the discounted Job Packs",
            ],
            [
                'plan_type_name' => 'Annual Featured Subscription',
                'time_period_months' => 12,
                'fee' => 3997.00,
                'number_of_postable_jobs' => -1,
                'jobs_show_as_featured' => false,
                'search_cvs' => 200,
                'priority' => 0,
                'plan_description' => "100% Money back guarantee at the end of your term.
                Unlimited Job posting credits should be utilized within 12 months from the day of activation/purchase.
                The job will remain active /visible for 36 days.
                Promote your company logo on the #1 New Zealand-owned job site. 
                Manage your job from your account: preview, edit, duplicate, and delete options are available.
                Use a screening questionnaire to define the best candidate.
                Add photos and videos to your listing and the company profile.
                Ability to shortlist or view candidate details.
                Ability to download candidate resumes.
                Request letters confirming Advertising for use with Visa applications.
                Please Note:You cannot use the Annual Membership to advertise for named third parties - if you want to do that we suggest you look at the discounted Job Packs",
            ],
        ];

        foreach ($rates as $rate) {
            Rate::create($rate);
        }
    }
}
