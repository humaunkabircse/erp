<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'bank_short_name',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
