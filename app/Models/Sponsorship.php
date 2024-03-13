<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'price', 'duration', 'doctor_id'];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
