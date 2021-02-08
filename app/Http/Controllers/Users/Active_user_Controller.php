<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Active_user_Controller extends BaseController
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

        return view('Users.active_user')-> with('menu',$menu); // test 2
    }

       protected function login()
    {

    }

    public function user_active ()
    {
        loginfo('Activo usuario');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                $exception = Vwuser::where('email', request()->value)
                ->update([
                        'active_user' => 1
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
    }//user_active


}//Active_user_Controller
