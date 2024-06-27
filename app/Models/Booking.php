<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'meeting_id',
        'booking_date',
        'session_date',
        'start_time',
        'end_time',
        'status',
        'comments',
    ];
    public function meeting()
{
    return $this->belongsTo(Meeting::class);
}

public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

}
