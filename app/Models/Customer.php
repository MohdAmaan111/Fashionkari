<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    protected $primaryKey = 'cus_id';

    protected $guard = 'customer';

    protected $fillable = [
        'cus_name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
    ];

    protected $hidden = ['password', 'remember_token'];
}
