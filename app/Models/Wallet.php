<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'balance', 'deduct_balance',];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
