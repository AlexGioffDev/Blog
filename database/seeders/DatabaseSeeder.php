<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->admin()->create();
        $mods = User::factory(3)->mod()->create();
        $users = User::factory(15)->create();


        $posts = Post::factory(20)->create(['user_id' => $admin->id]);

        foreach ($posts as $post) {
            $all = $mods->concat($users);

            $numComments = rand(5, 10);

            for ($i = 0; $i < $numComments; $i++) {
                $user = $all->random();
                Comment::factory()->forPostAndUser($post->id, $user->id)->create();
            }
        }
    }
}
