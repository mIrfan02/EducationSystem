<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'total_earnings',
        'commission_rate',
        'total_after_commission',
    ];

    // Define relationship to User (assuming 'users' table is used for teachers)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
