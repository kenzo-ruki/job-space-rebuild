<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotifySubmission>
 */
class NotifySubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // TODO - wire to main categories etc
        $category   = [0, 1, 2, 3, 4, 5, 6, 11];
        $occupation = range(43, 77);
        $location   = [
            'region-138',
            'region-139',
            'region-140',        
            'region-141',
            'region-142',
            'region-143',
            'region-144',
            'region-145',
            'region-146',
            'region-147',
            'region-148',
            'region-149',
            'region-150',
            'region-151',
            'region-152',      
            'region-153',
            'region-154',
            'country-13a'
        ];
        return [
            'email' => fake()->email(),
            'frequency' => fake()->randomElement(['daily', 'weekly', 'monthly']),
            'category' => fake()->randomElement($category),
            'occupation' => fake()->randomElement($occupation),
            'location' => fake()->randomElement($location),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
