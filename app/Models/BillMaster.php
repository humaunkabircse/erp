<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillMaster extends Model
{
    use HasFactory;
    protected $fillable=[
        'bill_number',
        'bill_date',
        'invoice_id',
        'bill_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
