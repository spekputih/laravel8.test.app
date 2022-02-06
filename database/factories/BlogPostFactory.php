<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraphs(2, true),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }

    public function newPost()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'New titles',
                'content' => 'Content of the blog post'
            ];
        });
    }
}