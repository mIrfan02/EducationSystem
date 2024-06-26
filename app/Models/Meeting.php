<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'title',
        'meeting_link',
        'fee_per_hour',
        'teacher_id',
    ];
    public function show($id)
    {
        $teacher = User::findOrFail($id);
        return view('teacher.show', compact('teacher'));
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}
public function commission()
{
    return $this->belongsTo(Commission::class);
}


}
