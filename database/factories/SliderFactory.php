<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $bool = $this->faker->boolean();
        return [
            'content' => $this->faker->paragraph($nbSentences = 5, $variableNbSentences = true),
            'see_more' => $bool ? "http://hekaia.net/" : '',
        ];
    }
}
