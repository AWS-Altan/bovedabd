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

    //programación para el insert
    protected $fillable = [
        "name" ,
        "vwrole_id",
        "MVNO_ID",
        "email",
        "password",
        "phone",
        "active",
        "last_session_id",
        "created_by",
        "id_company",
        "id_estado",
        "nivel",
        "idresp",
        "id_solicitante",
        "active_user"
    ];
}



