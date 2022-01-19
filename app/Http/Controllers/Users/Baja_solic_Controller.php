<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Baja_solic_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_gui_user') ] );

    }

    /**
     * Show the Porta In.
     *
     * @return view
     */
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[2] ) )
            return redirect()->route('home.index');

        return view('Users.bajasolic')-> with('menu',$menu);
    } //index

    protected function login()
    {

    } //login

    public function change_status()
    {


        // Escribo los datos de alta
        loginfo('Obtiene Datos del API para la deshabilitación: ');

        $json = request()->json()->all();
        loginfo($json);
        //hago la inserción por la API
        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_gui_user'). 'cambio-estado'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_gui_user') . 'cambio-estado', [$req]);
            loginfo('termina ejecución API');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_gui_user') .'cambio-estado', [ $e ]);
        }
        loginfo('Regreso información');
        return json_encode( $req );

    }//delete_user


} //Baja_user_Controller
