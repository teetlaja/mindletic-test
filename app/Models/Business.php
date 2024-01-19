<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'business_user');
    }
}