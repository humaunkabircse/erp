<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable=[
        'vendor_name',
        'vendor_contact_number',
        'vendor_description',
        'vendor_company',
        'vendor_vat_number',
        'vendor_website',
        'email',
        'vendor_country',
        'vendor_district',
        'vendor_zip',
        'vendor_street',
        'vendor_city',
        'entered_by',
        'date_entered',
        'updated_by',
        'date_updated',
        'status'
];
}

