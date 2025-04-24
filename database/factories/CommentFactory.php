<?php
namespace Database\Factories;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Reader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentableTypes = [
            Book::class,
            // You can add other commentable types here
        ];

        $commentableType = fake()->randomElement($commentableTypes);
        $commentableId   = null;

        if ($commentableType === Book::class) {
            $commentableId = Book::factory();
        }

        return [
            'reader_id'        => Reader::factory(),
            'commentable_type' => $commentableType,
            'commentable_id'   => $commentableId,
            'content'          => fake()->paragraph(2),
        ];
    }

    /**
     * Configure the comment to be for a specific commentable.
     */
    public function forCommentable($commentable)
    {
        return $this->state(function (array $attributes) use ($commentable) {
            return [
                'commentable_id'   => $commentable->id,
                'commentable_type' => get_class($commentable),
            ];
        });
    }
}
