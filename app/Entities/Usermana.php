<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

/*************************************
*   Descripcion: Clase de Modelo de tabla para usuarios de plataformas
*************************************/

class Usermana extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_ctl_user_manager_secure';

    public function Usermana()
    {
        return $this->belongsTo(Userplat::class, 'iduser_bv');
    }

    //programación para el insert
    protected $fillable = [
        'iduser_bv',
        'nombre',
        'paterno',
        'materno',
        'msisdn',
        'id_company',
        'mail',
        'fecha_alta',
        'fecha_termino',
        'id_estado',
        'nivel',
        'idresp'       
    ];

} //Userplat



