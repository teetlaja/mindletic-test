<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Psychologist;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id',
        'user_id',
        'start_time',
        'duration',
        'invoice_id',
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}