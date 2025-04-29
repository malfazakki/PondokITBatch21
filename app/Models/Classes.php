<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
    ];

    protected $cast = [
        'level' => 'string',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classes');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }
}
