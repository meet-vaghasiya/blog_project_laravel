<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text,
            'post_id' => mt_rand(1, Post::all()->count()),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
            'user_id' => mt_rand(1, User::all()->count())

        ];
    }
}
