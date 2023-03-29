<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRevalue extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'asset_revalue_date',
        'asset_revalue_price',
        'asset_revalue_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
        'status'
    ];
}
