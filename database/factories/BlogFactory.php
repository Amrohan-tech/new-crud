<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'salary' => $this->faker->randomFloat(2, 3000, 10000),
            'job' => $this->faker->jobTitle(),
        ];
    }
}

