<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            '01HHV4RXY3XFPQRCD7P67NCJ6R.jpg',
            '01HHV4XBQDE4J3G7QGT3KG0FY8.jpg',
            '01HHV4ZT437WS5PPW0V88CHEKE.jpg',
            '01HHV573Q821BKBMCP8Q4ZGS8W.jpg',
            '01HHV4C6ZSFYT15AJXJBGBVFPT.jpg',
            '01HHV4E8Y57TTEP8ECFXTQT88F.jpg',
            '01HHV549CFEQ6T2QZZPFWQ3V3G.jpg',
            '01HJ9CYDT9FZBA0EJP7MM505YG.jpg',
            '01HJ9DD01YVQDQG4Q8YRQG9M3K.jpg',
            '01HJ9HTB6QQEDMFHETCVQ6MYZ0.jpg',
        ];
        $randomKey = array_rand($images);
        $imageUrl = $images[$randomKey];
        $title = fake()->realText(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'thumbnail' => $imageUrl,
            'body' => fake()->realText(5000),
            'active' => fake()->boolean,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}