<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GetMenu;

use App\Entities\{Usermana};

class HomeController extends Controller
{
    use GetMenu;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( app('auth')->user()->active == 0 ) {
            return view('reset');
        }
        return view('home', ['menu' => $this->get_menu()] );
    }

    public function test( )
    {
        return "";
    }
}
