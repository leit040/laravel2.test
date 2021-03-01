<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(rand(3,6)),
           'slug' => $this->faker->unique()->slug(rand(5,10)),
           'body'=>implode(". ", $this->faker->paragraphs(rand(10,45))),
            'user_id'=>\App\Models\User::factory(),
           'category_id'=>Category::factory(),
           'remember_token' => Str::random(10),
        ];
    }
}
