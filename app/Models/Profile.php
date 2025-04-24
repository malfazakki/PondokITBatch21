<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reader_id',
        'favorite_genre',
        'bio',
    ];

    /**
     * Get the reader that owns the profile.
     */
    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
