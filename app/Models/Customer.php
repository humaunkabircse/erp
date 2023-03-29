<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
            'name',
            'cus_company',
            'cus_website',
            'description',
            'contact_number',
            'vat_number',
            'email',
            'country',
            'district',
            'zip',
            'street',
            'city',
            'billing_country',
            'billing_district',
            'billing_zip',
            'billing_street',
            'billing_city',
            'shipping_country',
            'shipping_district',
            'shipping_zip',
            'shipping_street',
            'shipping_city',
            'status'
    ];
}
