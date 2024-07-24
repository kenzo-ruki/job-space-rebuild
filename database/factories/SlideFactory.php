<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Slide;

class SlideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slide::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->word(),
            'header' => $this->faker->word(),
            'text' => $this->faker->word(),
            'link' => $this->faker->word(),
        ];
    }
}
