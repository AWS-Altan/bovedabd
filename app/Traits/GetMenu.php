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
                foreach (json_decode( $value->config )->role_excluded as $val)
                    loginfo('Menu: ', [$val]);
                    if ( $val->id == app('auth')->user()->vwrole_id )
                       $menu[$value->id] = $value->name;


        foreach ( Docs::where('active', 1)->orderBy('orderd', 'desc')->get() as $value)
            $menu['docs'][$value->id] = $value->name;


        return $menu;
    }

}
