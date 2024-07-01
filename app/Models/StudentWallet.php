<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWallet extends Model
{
    use HasFactory;
    protected $table = 'student_wallet';

    protected $fillable = ['student_id', 'balance'];
}
