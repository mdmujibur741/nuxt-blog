<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId =  $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);
        $title = $this->faker->sentence;
        $popular = $this->faker->randomElement([0, 1]);
        $status = $this->faker->randomElement([0, 1]);
        $is_home = $this->faker->randomElement([0, 1]);
        return [
            'title'=> $title,
             'subtitle'=>  $title.  "subtitle",
             'slug'=> Str::slug($title, '-'),
             'description'=>  $this->faker->paragraph,
             'priority' => rand(20, 200),
             'category_id' => $categoryId,
             'meta_title' => $title,
            'meta_description' => $title, 
            'is_popular' => $popular,
            'is_home_show' => $is_home,
            'status' => $status,
        ];
    }
}
