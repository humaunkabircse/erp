<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePassMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'cus_id',
        'gp_number',
        'gp_date',
        'gp_type',
        'gp_note',
        'terms_and_conditions',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];

}
