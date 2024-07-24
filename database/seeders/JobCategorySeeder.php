<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategories = [
            [74, 'Trades & Services'],
            [73, 'Tourism & Leisure'],
            [72, 'Science & Technology'],
            [71, 'Sales'],
            [70, 'Retail'],
            [69, 'Property'],
            [68, 'Office & Administration'],
            [67, 'Marketing, Media & Communications'],
            [66, 'Manufacturing & Operations'],
            [65, 'Legal'],
            [64, 'IT'],
            [63, 'HR & Recruitment'],
            [62, 'Hospitality & Tourism'],
            [61, 'Healthcare'],
            [60, 'Haurapa Mahi- Maori Language Job Search'],
            [59, 'Government & Council'],
            [58, 'Fashion & Beauty'],
            [57, 'Executive & General Management'],
            [56, 'Engineering'],
            [55, 'Energy'],
            [54, 'Education'],
            [53, 'Driving'],
            [52, 'Customer Service'],
            [51, 'Construction'],
            [50, 'Business Opportunities'],
            [49, 'Banking, Finance & Insurance'],
            [48, 'Automotive'],
            [47, 'Arts & Entertainment'],
            [46, 'Architecture & Design'],
            [45, 'Animal Welfare'],
            [44, 'Agriculture, Fishing & Forestry'],
            [43, 'Accounting'],
            [75, 'Transport & logistics'],
            [76, 'Volunteers'],
            [77, 'Xrated- R18'],
        ];

        foreach ($jobCategories as $jobCategory) {
            JobCategory::create([
                'id' => $jobCategory[0],
                'category_name' => $jobCategory[1],
            ]);
        }
    }
}
