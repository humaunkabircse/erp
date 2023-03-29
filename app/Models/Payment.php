<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'cus_id',
        'pay_mode',
        'cheque_no',
        'cheque_date',
        'bank_name_id',
        'pay_date',
        'pay_receive_by',
        'pay_amount',
        'pay_note',
        'status',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}
