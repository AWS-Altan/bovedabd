<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, VwfileTemplates};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Baja_user_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

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

        return view('Users.bajauser')-> with('menu',$menu);
    } //index

    protected function login()
    {

    } //login

    public function delete_user()
    {

        loginfo('Borrado de usuario');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                //consulta
                $boveda_user =  Vwuser::where('email','=',request()->value)->forceDelete();
                //$boveda_user->forceDelete();


                foreach ($boveda_user as $user_bob) {
                    $response = json_encode(['description' => 'NOK',
                                  'statusCode' => 400,
                    ]);//json encode

                } //for each

                    $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200

                    ]);//json encode




            } catch (\Exception $e) {
                loginfo('Error al consultar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'nok',
                                  'statusCode' => 300
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;
    }//delete_user


} //Baja_user_Controller
