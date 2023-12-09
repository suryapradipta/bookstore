<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\BookCategory;
use App\Models\Book;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Author::factory(1000)->create();
        \App\Models\BookCategory::factory(3000)->create();
        \App\Models\Book::factory(100000)->create();
        \App\Models\Rating::factory(500000)->create();
    }
}
