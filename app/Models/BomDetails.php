<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'bom_master_id',
        'used_item_id',
        'used_item_qty',
        'used_item_unit',
        'wastage_quantity',
    ];
}
