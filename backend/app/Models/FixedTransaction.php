<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'amount',  
        'schedule',
        'is_paid',
        'next_payment_date',
    ];
}
