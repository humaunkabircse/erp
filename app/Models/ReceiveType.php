<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveType extends Model
{
    use HasFactory;
    protected $fillable=[
        'receive_type_name',
        'receive_type_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
