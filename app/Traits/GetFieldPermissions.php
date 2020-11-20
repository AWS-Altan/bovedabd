<?php

/**********************
 *  Nombre: GetFieldPermissions.php
 *  Descripción: Trae los permisos del menu
 *  Tablas: vwpermissions: vwrole_action
 *  Historial modificaciones:
 *
 * *********************/


namespace App\Traits;
use Illuminate\Support\Facades\DB;

use App\Entities\{Vwuser,Vwactions,Docs, Vwpermissions};

trait GetFieldPermissions
{

    function get_permissions()
    {
        loginfo(app('auth')->user());
        $permissionId = [];
        $query="select fiel_id from vwpermissions a, vwrole_action
        b where a.roleaction_id = b.id and b.role_id=".app('auth')->user()->vwrole_id;

        loginfo("Query: ".$query);
        $dataTypeContent = DB::select($query);
        foreach ($dataTypeContent as $value)
            array_push($permissionId, $value->fiel_id);
        loginfo('---------------------');
        loginfo($permissionId);
        loginfo('---------------------');
        return $permissionId;
    }

}
