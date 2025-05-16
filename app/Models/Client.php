<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'domain',
        'api_key',
        'subscription_expiry_date',
    ];

    // protected $hidden = [
    //     'api_key'
    // ];
}
