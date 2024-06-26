<?php

namespace App\Models;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=['session_id','meeting_id'];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
