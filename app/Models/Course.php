<?php

namespace App\Models;

use App\Models\User;
use App\Models\Commission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
protected $fillable = ['title', 'category_id','description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_teacher', 'course_id', 'teacher_id');
    }
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
