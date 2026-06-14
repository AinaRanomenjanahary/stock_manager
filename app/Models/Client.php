<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'client_first_name',
        'client_last_name',
        'client_email',
        'client_phone',
        'client_address',
    ];
}
