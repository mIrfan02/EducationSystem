<?php

namespace App\Models;

use App\Models\User; // Assuming teachers are represented by a User model or similar
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'commissions';

    protected $fillable = [
        'rate',
        'teacher_id',
        'session_fee',
        // Update to include teacher_id
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Assuming User model for teachers
    }

}
