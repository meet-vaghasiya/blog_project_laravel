<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Cache::tags(['blog_post'])->flush();

        User::factory()->defaultAdminUser()->create();
        User::factory()->defaultUser()->create();
        User::factory(10)->create();
        Post::factory(50)->create();
        Comment::factory(300)->create();
        Author::factory(10)->create();
        Profile::factory(6)->create();

        $this->call([TagsTableSedder::class, PostTagSeeder::class]);
    }
}
