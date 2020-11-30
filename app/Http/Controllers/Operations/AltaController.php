<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

class AltaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GetMenu;

    /**
	 *
	 *
	 * @return view
	 */
	public function index()
    {
    	$menu = $this->get_menu();
    	if ( isset( $menu[54] ) )
    		return redirect()->route('home.index');

    	return view('operation.alta', ['menu' => $menu] );
    }
}
