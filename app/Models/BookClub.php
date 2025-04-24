<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookClub extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The readers that belong to the book club.
     */
    public function readers()
    {
        return $this->belongsToMany(Reader::class, 'memberships')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

    /**
     * Get all of the book club's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the tags for the book club.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
