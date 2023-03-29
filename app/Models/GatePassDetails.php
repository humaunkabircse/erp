<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePassDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'gp_id',
        'item_id',
        'item_price',
        'item_qty',
    ];
}
