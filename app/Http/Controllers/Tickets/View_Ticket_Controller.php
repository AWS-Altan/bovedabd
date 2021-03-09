<?php

namespace App\Http\Controllers\Tickets;

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

class View_Ticket_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client( [ 'base_uri' => config('conf.url_activity_list') ] );

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

        //return view('tickets.View_Ticket', ['menu' => $menu] );
        return view('Tickets.View_Ticket')-> with('menu',$menu);
    }

       protected function login()
    {

    }

    
        public function getList()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene lista de actividades en curso');

        $json = request()->json()->all();
        loginfo($json);


        try {

            $req = json_decode($this->httpClient->request('POST',config('conf.url_activity_list'). 'bv_button_query'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_activity_list') . 'bv_button_query', [$req]);

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_activity_list') .'bv_button_query'
                , [ parse_exception( $e ) ]);


        }

        return json_encode( $req );
    }




}
