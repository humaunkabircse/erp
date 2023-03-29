<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_name',
        'expenses_category',
        'expenses_date',
        'expenses_amount',
        'cust_id',
        'pay_mode',
        'pay_tax',
        'status',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}
