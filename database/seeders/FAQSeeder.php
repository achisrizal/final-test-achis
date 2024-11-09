<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 fake FAQs
        foreach (range(1, 10) as $index) {
            FAQ::create([
                'question' => $faker->sentence,   // Generate a random sentence for the question
                'answer' => $faker->paragraph,    // Generate a random paragraph for the answer
                'is_active' => 1,                 // Set the FAQ to active
            ]);
        }
    }
}
