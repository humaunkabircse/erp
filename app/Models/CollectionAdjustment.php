<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionAdjustment extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_adjustment_number',
        'cus_id',
        'collection_adjustment_date',
        'collection_adjustment_amount',
        'collection_adjustment_purpose',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
    ];
}
