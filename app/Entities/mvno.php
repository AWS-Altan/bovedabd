<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class mvno extends Model
{
    protected $hidden = [
        'partnerId',
        'created_at',
        'updated_at'
    ];
}
