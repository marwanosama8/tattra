<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

use App\Models\Slider;
use App\Models\Story;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $story = Story::factory()->count(3)
            ->has(Slider::factory()->count(10))
            ->create();

        $faker = Faker::create();
        $imageUrl = $faker->imageUrl(432, 768, null, false);

        foreach ($story as $key) {
            $key->addMediaFromUrl($imageUrl)->toMediaCollection();
        }

        $sliders = Slider::all();

        foreach ($sliders as $key) {
            $key->addMediaFromUrl($imageUrl)->toMediaCollection();
        }
    }
}
