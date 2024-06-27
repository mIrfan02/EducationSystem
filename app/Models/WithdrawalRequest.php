<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawalRequest extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'amount', 'status'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

}
