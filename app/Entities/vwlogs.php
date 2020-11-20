<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Vwlogs extends Model
{
    protected $fillable = [
        "vwuser_id",
        "actions",
        "responses",
        "action_low",
        "resoponse_low"
    ];
}
