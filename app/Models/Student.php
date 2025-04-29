<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'birth_date',
        'address',
    ];

    protected $cast = [
        'birth_date' => 'date',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'student_rooms');
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'student_classes');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
