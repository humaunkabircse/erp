<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_mode',
        'pay_number',
        'pay_note',
        'status',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}
