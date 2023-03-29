<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionMaster extends Model
{
    use HasFactory;
    protected $fillable=[
        'batch_number',
        'Production_date',
        'item_id',
        'prod_qty',
        'item_price',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}