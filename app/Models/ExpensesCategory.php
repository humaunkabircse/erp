<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_cat_name',
        'expenses_cat_note',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated'
];

}
