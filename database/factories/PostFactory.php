<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'content' => $this->faker->paragraphs(2, true),
            'user_id' => mt_rand(1, User::all()->count()),
            'created_at' => $this->faker->dateTimeBetween('-3 months')


        ];
    }
}
