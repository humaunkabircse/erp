<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
            'item_name',
            'item_desc',
            'item_price',
            'cat_id',
            'child_cat_id',
            'item_unit',
            'item_group',
            'terms_and_conditions',
            'status',
            'bom_status',
            'entered_by',
            'date_entered',
            'updated_by',
            'date_updated'
    ];
}
