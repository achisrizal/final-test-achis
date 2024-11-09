<?php

namespace Database\Seeders;

use App\Models\Blog;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Blog::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'author_id' => 1,
                'slug' => $faker->slug,
                'status' => 'published',
            ]);
        }
    }
}
