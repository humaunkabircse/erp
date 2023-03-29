<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_group_name',
        'item_group_desc',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'

    ];
}
