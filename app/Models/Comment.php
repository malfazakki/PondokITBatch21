<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reader_id',
        'commentable_id',
        'commentable_type',
        'content',
    ];

    /**
     * Get the parent commentable model (book, review, or book club).
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the reader that owns the comment.
     */
    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
