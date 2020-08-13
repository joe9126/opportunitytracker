<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'clientid',
        'clientname',
        'address',
        'contact',
        'phone',
        'email',
        'email_1',
        'email_2',
        'status'
    ];
}
