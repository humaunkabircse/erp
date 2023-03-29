<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    use HasFactory;
    protected $fillable = [
            'asset_name',
            'asset_type',
            'asset_purshase_date',
            'asset_origin',
            'asset_price',
            'asset_note',
            'entered_by',
            'date_entered',
            'updated_by',
            'date_updated',
    ];
}
