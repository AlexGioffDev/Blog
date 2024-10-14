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

            // get all user that are mods or simple user
            $all = $mods->concat($users);

            // get random number for create n comments
            $numComments = rand(0, 15);

            if ($numComments < 6) {
                $numComments = 0;
            }

            for ($i = 0; $i < $numComments; $i++) {
                // get a random user from the all variable
                $user = $all->random();
                Comment::factory()->forPostAndUser($post->id, $user->id)->create();
            }
        }
    }
}
