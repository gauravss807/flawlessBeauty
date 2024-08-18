<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable =
    [
        'vendor_name',
        'vendor_gender',
        'vendor_email',
        'vendor_phone',
        'vendor_address',
        'vendor_role',
        'salon_name',
        'salon_phone',
        'salon_email',
        'salon_website',
        'salon_address',
        'salon_city',
        'salon_state',
        'salon_country',
        'salon_postal_code',
        'established_date',
        'status',
    ];
}
