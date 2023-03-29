<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDeprecation extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'asset_deprecation_date',
        'asset_deprecation_value',
        'asset_deprecation_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
        'status'
    ];

}

