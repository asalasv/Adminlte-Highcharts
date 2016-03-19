<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Registros Nuevos Ultima Semana
    public function imgpublicidad()
    {
        return view('portal/publicidad');
    }

    public function imglogo()
    {
        return view('portal/logo');
    }

    public function updateimglogo(Request $request)
    {
    	dd('llegue');
        return view('portal/logo');
    

    }

}
