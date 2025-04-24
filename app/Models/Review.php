<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'reader_id',
    ];

    /**
     * Get the book that owns the review.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the reader that owns the review.
     */
    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    /**
     * Get all of the review's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the tags for the review.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
