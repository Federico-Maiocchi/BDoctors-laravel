<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    // aggiunto softdeletes 
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'email',
        'message',
        'doctor_id'
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
