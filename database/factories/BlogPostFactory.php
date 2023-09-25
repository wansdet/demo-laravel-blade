<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paragraphs = $this->faker->paragraphs($this->faker->numberBetween(15, 25));
        $content = '';

        // Loop through paragraphs and add <p> tags
        foreach ($paragraphs as $key => $paragraph) {
            $content .= '<p>' . $paragraph . '</p>';
        }

        return [
            'title' => $this->faker->sentence($this->faker->numberBetween(5, 7)),
            'slug' => $this->faker->slug(),
            'content' => $content,
            // 'category' => 'TRAVEL',
            // 'tags' => 'city breaks, culture, culinary',
            'status' => 'published',
        ];
    }
}
