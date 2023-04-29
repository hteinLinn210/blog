<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            "name" => "Shelly",
            "email" => "sheldon@gmail.com"
        ]);

        \App\Models\User::factory()->create([
            "name" => "Missy",
            "email" => "missy@gmail.com"
        ]);

        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();

        $lists = ['News', 'Tech', 'Mobile', 'Internet', 'Computer'];

        foreach ($lists as $name) {
            \App\Models\Category::create(['name' => $name]);
        }
    }
}
