<?php

namespace App\Http\Controllers\Users;

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

class View_pass_Controller extends BaseController
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

        //return view('users.view_pass', ['menu' => $menu] );
        return view('Users.view_pass')-> with('menu',$menu);
    }

    protected function login()
    {

    }

    public function user_pass()
    {
        // Docs::where('active', 1)->orderBy('orderd', 'desc')->get() as $value
        // $products =  Vwproduct::select("producto")->whereIn('idproducto',$productUser)->get();

        loginfo('Busqueda de usuario');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                //consulta
                $boveda_user =  Usermana::where('email','=',request()->value)->get();

                foreach ($boveda_user as $user_bob) {
                    loginfo('name'.$user_bob->name);
                    loginfo('email'.$user_bob->email);
                    loginfo('email'.$user_bob->password);

                    $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200,
                                  'name' => $user_bob->name,
                                  'email' => $user_bob->email,
                                  'password' => $user_bob->password

                    ]);//json encode

                } //for each


            } catch (\Exception $e) {
                loginfo('Error al consultar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'NOK',
                                  'statusCode' => 400
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;


    } //search_user


}
