<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetClosure extends Model
{
    use HasFactory;
    protected $fillable = [
        'asset_id',
        'asset_closure_date',
        'asset_closure_reason',
        'asset_closure_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
        'status'
    ];
}
