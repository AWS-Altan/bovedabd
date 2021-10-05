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

    public $timestamps = false;

    public function Usermana()
    {
        return $this->belongsTo(Userplat::class, 'iduser_bv');
    }

    // User model
    /*public function address()
    {
        return $this->hasMany(Address::class, 'email', 'email');
    }*/

    //programación para el insert
    protected $fillable = [
        'iduser_bv',
        'nombre',
        'paterno',
        'materno',
        'msisdn',
        'id_company',
        'email',
        'fecha_alta',
        'fecha_termino',
        'id_estado',
        'nivel',
        'idresp',
        'last_session_id',
        'id'
    ];

    protected $primaryKey = 'iduser_bv';
   
    protected $maps = [
        'email' => 'email',        
    ];

    protected $append = ['email'];

    public function getEmailAttribute()
    {
        return $this->attributes['email'];
    }
    

} //Userplat
