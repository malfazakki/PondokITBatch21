<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Reader extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Get the profile associated with the reader.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the reviews for the reader.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the book clubs that the reader is a member of.
     */
    public function bookClubs()
    {
        return $this->belongsToMany(BookClub::class, 'memberships')
            ->withPivot('joined_at')
            ->withTimestamps();
    }

    /**
     * Get all of the reader's comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
