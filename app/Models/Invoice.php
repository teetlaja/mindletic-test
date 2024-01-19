<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\User;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'payment_id',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}