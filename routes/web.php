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

    /* Modificación Boveda
        Controladores usados en los Menus de Boveda por cada una de sus separaciones
    */
    Route::group(['prefix' => 'batch', 'namespace' => 'Batch'], function () {

        // Menu de Reporte Batch alta
        Route::resource('/batch_alta_report', 'Report_Batch_Controller', ['names' => ['index' => 'batch.altareport.index']])->only(['index']);
        Route::post('/call/batch_alta_report', 'Report_Batch_Controller@search_data_api')->name('batch.call.user_report_alta');

        // Menu de Alta Masiva usurios
        Route::resource('/massive_alta', 'Massive_Batch_Controller', ['names' => ['index' => 'batch.masive_alta.index']])->only(['index']);
        Route::post('/batch-load-alta', 'Massive_Batch_Controller@load')->name('batch.masive_alta.load');
        Route::post('/batch-exec-alta', 'Massive_Batch_Controller@execute')->name('batch.masive_alta.exec');

        // Menu de Reporte Batch baja
        Route::resource('/batch_baja_report', 'Report_Baja_Controller', ['names' => ['index' => 'batch.bajareport.index']])->only(['index']);
        Route::post('/call/batch_baja_report', 'Report_Baja_Controller@search_data_api')->name('batch.call.user_report_baja');

        // Menu de baja Masiva usurios
        Route::resource('/massive_baja', 'Massive_Batch_Baja_Controller', ['names' => ['index' => 'batch.masive_baja.index']])->only(['index']);
        Route::post('/batch-load-baja', 'Massive_Batch_Baja_Controller@load')->name('batch.masive_baja.load');
        Route::post('/batch-exec-baja', 'Massive_Batch_Baja_Controller@execute')->name('batch.masive_baja.exec');

        // Menu de Reporte Batch cambios
        Route::resource('/batch_change_report', 'Report_Change_Controller', ['names' => ['index' => 'batch.changereport.index']])->only(['index']);
        Route::post('/call/batch_change_report', 'Report_Change_Controller@search_data_api')->name('batch.call.user_report_change');

        // Menu de cambios  Masiva usurios
        Route::resource('/massive_change', 'Massive_Batch_Cambio_Controller', ['names' => ['index' => 'batch.masive_change.index']])->only(['index']);
        Route::post('/batch-load-change', 'Massive_Batch_Cambio_Controller@load')->name('batch.masive_change.load');
        Route::post('/batch-exec-change', 'Massive_Batch_Cambio_Controller@execute')->name('batch.masive_change.exec');

    }); //Route

    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {

        // General Funcion de Busqueda de usaurio
        Route::get('/call/Baja_user_search', 'General_User_Controller@search_user')->name('Users.call.user_search');
        // Menu de Alta de usuario
        Route::resource('/Alta_user', 'Alta_user_Controller', ['names' => ['index' => 'Users.alta_user.index']])->only(['index']);
        Route::get('/call/Alta_user', 'Alta_user_Controller@new_user')->name('Users.call.alta_user');
        // Menu de baja de usuario
        Route::resource('/Baja_user', 'Baja_user_Controller', ['names' => ['index' => 'Users.baja_user.index']])->only(['index']);
        Route::get('/call/Baja_user', 'Baja_user_Controller@delete_user')->name('Users.call.user_delete');

        // Menu de Modificación de  de usuario
        Route::resource('/Modif_user', 'Modif_user_Controller', ['names' => ['index' => 'Users.modif_user.index']])->only(['index']);
        Route::get('/call/Modif_user_search', 'Modif_user_Controller@search_user')->name('Users.call.search_complete');
        Route::get('/call/Modif_user', 'Modif_user_Controller@modif_user')->name('Users.call.modif_user');


        // Menu de Consulta de password
        //Route::resource('/view_password', 'View_pass_Controller', ['names' => ['index' => 'Users.View_pass.index']])->only(['index']);
        //Route::get('/call/view_password', 'View_pass_Controller@user_pass')->name('Users.call.view_user_pass');

        // Menu de Activación de usuario
        Route::resource('/Active_user', 'Active_user_Controller', ['names' => ['index' => 'Users.Active_user.index']])->only(['index']);
        Route::get('/call/Active_user', 'Active_user_Controller@user_active')->name('Users.call.user_active');

        // Menu de Desactivación de usuario
        Route::resource('/Deactive_user', 'Deactive_user_Controller', ['names' => ['index' => 'Users.Deactive_user.index']])->only(['index']);
        Route::get('/call/Deactive_user', 'Deactive_user_Controller@user_deactive')->name('Users.call.user_deactive');

        // Menu de Cambiar Password de usuario
        Route::resource('/Change_pass', 'Change_pass_Controller', ['names' => ['index' => 'Users.Change_pass.index']])->only(['index']);
        Route::get('/call/Change_pass', 'Change_pass_Controller@change_pass')->name('Users.call.user_pass');
        // Menu de Enviar Contraseña
        //Route::resource('/Send_pass', 'Send_pass_Controller', ['names' => ['index' => 'Users.Send_pass.index']])->only(['index']);
        // Menu de Alta Masiva usurios
        Route::resource('/Massive_users', 'Massive_SignIn_Controller', ['names' => ['index' => 'Users.Masive_Sign_in.index']])->only(['index']);
    }); //Route

    Route::group(['prefix' => 'access', 'namespace' => 'Access'], function () {


        // Menu de Alta de usuario Manager
        Route::resource('/manager_access', 'Alta_userMan_Controller', ['names' => ['index' => 'access.alta_userman.index']])->only(['index']);
        Route::get('/call/manager_access', 'Alta_userMan_Controller@new_user')->name('Access.call.alta_userman');

        Route::post('/call/catalogos', 'AltaAccessController@getCatalogosList')->name('access.call.catalogos');
        Route::get('/call/new_access_add', 'AltaAccessController@newUser')->name('users.call.alta_access');


        // Menu de Alta de usuario
        Route::resource('/alta_access', 'AltaAccessController', ['names' => ['index' => 'access.alta_user.index']])->only(['index']);
        Route::get('/call/Alta_access', 'Alta_access_Controller@new_user')->name('Users.call.alta_access');
        // Menu de baja de usuario
        Route::resource('/baja_access', 'Baja_access_Controller', ['names' => ['index' => 'Access.baja_user.index']])->only(['index']);
        // Menu de Modificación de  de usuario
        Route::resource('/modif_access', 'Modif_access_Controller', ['names' => ['index' => 'Access.modif_user.index']])->only(['index']);
        // Menu de Consulta de password
        Route::resource('/view_access', 'View_access_Controller', ['names' => ['index' => 'Access.View_pass.index']])->only(['index']);
        // Menu de Activación de usuario
        Route::resource('/active_access', 'Active_access_Controller', ['names' => ['index' => 'Access.Active_user.index']])->only(['index']);
        // Menu de Desactivación de usuario
        Route::resource('/deactive_access', 'Deactive_access_Controller', ['names' => ['index' => 'Access.Deactive_user.index']])->only(['index']);
        // Menu de Cambiar Password de usuario
        Route::resource('/change_access', 'Change_access_Controller', ['names' => ['index' => 'Access.Change_pass.index']])->only(['index']);
        // Menu de Enviar Contraseña
        Route::resource('/send_access', 'Send_access_Controller', ['names' => ['index' => 'Access.Send_pass.index']])->only(['index']);
        // Menu de Alta Masiva usurios
        Route::resource('/massive_access', 'Massive_access_Controller', ['names' => ['index' => 'Access.Masive_Sign_in.index']])->only(['index']);

        // Reporte de usuarios dispositivos
        // 2021/01/04
        Route::resource('/report_access_disp', 'Report_userdisp_Controller', ['names' => ['index' => 'access.report_userdisp.index']])->only(['index']);
        Route::post('/call/access_user_report', 'Report_userdisp_Controller@search_data_api')->name('access.call.report_userdisp');
        Route::post('/call/access_user_baja', 'Report_userdisp_Controller@baja_api_call')->name('access.call.report_baja');
        Route::post('/call/access_user_camb', 'Report_userdisp_Controller@cambio_api_call')->name('access.call.report_camb');


        // Alta Catalogo dispositivos
        // 2021/01/06
        Route::resource('/insert_disp_catalog', 'Insert_dispcatalog_Controller', ['names' => ['index' => 'access.insert_dispcatalog.index']])->only(['index']);
        Route::post('/call/insert_disp_catalog', 'Insert_dispcatalog_Controller@update_data_api')->name('access.call.insert_dispcatalog');
        // Modificación Catalogo dispositivos
        // 2021/01/04
        Route::resource('/update_disp_catalog', 'Update_dispcatalog_Controller', ['names' => ['index' => 'access.update_dispcatalog.index']])->only(['index']);
        Route::post('/call/search_disp_catalog', 'Update_dispcatalog_Controller@search_data_api')->name('access.call.search_dispcatalog');
        Route::post('/call/update_disp_catalog', 'Update_dispcatalog_Controller@update_data_api')->name('access.call.update_dispcatalog');

        // Carga Masiva Catalogo Dispositivos
        // Modificación Catalogo dispositivos
        // 2021/01/12
        Route::resource('/massive_disp_catalog', 'Massive_update_dispcatalog_Controller', ['names' => ['index' => 'access.massive_dispcatalog.index']])->only(['index']);
        Route::post('/access-load-dispcatalog', 'Massive_update_dispcatalog_Controller@load')->name('access.masive_dispcatalog.load');
        Route::post('/acess-exec-dispcatalog', 'Massive_update_dispcatalog_Controller@execute')->name('access.masive_dispcatalog.exec');

    }); //Route


    Route::group(['prefix' => 'dispositivos', 'namespace' => 'Dispositivos'], function () {
        // Menu de Alta de dispositivos
        Route::resource('/Alta_disp', 'Alta_dispos_Controller', ['names' => ['index' => 'Dispositivo.Alta_dispos.index']])->only(['index']);
        // Menu de Consulta Dispositivos
        Route::resource('/View_disp', 'View_dispos_Controller', ['names' => ['index' => 'Dispositivo.View_dispos.index']])->only(['index']);
        // Menu de Modificación Dispositivos
        Route::resource('/Modif_disp', 'Modif_dispos_Controller', ['names' => ['index' => 'Dispositivo.Modif_dispos.index']])->only(['index']);
        // Menu de Alta Masiva Dispositivos
        Route::resource('/Massive_creation', 'Massive_Creation_Controller', ['names' => ['index' => 'Dispositivo.Masive_creation.index']])->only(['index']);

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
