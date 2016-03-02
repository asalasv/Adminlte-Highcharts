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
	return view('welcome');
});

Route::get('lastweekreg/get',function(){
	if(Request::ajax()){

		$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))FROM `registro_portales`WHERE `id_cliente` = 9999 AND `fecha_registro` between now()-interval 7 day and now()GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
		
		$results = DB::select($sql);

		return $results;
	}
});

Route::get('newlastweekreg/get',function(){
	if(Request::ajax()){

		$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))FROM `registro_portales`WHERE `id_cliente` = 9999 AND `fecha_registro` between now()-interval 7 day and now()GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
		
		$results = DB::select($sql);

		return $results;
	}
});

Route::get('connectlastweek/get',function(){
	if(Request::ajax()){

		$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))FROM `registro_portales`WHERE `id_cliente` = 9999 AND `fecha_registro` between now()-interval 7 day and now()GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
		
		$results = DB::select($sql);

		return $results;
	}
});

Route::get('portalhookuserreg/get',function(){
	if(Request::ajax()){

		$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))FROM `registro_portales`WHERE `id_cliente` = 9999 AND `fecha_registro` between now()-interval 7 day and now()GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
		
		$results = DB::select($sql);

		return $results;
	}
});

Route::get('sexportalhookuserreg/get',function(){
	if(Request::ajax()){

		$sql = "SELECT date_format(`fecha_registro`,'%m-%d-%Y'), count(date_format(`fecha_registro`,'%m-%d-%Y'))FROM `registro_portales`WHERE `id_cliente` = 9999 AND `fecha_registro` between now()-interval 7 day and now()GROUP BY date_format(`fecha_registro`,'%m-%d-%Y')";
		
		$results = DB::select($sql);

		return $results;
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

Route::get('lastweekreg', 'GraphicsController@lastweekreg');

Route::get('newlastweekreg', 'GraphicsController@newlastweekreg');

Route::get('connectlastweek', 'GraphicsController@connectlastweek');

Route::get('portalhookuserreg', 'GraphicsController@portalhookuserreg');

Route::get('sexportalhookuserreg', 'GraphicsController@sexportalhookuserreg');

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

Route::group(['middleware' => ['web']], function () {
    //
});
