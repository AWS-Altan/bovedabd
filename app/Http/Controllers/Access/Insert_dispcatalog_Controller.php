<?php

namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Usermana};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Insert_dispcatalog_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_cat_disp') ] );

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

        return view('Access.insert_dispcatalog')-> with('menu',$menu);
    }

       protected function login()
    {

    }


    /*****************************
     * update_data_api
    ******************************/
    public function update_data_api()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para el reporte: ');

        $json = request()->json()->all();
        loginfo($json);


        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_catupd_disp'). 'catalog-device-boveda'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_catupd_disp') . 'catalog-device-boveda', [$req]);
            loginfo('termina ejecución API');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_catupd_disp') .'catalog-device-boveda', [ $e ]);


        }
        loginfo('Regreso información');
        return json_encode( $req );

    }//update_data_api

}
