<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Publisher;

class BookPublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();

        foreach ($books as $book) {
            $publishers = Publisher::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $book->publishers()->attach($publishers);
        }
    }
}
