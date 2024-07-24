<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition()
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
        $testimonial = $this->faker->realText(80);

        return [
            'name' => $this->faker->name(),
            'company' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'testimonial' => $testimonial,
            'company_photo_path' => $imageUrl,
        ];
    }
}
