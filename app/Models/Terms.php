<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    use HasFactory;
    protected $fillable = [
        'term_name',
        'term_desc',
        'status',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'

    ];
}
