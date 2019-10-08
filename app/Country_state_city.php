<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_state_city extends Model
{
    protected $fillable = [
        'country', 'state', 'city',
    ];
}


