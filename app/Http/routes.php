<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('auth/login');
});

Route::group(['middleware' => ['web']], function () {

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| This route group applies the "web" middleware group to every route
	| it contains. The "web" middleware group is defined in your HTTP
	| kernel and includes session state, CSRF protection, and more.
	|
	*/

	Route::get('lastweekreg/get',function(){
		if(Request::ajax()){

			$req = Request::all();

			$req = json_encode($req);

			$req = json_decode($req);

			$user=Auth::user();
			
			$sql1 = "SELECT id_cliente
					FROM clientes
					WHERE id_usuario_web =".$user->id_usuario_web;

			$rows = DB::select($sql1);

			if(count($rows)){
				$id_cliente = $rows[0]->id_cliente;

				if($req->desde and $req->hasta){
					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_portales`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `fecha_registro` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){
						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_portales`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `fecha_registro` > ".$req->desde." 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` < ".$req->hasta."
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}

				
			
				$results = DB::select($sql);

				return $results;


			}else
				return "El id del usuario '".$user->username."' no se encuentra en tabla clientes";
		}
	});
	
	Route::get('newlastweekreg/get',function(){
		if(Request::ajax()){

			$req = Request::all();

			$req = json_encode($req);

			$req = json_decode($req);

			$user=Auth::user();
			
			$sql1 = "SELECT id_cliente
					FROM clientes
					WHERE id_usuario_web =".$user->id_usuario_web;

			$rows = DB::select($sql1);

			if(count($rows)){
				$id_cliente = $rows[0]->id_cliente;

				if($req->desde and $req->hasta){
					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `primer_registro_email`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `fecha_registro` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){
						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `primer_registro_email`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `fecha_registro` > ".$req->desde." 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `primer_registro_email`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` < ".$req->hasta."
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `primer_registro_email`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}

				
			
				$results = DB::select($sql);

				return $results;


			}else
				return "El id del usuario '".$user->username."' no se encuentra en tabla clientes";
		}
	});

	Route::get('connectlastweek/get',function(){
		if(Request::ajax()){

			$req = Request::all();

			$req = json_encode($req);

			$req = json_decode($req);

			$user=Auth::user();
			
			$sql1 = "SELECT id_cliente
					FROM clientes
					WHERE id_usuario_web =".$user->id_usuario_web;

			$rows = DB::select($sql1);

			if(count($rows)){
				$id_cliente = $rows[0]->id_cliente;

				if($req->desde and $req->hasta){
					$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
							FROM `actividad_portales`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `fecha_actividad` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
				}else
					if($req->desde){
						$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
								FROM `actividad_portales`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `fecha_actividad` > ".$req->desde." 
								GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
					}else
						if($req->hasta){
							$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
									FROM `actividad_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_actividad` < ".$req->hasta."
									GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
									FROM `actividad_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_actividad` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
						}
			
				$results = DB::select($sql);

				return $results;


			}else
				return "El id del usuario '".$user->username."' no se encuentra en tabla clientes";
		}
	});
	
	Route::get('portalhookuserreg/get',function(){
		if(Request::ajax()){

			$req = Request::all();

			$req = json_encode($req);

			$req = json_decode($req);

			$user=Auth::user();
			
			$sql1 = "SELECT id_cliente
					FROM clientes
					WHERE id_usuario_web =".$user->id_usuario_web;

			$rows = DB::select($sql1);

			if(count($rows)){
				$id_cliente = $rows[0]->id_cliente;

				if($req->desde and $req->hasta){
					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `fecha_registro` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){
						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `fecha_registro` > ".$req->desde." 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` < ".$req->hasta."
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `fecha_registro` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}
			
				$results = DB::select($sql);

				return $results;
			}else
				return "El id del usuario '".$user->username."' no se encuentra en tabla clientes";
		}
	});

	Route::get('sexportalhookuserreg/get',function(){
		if(Request::ajax()){

			$req = Request::all();

			$req = json_encode($req);

			$req = json_decode($req);

			$user=Auth::user();
			
			$sql1 = "SELECT id_cliente
					FROM clientes
					WHERE id_usuario_web =".$user->id_usuario_web;

			$rows = DB::select($sql1);

			if(count($rows)){
				$id_cliente = $rows[0]->id_cliente;

				
				if($req->desde and $req->hasta){
					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `sex` = 'M' 
							AND `fecha_registro` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `sex` = 'F' 
							AND `fecha_registro` between ".$req->desde ." and ".$req->hasta." 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){
						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `sex` = 'M' 
								AND `fecha_registro` > ".$req->desde." 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `sex` = 'F' 
								AND `fecha_registro` > ".$req->desde." 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'M' 
									AND `fecha_registro` < ".$req->hasta."
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
							$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'F' 
									AND `fecha_registro` < ".$req->hasta."
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'M' 
									AND `fecha_registro` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
							$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'F' 
									AND `fecha_registro` between now()-interval 400 day and now()
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}
			
				$results = DB::select($sql);

				$results1 = DB::select($sql1);

				$array = array($results, $results1);

				return $array;


			}else
				return "El id del usuario '".$user->username."' no se encuentra en tabla clientes";
		}
	});

	/*
	|--------------------------------------------------------------------------
	| Views
	|--------------------------------------------------------------------------
	|
	| This route group applies the "web" middleware group to every route
	| it contains. The "web" middleware group is defined in your HTTP
	| kernel and includes session state, CSRF protection, and more.
	|
	*/

	Route::get('portal/publicidad', 'PortalController@imgpublicidad');

	Route::get('portal/logo', 'PortalController@imglogo');

	Route::get('lastweekreg', 'GraphicsController@lastweekreg');

	Route::get('newlastweekreg', 'GraphicsController@newlastweekreg');

	Route::get('connectlastweek', 'GraphicsController@connectlastweek');

	Route::get('portalhookuserreg', 'GraphicsController@portalhookuserreg');

	Route::get('sexportalhookuserreg', 'GraphicsController@sexportalhookuserreg');
});
