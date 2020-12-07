<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

/*************************************
*   Descripcion: Clase de Modelo de tabla para usuarios de plataformas
*************************************/

class Userplat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auditor_alta_user_dispositivos';

    public function Userplat()
    {
        return $this->belongsTo(Userplat::class, 'id_auditor_alta');
    }

    //programación para el insert
    protected $fillable = [
        'id_auditor_alta',
        'id_disp',
        'ip',
        'host',
        'idtipo_disp',
        'idgrupo',
        'usuario',
        'passw',
        'idtipo',
        'idperfil',
        'id_solicitante',
        'id_estatus',
        'fecha_ingreso',
        'fecha_update',
        'fecha_termino',
        'fecha_error',
        'file',
        'reintento',
        'error_de_plataforma',
        'duration',
        'transaccion_id',
        'estatus_transaccion'
    ];

} //Userplat



