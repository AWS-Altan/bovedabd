<?php

namespace App\Traits;

use App\Entities\{Vwuser,Vwactions,Docs};

/**********************
 *  Nombre: GetMenu.php
 *  Descripción: Trae el Menu
 *  Historial modificaciones:
 *
 * *********************/


trait Getmenu
{

    function get_menu()
    {
        $menu = [];

        foreach (Vwactions::all() as $value)
            if ( !is_null( $value->config ) )
            {
                // sisfen - aqui va la parte de seguridad par los Menus, cuando se vea ese tema , colocarla
                foreach (json_decode( $value->config )->role_excluded as $val)
                    if (    $val->id == session()->get('user_nivel') )
                       $menu[$value->id] = $value->name;
            }

        return $menu;
    }

}
