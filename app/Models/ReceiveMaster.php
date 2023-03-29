<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_type_id',
        'vendor_id',
        'rec_invoice_number',
        'rec_date',
        'discount',
        'adjustment',
        'rec_by',
        'rec_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
