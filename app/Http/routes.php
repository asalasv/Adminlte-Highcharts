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

Route::group(['middleware' => ['web']], function () {

    Route::auth();

    Route::get('/home', 'HomeController@index');

	Route::get('/', function () {
		return view('auth/login');
	});


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

					$req->desde = (new DateTime($req->desde))->format('Y-m-d');

					$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_portales`
							WHERE `id_cliente` = ".$id_cliente.
							" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y')
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){

						$req->desde = (new DateTime($req->desde))->format('Y-m-d');

						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_portales`
								WHERE `id_cliente` = ".$id_cliente.
								" AND date_format(`fecha_registro`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){

							$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
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

					$req->desde = (new DateTime($req->desde))->format('Y-m-d');

					$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `primer_registro_email`
							WHERE `id_cliente` = ".$id_cliente.
							" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y')
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){

						$req->desde = (new DateTime($req->desde))->format('Y-m-d');

						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `primer_registro_email`
								WHERE `id_cliente` = ".$id_cliente.
								" AND date_format(`fecha_registro`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){

							$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `primer_registro_email`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `primer_registro_email`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
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

					$req->desde = (new DateTime($req->desde))->format('Y-m-d');

					$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

					$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
							FROM `actividad_portales`
							WHERE `id_cliente` = ".$id_cliente.
							" AND date_format(`fecha_actividad`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y')
							GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
				}else
					if($req->desde){

						$req->desde = (new DateTime($req->desde))->format('Y-m-d');

						$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
								FROM `actividad_portales`
								WHERE `id_cliente` = ".$id_cliente.
								" AND date_format(`fecha_actividad`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
					}else
						if($req->hasta){

							$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

							$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
									FROM `actividad_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_actividad`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_actividad`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_actividad`,'%m-%d-%Y'), count(date_format(`fecha_actividad`,'%m-%d-%Y'))
									FROM `actividad_portales`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_actividad`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
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

					$req->desde = (new DateTime($req->desde))->format('Y-m-d');

					$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y') 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){

						$req->desde = (new DateTime($req->desde))->format('Y-m-d');

						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND date_format(`fecha_registro`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){

							$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
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

					$req->desde = (new DateTime($req->desde))->format('Y-m-d');

					$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');

					$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `sex` = 'M' 
							AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y') 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
							FROM `registro_usuarios_ph`
							WHERE `id_cliente` = ".$id_cliente.
							" AND `sex` = 'F' 
							AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format( '".$req->desde."' ,'%m-%d-%Y') and date_format( '".$req->hasta."' ,'%m-%d-%Y') 
							GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
				}else
					if($req->desde){

						$req->desde = (new DateTime($req->desde))->format('Y-m-d');

						$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `sex` = 'M' 
								AND date_format(`fecha_registro`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
								FROM `registro_usuarios_ph`
								WHERE `id_cliente` = ".$id_cliente.
								" AND `sex` = 'F' 
								AND date_format(`fecha_registro`,'%m-%d-%Y')  > date_format( '".$req->desde."' ,'%m-%d-%Y') 
								GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
					}else
						if($req->hasta){

							$req->hasta = (new DateTime($req->hasta))->format('Y-m-d');
						
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'M' 
									AND date_format(`fecha_registro`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
							$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'F' 
									AND date_format(`fecha_registro`,'%m-%d-%Y') < date_format( '".$req->hasta."' ,'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
						}else{
							$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'M' 
									AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
									GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
							$sql1 = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))
									FROM `registro_usuarios_ph`
									WHERE `id_cliente` = ".$id_cliente.
									" AND `sex` = 'F' 
									AND date_format(`fecha_registro`,'%m-%d-%Y') between date_format(now()-interval 7 day,'%m-%d-%Y') and date_format(now(),'%m-%d-%Y')
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

	Route::post('portal/logo',[
	    'as' => 'portal/logo', 'uses' => 'PortalController@updateimglogo'
	]);

	Route::post('portal/publicidad',[
	    'as' => 'portal/publicidad', 'uses' => 'PortalController@updateimgpublicidad'
	]);

	Route::get('lastweekreg', 'GraphicsController@lastweekreg');

	Route::get('newlastweekreg', 'GraphicsController@newlastweekreg');

	Route::get('connectlastweek', 'GraphicsController@connectlastweek');

	Route::get('portalhookuserreg', 'GraphicsController@portalhookuserreg');

	Route::get('sexportalhookuserreg', 'GraphicsController@sexportalhookuserreg');
});
