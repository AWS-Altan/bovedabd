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

        // Menu de Rotación Masiva usurios
        Route::resource('/massive_rotate', 'Massive_Batch_Cambio_Rotate', ['names' => ['index' => 'batch.masive_rotate.index']])->only(['index']);
        Route::post('/batch-load-rotate', 'Massive_Batch_Cambio_Rotate@load')->name('batch.masive_rotate.load');
        Route::post('/batch-exec-rotate', 'Massive_Batch_Cambio_Rotate@execute')->name('batch.masive_rotate.exec');

        // Menu de Cierre de Secion Masiva usurios
        Route::resource('/massive_ensec', 'Massive_Batch_Cambio_Endsec', ['names' => ['index' => 'batch.masive_endsec.index']])->only(['index']);
        Route::post('/batch-load-ensec', 'Massive_Batch_Cambio_Endsec@load')->name('batch.masive_endsec.load');
        Route::post('/batch-exec-ensec', 'Massive_Batch_Cambio_Endsec@execute')->name('batch.masive_endsec.exec');


    }); //Route

    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {

        // General Funcion de Busqueda de usaurio
        Route::get('/call/Baja_user_search', 'General_User_Controller@search_user')->name('Users.call.user_search');
        // Menu de Alta de usuario
        Route::resource('/Alta_user', 'Alta_user_Controller', ['names' => ['index' => 'Users.alta_user.index']])->only(['index']);
        Route::post('/call/Alta_Internal', 'Alta_user_Controller@new_user')->name('Users.call.alta_internaluser');
        Route::post('/call/catalogs_user', 'Alta_user_Controller@calatog_view')->name('Users.call.catalogs_view');
        // Menu de Alta de solicitante
        Route::resource('/Alta_Solic', 'Alta_solic_Controller', ['names' => ['index' => 'Users.alta_solic.index']])->only(['index']);
        Route::post('/call/Alta_Intersolic', 'Alta_solic_Controller@new_user')->name('Users.call.alta_internalsolic');
        Route::post('/call/catalogs_solic', 'Alta_solic_Controller@calatog_view')->name('Users.call.catalogs_view_solic');
        // Menu de baja de usuario
        Route::resource('/Baja_user', 'Baja_user_Controller', ['names' => ['index' => 'Users.baja_user.index']])->only(['index']);
        Route::post('/call/Change_Status', 'Baja_user_Controller@change_status')->name('Users.call.Change_status');
        // Menu de baja de solicitante
        Route::resource('/Baja_solic', 'Baja_solic_Controller', ['names' => ['index' => 'Users.baja_solic.index']])->only(['index']);
        Route::post('/call/Change_StatSolic', 'Baja_solic_Controller@change_status')->name('Users.call.Change_solstatus');

        // Menu de Modificación de  de usuario
        Route::resource('/Modif_user', 'Modif_user_Controller', ['names' => ['index' => 'Users.modif_user.index']])->only(['index']);
        Route::get('/call/Modif_user_search', 'Modif_user_Controller@search_user')->name('Users.call.search_complete');
        Route::post('/call/Modif_user', 'Modif_user_Controller@modif_user')->name('Users.call.modif_user');

        //Menu de Alta de solicitantes -- Users.alta_solicitantes.index
        Route::resource('/Alta_Soliciante', 'Alta_solicitante_Controller', ['names' => ['index' => 'Users.alta_solicitantes.index']])->only(['index']);
        Route::post('/call/Alta_Soliciante', 'Alta_solicitante_Controller@new_user')->name('Users.call.alta_user');

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
        Route::post('/Massive_users_input', 'Massive_Batch_Cambio_Controller@load')->name('batch.masive_sign.load');
        Route::post('/Massive_users_exec', 'Massive_Batch_Cambio_Controller@execute')->name('batch.masive_sign.exec');

        // Menu de cambios de solicitantes
        Route::resource('/Modif_solic', 'Modif_solicitantes_Controller', ['names' => ['index' => 'Users.modif_solic.index']])->only(['index']);
        Route::post('/call/Modif_solicit', 'Modif_solicitantes_Controller@modif_user')->name('Users.call.modif_solicit');

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
        Route::post('/call/access_user_rotate', 'Report_userdisp_Controller@rotate_api_call')->name('access.call.report_rotate');
        Route::post('/call/session_force', 'Report_userdisp_Controller@session_force_call')->name('access.call.session_force');
        Route::post('/call/gettipodisp', 'Report_userdisp_Controller@fun_get_tipo_Dispositivo')->name('access.call.tipo_disp_cat');
        Route::post('/call/recuppass', 'Report_userdisp_Controller@fun_pass_recup')->name('access.call.recup_pass');


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

        //2021/07/28 - Acrtualización GUI - JLDS
        Route::resource('/rep_equip_catalog', 'Rep_EquipCat_Controller', ['names' => ['index' => 'access.report_equip_catalog.index']])->only(['index']);
        Route::get('/call/rep_equip_catalog', 'Rep_EquipCat_Controller@search_data_api')->name('access.call.report_equip_catalog');


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
        Route::post('/call/View_Activ', 'View_activ_Controller@search_data_api')->name('actividades.call.view_activ');
        // Menu de Modificación de Actividades
        Route::resource('/Modif_Activ', 'Modif_activ_Controller', ['names' => ['index' => 'Actividades.Modif_activ.index']])->only(['index']);
        // Menu de Revisión de Parametros Remedy
        Route::resource('/View_remedy', 'View_Remedy_Controller', ['names' => ['index' => 'Actividades.View_Remedy.index']])->only(['index']);
        Route::post('/call/View_remedy_report', 'View_Remedy_Controller@search_data_api')->name('actividades.call.view_remedy');




        // Menu de Calendarización de Actividades
        Route::resource('/Calden_activ', 'Calendar_activ_Controller', ['names' => ['index' => 'Actividades.Calendar_activ.index']])->only(['index']);
        // Menu de Reprogramación de Actividades
        Route::resource('/Reprogeram_activ', 'Program_activ_Controller', ['names' => ['index' => 'Actividades.Program_activ.index']])->only(['index']);
        // Menu de Cancelación de Actividades
        Route::resource('/Cancel_activ', 'Cancel_activ_Controller', ['names' => ['index' => 'Actividades.Cancel_activ.index']])->only(['index']);
    }); //Route

    Route::group(['tickets' => 'actividades', 'namespace' => 'Tickets'], function () {
        // Menu de Consulta de tickets
        Route::resource('/View_Ticket_Cons', 'View_Ticket_Rel_Controller', ['names' => ['index' => 'Tickets.View_ticket_cons.index']])->only(['index']);
        Route::post('/call/View_Ticket_Cons', 'View_Ticket_Rel_Controller@search_data_api')->name('actividades.call.view_ticket');

        // Menu de Consulta de tickets- para boton rojo
        Route::resource('/View_Ticket', 'ViewTicketController', ['names' => ['index' => 'Tickets.View_ticket.index']])->only(['index']);
        Route::post('/call/ticket-list', 'ViewTicketController@getList')->name('tickets.call.list');
        Route::post('/call/ticket-actionsredbutton', 'ViewTicketController@actionsRedButton')->name('tickets.call.actionsredbutton');


    }); //Route

    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
        Route::resource('/general-activity', 'GeneralActivityReportController', ['names' => ['index' => 'Actividades.general-report.index']])->only(['index']);

        Route::post('/call/activity-list', 'GeneralActivityReportController@getList')->name('call.generalactivity-list');

    }); 



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
  'verify' => false,
  'reset' => false
]);
Route::get('/logout' , 'Auth\LoginController@logout');

Route::get('/support/call/mvo', 'Support\SupportController@mvo')->name('support.call.mvo');
