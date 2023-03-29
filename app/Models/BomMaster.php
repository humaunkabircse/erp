<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomMaster extends Model
{
    use HasFactory;
    protected $fillable=[
        'prod_item_id',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
}
