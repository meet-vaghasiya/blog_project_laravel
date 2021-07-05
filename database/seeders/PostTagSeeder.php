<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();
        if (0 === $tagCount) {
            $this->command->info('No tags found, skipping assignig to blog post');
            return;
        }

        $howManyMin = (int)$this->command->ask('Min tags on blog post:', 0);
        $howManyMax = min((int)$this->command->ask('Min tags on blog post:', $tagCount), $tagCount);

        Post::all()->each(function (Post $post) use ($howManyMax, $howManyMin) {
            $take = random_int($howManyMin, $howManyMax);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
