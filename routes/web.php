<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
	Route::resource('/', 'HomeController', ['names' => ['index' => 'home.index']])->only(['index']);
	Route::resource('/consulta/{isMob}/', 'ConsultaController', ['names' => ['index' => 'consulta.index']])->only(['index']);

	Route::post('/view360', 'View360Controller@index')->name('view360.home');
	Route::get('/view360', 'View360Controller@index');

	Route::get('/historyoperations', 'View360Controller@historyoperations')->name('history.operations');
	Route::get('/historyofferts', 'View360Controller@historyoffert')->name('history.offerts');
	Route::get('/historyconsumos', 'View360Controller@historyconsumo')->name('history.consumos');
	Route::get('/historysim', 'View360Controller@historysim')->name('history.sim');
	Route::get('/historystatus', 'View360Controller@historystatus')->name('history.status');
	Route::get('/historymovilidad', 'View360Controller@historymovilidad')->name('history.movilidad');
	Route::get('/historyequipo', 'View360Controller@historyequipos')->name('history.equipo');
	Route::get('/historyequipow', 'View360Controller@historyequipow')->name('history.equipow');

	Route::get('/historyperfil', 'View360Controller@perfil')->name('history.perfil');

    /*Sisfen -  Modificación Boveda  */
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        // Menu de Alta de usuario
        Route::resource('/Alta_user', 'Alta_user_Controller', ['names' => ['index' => 'Users.alta_user.index']])->only(['index']);
        // Menu de baja de usuario
        Route::resource('/Baja_user', 'Baja_user_Controller', ['names' => ['index' => 'Users.baja_user.index']])->only(['index']);
        // Menu de Modificación de  de usuario
        Route::resource('/Modif_user', 'Modif_user_Controller', ['names' => ['index' => 'Users.modif_user.index']])->only(['index']);
        // Menu de Consulta de password
        Route::resource('/view_password', 'View_pass_Controller', ['names' => ['index' => 'Users.View_pass.index']])->only(['index']);
        // Menu de Activación de usuario
        Route::resource('/Active_user', 'Active_user_Controller', ['names' => ['index' => 'Users.Active_user.index']])->only(['index']);
        // Menu de Desactivación de usuario
        Route::resource('/Deactive_user', 'Deactive_user_Controller', ['names' => ['index' => 'Users.Deactive_user.index']])->only(['index']);
        // Menu de Cambiar Password de usuario
        Route::resource('/Change_pass', 'Change_pass_Controller', ['names' => ['index' => 'Users.Change_pass.index']])->only(['index']);
        // Menu de Enviar Contraseña
        Route::resource('/Send_pass', 'Send_pass_Controller', ['names' => ['index' => 'Users.Send_pass.index']])->only(['index']);
    }); //Route


    Route::group(['prefix' => 'dispositivos', 'namespace' => 'Dispositivos'], function () {
        // Menu de Alta de dispositivos
        Route::resource('/Alta_disp', 'Alta_dispos_Controller', ['names' => ['index' => 'Dispositivo.Alta_dispos.index']])->only(['index']);
        // Menu de Consulta Dispositivos
        Route::resource('/View_disp', 'View_dispos_Controller', ['names' => ['index' => 'Dispositivo.View_dispos.index']])->only(['index']);
        // Menu de Modificación Dispositivos
        Route::resource('/Modif_disp', 'Modif_dispos_Controller', ['names' => ['index' => 'Dispositivo.Modif_dispos.index']])->only(['index']);
    }); //Route

    Route::group(['prefix' => 'actividades', 'namespace' => 'Actividades'], function () {
        // Menu de Consulta de Actividades
        Route::resource('/View_Activ', 'View_activ_Controller', ['names' => ['index' => 'Actividades.View_activ.index']])->only(['index']);
        // Menu de Modificación de Actividades
        Route::resource('/Modif_Activ', 'Modif_activ_Controller', ['names' => ['index' => 'Actividades.Modif_activ.index']])->only(['index']);
        // Menu de Revisión de Parametros Remedy
        Route::resource('/View_remedy', 'View_Remedy_Controller', ['names' => ['index' => 'Actividades.View_Remedy.index']])->only(['index']);
        // Menu de Calendarización de Actividades
        Route::resource('/Calden_activ', 'Calendar_activ_Controller', ['names' => ['index' => 'Actividades.Calendar_activ.index']])->only(['index']);
        // Menu de Reprogramación de Actividades
        Route::resource('/Reprogeram_activ', 'Program_activ_Controller', ['names' => ['index' => 'Actividades.Program_activ.index']])->only(['index']);
        // Menu de Cancelación de Actividades
        Route::resource('/Cancel_activ', 'Cancel_activ_Controller', ['names' => ['index' => 'Actividades.Cancel_activ.index']])->only(['index']);
    }); //Route

    Route::group(['tickets' => 'actividades', 'namespace' => 'Tickets'], function () {
        // Menu de Consulta de tickets
        Route::resource('/View_Ticket', 'View_Ticket_Controller', ['names' => ['index' => 'Tickets.View_ticket.index']])->only(['index']);
    }); //Route


    /*Sisfen -  Modificación Boveda  */

	Route::group(['prefix' => 'operations', 'namespace' => 'Operations'], function () {

		Route::resource('/imei/valportal', 'ImeiValPortalController', ['names' => ['index' => 'imei.valitation.portal']])->only(['index']);
        Route::resource('/batch', 'BatchOperationsController', ['names' => ['index' => 'batch.index']])->only(['index']);
		Route::post('/batch-load', 'BatchOperationsController@load')->name('batch.load');
		Route::get('/portinbatch-example-download', 'PortinbatchController@download')->name('batch.example.download');
		Route::post('/portinbatch-validate-File', 'PortinbatchController@validateFile')->name('batch.validate.file');
		Route::resource('/portinbatch', 'PortinbatchController', ['names' => ['index' => 'portinbatch.index']])->only(['index']);
		Route::resource('/alta', 'AltaController', ['names' => ['index' => 'imei.alta.index']])->only(['index']);
        Route::get('/call/identify', 'CallsController@identify')->name('imei.call.identify');




        // Este es el ruteo de las APIs que se ocupan
        Route::get('/call/offert', 'CallsController@offert')->name('support.call.offer');
		Route::get('/call/valid', 'CallsController@valid')->name('support.call.valid');
		Route::get('/call/serviceability', 'CallsController@serviceability')->name('support.call.serviceability');
		Route::get('/call/validchoose', 'CallsController@validchoose')->name('support.call.validchoose');
		Route::get('/call/validfeature', 'CallsController@validfeature')->name('support.call.validfeature');
		Route::get('/call/activation', 'CallsController@activation')->name('support.call.activation');
        Route::get('/call/profile', 'CallsController@profile')->name('support.call.profile');
        Route::get('/iot/highConsumptions', 'ConsultaAltoConsumoIoTController@index')->name('iot.home.query-high-consumptions');
        Route::get('/iot/queryHighConsumptions', 'ConsultaAltoConsumoIoTController@queryHighConsumptions')->name('iot.query-high-consumptions');


	});

	Route::post('/support/reset', 'Support\SupportController@reset')->name('support.reset');

});



Auth::routes([
  'register' => false,
  'verify' => true,
  'reset' => false
]);
Route::get('/logout' , 'Auth\LoginController@logout');

Route::get('/support/call/mvo', 'Support\SupportController@mvo')->name('support.call.mvo');

