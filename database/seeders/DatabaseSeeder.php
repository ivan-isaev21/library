<?php

namespace Database\Seeders;

use App\Models\Book;
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
        $this->call([
            BookSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            AuthorBookSeeder::class,
            BookPublisherSeeder::class
        ]);
    }
}
