<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
      protected $table = 'vwusers';
     //protected $table = 'tbl_ctl_user_manager_secure';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        
        'mail','iduser_bv','nombre','paterno','materno','msisdn','id_company','id_estado','nivel','idresp','last_session_id'
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'fecha_alta','fecha_termino',
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'mail' => 'email',
    ];*/

    

}
