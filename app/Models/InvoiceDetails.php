<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'item_id',
        'item_price',
        'item_qty',
        'item_total',
        'item_discount'
    ];
}
