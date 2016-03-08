# Dashboard para Portalhook para graficar y configurar

El siguiente dashboard esta hecho con [Laravel](http://laravel.com/docs), implementando el entorno grafico de [AdminlLTE 2](https://github.com/acacha/adminlte-laravel), las graficas son generadas con el plugin [Highcharts](http://www.highcharts.com/).

## Implementacion

Para correr el programa es necesario seguir los siguientes pasos:

###1. Modificar la longitud de la variable 'password' de la tabla 'usuarios.web', de varchar(11) a varchar(60).

###2. Para usar la autenticacion de laravel con los metodos Auth, es necesario encriptar todas los password existentes en la tabla 'usuarios_web' con el siguiente codigo 
						
					        $users = User::all();

					        foreach ($users as $user) {

					            $user->password = bcrypt($user->password);
					            $user->save();
					        }

	Para esto yo sigo los siguientes pasos, deben haber varias maneras.
	
	####Ejecutar el comando 'php artisan migrate' en consola:
	Con esto se crean las tablas users, migrations y password_resets en la base de datos, una vez hecho esto se puede registrar usuarios nuevos.

	####Descomento el codigo en [GraphicsController.php](https://github.com/asalasv/adminlte/blob/master/app/Http/Controllers/GraphicsController.php).

	####Registrar un usuario nuevo para entrar al portal
	Cuando registres un usuario nuevo y entres al portal, al lado izquierdo en el sidebar entrar a Estadisticas-Registros Ult Semana.

	y listo revisar la tabla usuarios_web de la base de datos, ya los passwords estarana encriptados.

	####Borrar las tablas creadas por la migracion (migrations, password_resets, users) y borrar el usuario registrado por nosotros.

	####Volver a comentar el codigo en [GraphicsController.php](https://github.com/asalasv/adminlte/blob/master/app/Http/Controllers/GraphicsController.php).

	Y listo una vez hecho estos pasos el sistema de login deberia funcionar con los usarios que ya estaban en la tabla usuarios_Web y sus respectivos passwords.				        
