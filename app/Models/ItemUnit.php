<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_name',
        'unit_desc',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'

    ];
}
