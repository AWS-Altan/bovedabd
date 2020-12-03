<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

/*************************************
*   Descripcion: Clase de Modelo de tabla para usuarios de plataformas
*************************************/

class Dispositivos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_ctl_user_dispositivos';

    public function Dispositivos()
    {
        return $this->belongsTo(Userplat::class, 'id_disp');
    }

    //programación para el insert
    protected $fillable = [
        "id_disp",
        "ip",
        "host",
        "idtipo_disp",
        "idgrupo",
        "usuario",
        "idtipo",
        "id_status",
        "idperfil",
        "flag_rota",
        "id_solicitante",
        "fecha_alta",
        "fecha_rota",
        "fecha_termino"
    ];

} //Userplat



