<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, VwfileTemplates};
use Hash; //para el password
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Change_pass_Controller extends BaseController
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

        //return view('users.change_pass', ['menu' => $menu] );
        return view('Users.change_pass')-> with('menu',$menu);
    }

    protected function login()
    {

    }

    public function change_pass()
    {
        loginfo('Cambio password');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                $exception = Vwuser::where('email', request()->value)
                ->update([
                        "password" => Hash::make( request()->send_password),
                ]);

                //Escribo al log
                loginfo('actualice usuario');

                $response = json_encode(['description' => 'OK',
                                  'statusCode' => 200
                    ]);//json encode




            } catch (\Exception $e) {
                loginfo('Error al actualizar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'NOK',
                                  'statusCode' => 400
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;
    }//change_pass


}
