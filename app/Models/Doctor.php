<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Doctor extends Model
{
    // aggiunto softdeletes 
    use HasFactory, SoftDeletes;

    protected $fillable = ['curriculum', 'photo', 'address', 'phone_number', 'medical_services', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }
}
