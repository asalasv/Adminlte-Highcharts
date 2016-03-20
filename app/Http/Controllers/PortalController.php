<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 

use Illuminate\Support\Collection as Collection;
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

        $user=Auth::user();

        $sql1 = "SELECT id_cliente
        FROM clientes
        WHERE id_usuario_web =".$user->id_usuario_web;

        $rows = \DB::select($sql1);  

        $id_cliente = $rows[0]->id_cliente;

        $sql = "SELECT imagen_publicidad
                FROM portales_cliente 
                WHERE id_cliente =".$id_cliente;

        $result = \DB::select($sql);

        $publicidad = base64_encode($result[0]->imagen_publicidad);   

        $publicidad = 'data:image/png;base64,'.$publicidad;

        return view('portal/publicidad',compact('publicidad'));
    }

    public function imglogo()
    {

        $user=Auth::user();

        $sql1 = "SELECT id_cliente
        FROM clientes
        WHERE id_usuario_web =".$user->id_usuario_web;

        $rows = \DB::select($sql1);  

        $id_cliente = $rows[0]->id_cliente;

        $sql = "SELECT imagen_logo
                FROM portales_cliente 
                WHERE id_cliente =".$id_cliente;

        $result = \DB::select($sql);

        $logo = base64_encode($result[0]->imagen_logo);   

        $logo = 'data:image/png;base64,'.$logo;

        return view('portal/logo',compact('logo'));
    }

    public function updateimglogo(Request $request)
    {
    	dd('Aqui actualizar logo');
        return view('portal/logo');

    }

}
