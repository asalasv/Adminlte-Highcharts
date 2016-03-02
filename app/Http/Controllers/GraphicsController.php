<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GraphicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Registros Ultima Semama
     *
     */

    public function lastweekreg()
    {
        return view('graphics/lastweekreg');
    }

    //Registros Nuevos Ultima Semana
    public function newlastweekreg()
    {
        return view('graphics/newlastweekreg');
    }

    //Conexiones al Portal Ultima Semana.
    public function connectlastweek()
    {
        return view('graphics/connectlastweek');
    }

    //Registros Usuarios PortalHook
    public function portalhookuserreg()
    {
        return view('graphics/portalhookuserreg');
    }

    //Registros Usuarios PortalHook Hombres y Mujeres
    public function sexportalhookuserreg()
    {
        return view('graphics/sexportalhookuserreg');
    }

}
