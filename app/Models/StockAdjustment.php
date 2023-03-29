<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_adjustment_Number',
        'item_id',
        'stock_adjustment_date',
        'stock_adjustment_addition_qty',
        'stock_adjustment_subtraction_qty',
        'stock_adjustment_purpose',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}
