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
}
