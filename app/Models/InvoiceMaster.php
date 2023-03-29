<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'cus_id',
        'invoice_number',
        'invoice_date',
        'invoice_due_date',
        'discount',
        'adjustment',
        'client_note',
        'terms_and_conditions',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
