<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           $title =  $this->faker->unique()->randomElement(['Tech Trends',
           'Health & Wellness', 'Travel Diaries', 'Food & Recipes', 'Lifestyle Tips',   'Business Insights',
           'Personal Finance', 'Digital Marketing',  'Self-Improvement', 'Science & Innovation', 'Home & Garden',
           'Entertainment News', 'Art & Design', 'Parenting & Family', 'Fitness & Sports', 'Education & Learning', 'Fashion & Style', 'Productivity Hacks',
           'Environment & Nature','Book Reviews']);
           $popular = $this->faker->randomElement([0, 1]);
           $status = $this->faker->randomElement([0, 1]);
           $is_home = $this->faker->randomElement([0, 1]);
            return [
                'title' =>$title ,
                'slug' => Str::slug($title, '-'),
                'subtitle' => $title. 'subtile',
                'details' => fake()->text(200),
                'priority' => rand(10, 50),
                'meta_title' => $title,
                'meta_description' => $title, 
                'is_popular' => $popular,
                'is_home_show' => $is_home,
                'status' => $status,
            ];
    }
}
