<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // protected $fillable = [
    //     'cus_name',
    //     'email',
    //     'password',
    // ];
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
