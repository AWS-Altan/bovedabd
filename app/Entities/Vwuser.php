<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**********************
 *  Nombre VWUSER
 *  Descripción: Redeficion de Modelo a clase VW}User
 *  Historial modificaciones
 *
 * *********************/

class Vwuser extends Model
{
    //

    public function mvno()
    {
        return $this->belongsTo(mvno::class, 'mvno_id');
    }
}
