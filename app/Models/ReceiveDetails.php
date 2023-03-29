<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'rec_master_id',
        'item_id',
        'item_price',
        'item_qty'
    ];
}
