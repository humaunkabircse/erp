<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_type_name',
        'asset_type_sortcode',
        'asset_type_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
    ];
    
}

