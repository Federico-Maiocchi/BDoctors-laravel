<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    // aggiunto softdeletes 
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'message', 'doctor_id', 'vote_id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }
}
