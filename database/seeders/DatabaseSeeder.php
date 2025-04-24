<?php
namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookClub;
use App\Models\Comment;
use App\Models\Creation;
use App\Models\Reader;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 readers with profiles
        $readers = Reader::factory()
            ->count(10)
            ->has(\App\Models\Profile::factory())
            ->create();

        // Create 10 books
        $books = Book::factory()
            ->count(10)
            ->create();

        // Create 5 book clubs
        $bookClubs = BookClub::factory()
            ->count(5)
            ->create();

        // Create memberships (readers joining book clubs)
        foreach ($bookClubs as $bookClub) {
            // Each book club will have 3-5 random readers as members
            $memberCount   = rand(3, 5);
            $randomReaders = $readers->random($memberCount);

            foreach ($randomReaders as $reader) {
                $bookClub->readers()->attach($reader->id, ['joined_at' => now()]);
            }
        }

        // Create 10 creations
        $creations = Creation::factory()
            ->count(10)
            ->create();

        // Create 10 tags
        $tags = Tag::factory()
            ->count(10)
            ->create();

        // Create 20 comments (distributed among books, reviews, and book clubs)
        // Comments on books
        foreach ($books->random(7) as $book) {
            Comment::factory()
                ->count(2)
                ->forCommentable($book)
                ->create([
                    'reader_id' => $readers->random()->id,
                ]);

            // Also attach random tags to books
            $book->tags()->attach($tags->random(rand(1, 3)));
        }

        // Comments on book clubs
        foreach ($bookClubs->random(3) as $bookClub) {
            Comment::factory()
                ->count(2)
                ->forCommentable($bookClub)
                ->create([
                    'reader_id' => $readers->random()->id,
                ]);

            // Also attach random tags to book clubs
            $bookClub->tags()->attach($tags->random(rand(1, 3)));
        }

        // Create some reviews and add comments to them
        foreach ($books->random(5) as $book) {
            $review = $book->reviews()->create([
                'reader_id' => $readers->random()->id,
            ]);

            // Add comments to reviews
            Comment::factory()
                ->count(2)
                ->forCommentable($review)
                ->create([
                    'reader_id' => $readers->random()->id,
                ]);
        }
    }
}
