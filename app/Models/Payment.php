<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Business;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'paymentID',
        'amount',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}