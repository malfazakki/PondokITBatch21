<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the books that are assigned this tag.
     */
    public function books()
    {
        return $this->morphedByMany(Book::class, 'taggable');
    }

    /**
     * Get all of the reviews that are assigned this tag.
     */
    public function reviews()
    {
        return $this->morphedByMany(Review::class, 'taggable');
    }

    /**
     * Get all of the book clubs that are assigned this tag.
     */
    public function bookClubs()
    {
        return $this->morphedByMany(BookClub::class, 'taggable');
    }
}
