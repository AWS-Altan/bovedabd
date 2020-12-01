<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, mvno, Vwcredential, VwfileTemplates};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class General_User_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function search_user()
    {
        // Docs::where('active', 1)->orderBy('orderd', 'desc')->get() as $value
        // $products =  Vwproduct::select("producto")->whereIn('idproducto',$productUser)->get();

        loginfo('Busqueda de usuario');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                //consulta
                $boveda_user =  Vwuser::where('email','=',request()->value)->get();

                foreach ($boveda_user as $user_bob) {
                    loginfo('name'.$user_bob->name);
                    loginfo('email'.$user_bob->email);

                    $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200,
                                  'name' => $user_bob->name,
                                  'email' => $user_bob->email

                    ]);//json encode

                } //for each


            } catch (\Exception $e) {
                loginfo('Error al consultar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'nok',
                                  'statusCode' => 300
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;


    } //search_user


}
