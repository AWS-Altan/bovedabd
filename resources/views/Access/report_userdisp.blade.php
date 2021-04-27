@extends('layouts.app')

@section('content')
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
                    <div id="example-basic">
						<h3><span class="head-font capitalize-font">Reporte de Usuarios dispositivos </span></h3>
						<section>
                            <form id="step_two">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.table_user_disp_report')
                                    </div>
                                    <br><br>
                                    Seleccione otros criterios de busqueda:
                                    <br><br>
                                    <!-- Vigencia del usuario -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Fecha Inicio:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDateini" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <!-- Vigencia del usuario -->
                                    <div class="col-sm-2 mb-20">
                                        <label class="help-block text-left">Fecha Final:</label>
                                    </div>
                                    <div class="col-sm-4 mb-20 select select-group" >
                                        <input type='date' id="txtDatefin" class="inputCal" value="" /> <label id="cleardate" onclick="cleardate()"> Limpiar fecha </label>
                                        <div class="help-block with-errors" id="inputTxtDateError"></div>
                                    </div>
                                    <br><br>
                                    Criterios Adicionales:
                                    <br><br>
                                    <div class="col-sm-1">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio5" value="option1" Onclick="TipoDato4('ip')">
                                            <label for="radio5" style="margin-bottom: 0px;">
                                                IP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio6" value="option2" Onclick="TipoDato4('hostname')">
                                            <label for="radio6" style="margin-bottom: 0px;">
                                                HOSTNAME
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio7" value="option3" Onclick="TipoDato4('hostname')">
                                            <label for="radio7" style="margin-bottom: 0px;">
                                                USUARIO
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio8" value="option4" Onclick="TipoDato4('hostname')">
                                            <label for="radio8" style="margin-bottom: 0px;">
                                                SOLICITANTE
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="radio radio-info" style="padding-top: 10px;">
                                            <input type="radio" name="radio1" id="radio9" value="option5" Onclick="TipoDato4('hostname')">
                                            <label for="radio8" style="margin-bottom: 0px;">
                                                STATUS
                                            </label>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-sm-1">
                                        <div class="form-wrap" style="display: inline-block; width: 320px">
                                                <form id="form_identify">
                                                    <div class="form-group">
                                                        <input type="text" data-minlength="10" class="form-control" id="inputData" placeholder="Ingrese valor a consultar" data-error="Valor inv�lido" maxlength="150">
                                                        <div class="help-block with-errors" id="inputMSISDNError"></div>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Texto de Menajes -->
                            <div class="row" id="message_error">
            				</div>
                        </section>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection


<!-- Inicio la programación del estilo -->
@section('jsfree')
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!--librerias para los botones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!--librerias para el boton del pdf -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>


<style type="text/css">
	.wizard > .steps > ul > li{
		    width: 45%;
    }


</style>
<script>




    // funcion para cambio de pestaña
    function ValidateNext() {
        fun_ejecuta_busqueda();
        return true;
    }

    //funcion que mando a llamar para poder mandar la peticion debaja en el boton de baja de la tabla
    function fun_report_baja( sJLip_value, sJLuser_value, sJLipodisp_value){

        console.log(' mando a API IP_baja '+ sJLip_value + ' user_baja ' + sJLuser_value + ' id_disp_baja ' + sJLipodisp_value);

        var jsonborra = {
            "ip": sJLip_value,
            "usuario": sJLuser_value,
            "idtipo_disp": sJLipodisp_value,
            "operacion": "online"
        };

        $.ajax({
            url: "{{ route('access.call.report_baja') }}",
            type: 'POST',
            contentType: "application/json",
            data: jsonborra
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("ejecución boton de borrado " + obj.status);

        })
        .fail(function() {
            //algo
            console.log("Falla boton borrado ");
        })
        .always(function() {
            //algo
            console.log("Boton Borrado allways ");
        });
        return obj;

    }//fun_report_baja

    function fun_report_cambio( sJLip_value, sJLuser_value, sJLipodisp_value,sJLidperf_value){
        console.log(' mando a API IP_Camio '+ sJLip_value + ' user_baja ' + sJLuser_value + ' id_disp_baja ' + sJLipodisp_value);

        var jsonchange = {
            "ip": sJLip_value,
            "usuario": sJLuser_value,
            "idtipo_disp": sJLipodisp_value,
            "id_perfil": sJLidperf_value,
            "operacion": "online"
        };

        $.ajax({
            url: "{{ route('access.call.report_camb') }}",
            type: 'POST',
            contentType: "application/json",
            data: jsonchange
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("Ejecución Boton Cambio " + obj.status);

        })
        .fail(function() {
            //algo
            console.log("Error Boton cambio ");
        })
        .always(function() {
            //algo
            console.log("Boton cambio always ");
        });
        return obj;

    }//fun_report_cambio

    function fun_report_rotar( sJLip_value, sJLuser_value, sJLipodisp_value, txtJLcontr, txtJLperf){

        console.log(' mando a API IP_rotar '+ sJLip_value + ' user_rota ' + sJLuser_value + ' id_disp_rota ' + sJLipodisp_value + 'passw' + txtJLcontr);

        /*
        var jsonrota = {
            "ip": sJLip_value,
            "user": sJLuser_value,
            "id_disp": sJLipodisp_value,
            "passw": txtJLcontr
        };
        */

        var json = {};
            json.ip= sJLip_value;
            json.usuario= sJLuser_value;
            json.idtipo_disp= ""+sJLipodisp_value+"";
            json.passw= txtJLcontr;
            json.operacion= "online";
            json.id_perfil= txtJLperf;

        $.ajax({
            url: "{{ route('access.call.report_rotate') }}",
            async: false,
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(json)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            console.log("ejecución boton de rotado " + obj.status);

        })
        .fail(function() {
            //algo
            console.log("Falla boton Rotación ");
        })
        .always(function() {
            //algo
            console.log("Boton rotado allways ");
        });
        return obj;
    }//fun_report_rotar

    function fun_report_force( sJLip_value, sJLuser_value, sJLipodisp_value){

        console.log('forzado sesion IP:'+ sJLip_value + ' user: ' + sJLuser_value + ' id_disp:' + sJLipodisp_value);


        var json = {};
            json.ip= sJLip_value;
            json.usuario= sJLuser_value;
            json.idtipo_disp= ""+sJLipodisp_value+"";
            json.operacion= "batch";

        $.blockUI({ message: 'Procesando ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });

        $.ajax({
            url: "{{ route('access.call.session_force') }}",
            async: false,
            type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(json)
        })
        .done(function(response) {
            obj = jQuery.parseJSON(response);

            console.log("ejecución boton de forzado de sesion " + obj.status);
            console.log(obj);

        })
        .fail(function() {
            console.log("Falla boton forzado de sesion ");
            $.unblockUI();
        })
        .always(function() {
            console.log("Boton forzado de sesion ");
            $.unblockUI();
        });
        return obj;
    }


    // furncion para ejecutar busqueda
    function fun_ejecuta_busqueda()
    {

        //limpio los textos
        $('#message_error').empty();
        //realizo el bloqueo de pantalla
        $.blockUI({ message: 'Procesando ...',css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });

        //Ejecuto la busqueda del dato, armo la busqueda
        var sJL_mail = '{{app('auth')->user()->email}}';

		var data = {};
        data.type   = "alta";
        data.mail   = sJL_mail;
        if( $('#txtDateini' ).val() != '' && $('#txtDatefin' ).val() != '')
        {
            data.fecha_ini = $('#txtDateini' ).val();
            data.fecha_fin = $('#txtDatefin' ).val()
        }
        if(document.getElementById('radio5').checked)
        {
            data.IP = $('#inputData').val();
        }//if
        if(document.getElementById('radio6').checked)
        {
            data.hostname = $('#inputData').val();
        }//if
        if(document.getElementById('radio7').checked)
        {
            data.user = $('#inputData').val();
        }//if
        if(document.getElementById('radio8').checked)
        {
            data.solicitante = $('#inputData').val();
        }//if
        if(document.getElementById('radio9').checked)
        {
            data.status = $('#inputData').val();
        }//if

        //Hago el manejo de la tabla
        $.ajax({
			url: "{{ route('access.call.report_userdisp') }}",
			type: 'POST',
            contentType: "application/json",
            data: JSON.stringify(data)
		})
        .done(function(response) {
            obj = jQuery.parseJSON(response);
            if (obj.status = "ok")
            {
                if(obj.data != "No Data Return")
                {

                    data = jQuery.parseJSON(obj.data);
                    if (typeof(datatableInstance)!== 'undefined')
                    {
                        datatableInstance.destroy();
                    } //if

                    var $sjl_acciones = null;

                    var datatableInstance
                    datatableInstance = $('table#Tbl_usrdisp').DataTable({
                        "data": data,
                        "pageLength": 10,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [
                            {
                                //Campo de IP
                                "name": "cols_IP",
                                "data": "send_ip"
                            },
                            {
                                //Campo de HOST
                                "name": "cols_host",
                                "data": "send_host"
                            },
                            {
                                //Tipo Dispositivo
                                "name": "cols_tipdisp",
                                "data": "send_idtipodisp"
                            },
                            {
                                //GRUPO
                                "name": "cols_grupo",
                                "data": "send_idgrupo"
                            },
                            {
                                //USUARIO
                                "name": "cols_user",
                                "data": "send_usuario"
                            },
                            {
                                //TIPO USUARIO
                                "name": "cols_tipuser",
                                "data": "send_idtipo"
                            },
                            {
                                //STATUS
                                "name": "cols_status",
                                "data": "send_idstatus"
                            },
                            {
                                //PERFIL
                                "name": "cols_",
                                "data": "send_idperfil"
                            },
                            {
                                //SOLICITANTE
                                "name": "cols_soli",
                                "data": "send_idsolicitante"
                            },
                            {
                                //FECHA INGRESO
                                "name": "cols_feching",
                                "data": "send_fechaIngreso"
                            },
                            {
                                //FECHA Termino
                                "name": "cols_fechter",
                                "data": "send_fechaTermino"
                            },
                            {
                                "name": "acciones",
                                "data": $sjl_acciones,
                                "render" : function(data)
                                {
                                    if(!$sjl_acciones)
                                    {
                                        console.log('No hay data acciones' + $sjl_acciones);
                                        //data = '<a href=""  class="editor_ticket">' + data + '</a>';
                                        data = '<a id="idrotate_href" href="" class="editor_rotar" ><span class="btn-small" style="color:#9E1D22;">Rotar Password</span></a> / <a href="" class="editor_edit"><span class="btn-small" style="color:#9E1D22;">Cambio</span></a> / <a href="" class="editor_remove"><span class="btn-small" style="color:#9E1D22;">Baja</span></a>/ <a href="" class="editor_force"><span class="btn-small" style="color:#9E1D22;">Forzado Sesión</span></a>';
                                    }else
                                    {
                                        console.log('haria cambio' + $sjl_acciones);
                                        data = 'Rotar Password / <a href="" class="editor_edit"><span class="btn-small" style="color:#9E1D22;">Cambio</span></a> / <a href="" class="editor_remove"><span class="btn-small" style="color:#9E1D22;">Baja</span></a>/ <a href="" class="editor_force"><span class="btn-small" style="color:#9E1D22;">Forzado Sesión</span></a>';
                                    }//else
                                    return data;
                                }
                                //"defaultContent": '<a id="idrotate_href" href="" class="editor_rotar" ><span class="btn-small" style="color:#9E1D22;">Rotar Password</span></a> / <a href="" class="editor_edit"><span class="btn-small" style="color:#9E1D22;">Cambio</span></a> / <a href="" class="editor_remove"><span class="btn-small" style="color:#9E1D22;">Baja</span></a>/ <a href="" class="editor_force"><span class="btn-small" style="color:#9E1D22;">Forzado Sesión</span></a>'
                            },
                            {
                                //id_tipo dispositivo
                                "name": "cols_idtipodisp2",
                                "data": "send_idtipodisp2",
                                "visible": false
                            },
                            {
                                //id perfil
                                "name": "cols_idperfil2",
                                "data": "send_idperfil2",
                                "visible": false
                            },
                            {
                                //perfil_choose
                                "name": "cols_profile_change",
                                "data": "send_profile_change",
                                "visible": false
                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ]
                    });

                    // Opcion de Borrado

                    $('table#Tbl_usrdisp').on('click', 'a.editor_remove', function (e) {
                        e.preventDefault(); //para eviar redirect
                        var row = datatableInstance.row($(this).closest('tr'));
                        //console.log('row '+row);

                        //Obtengo los datos para el borrado
                        var sJLip_value = row.data()['send_ip'];
                        var sJLuser_value = row.data()['send_usuario'];
                        var sJLipodisp_value = row.data()['send_idtipodisp2'];
                        console.log('IP '+ sJLip_value + ' user ' + sJLuser_value + ' id_disp ' + sJLipodisp_value);


                        $.confirm({
                            title: 'Borrado de Registro',
                            content: '¿Desea Enviar la solucitud de borrado de Registro para la IP ' + sJLip_value + '?',
                            buttons: {
                                Confirmar: {
                                    text: 'Confirmar',
                                    btnClass: 'btn-red',
                                    keys: ['enter', 'shift'],
                                    action: function()
                                    {
                                        obj = fun_report_baja( sJLip_value, sJLuser_value, sJLipodisp_value);
                                        $.alert('Confirmación de Aplicación Status: ' + obj.status + " Descripción: " + obj.description);
                                    } //action
                                },
                                Cancelar: {
                                    text: 'Cancelar',
                                    btnClass: 'btn-red',
                                    keys: ['enter', 'shift'],
                                }
                            }
                        });


                    } );

                    // Edit record
                    $('table#Tbl_usrdisp').on('click', 'a.editor_edit', function (e) {
                        e.preventDefault();
                        var row = datatableInstance.row($(this).closest('tr'));
                        console.log('row '+row);

                        var sJLip_value = row.data()['send_ip'];
                        var sJLuser_value = row.data()['send_usuario'];
                        var sJLipodisp_value = row.data()['send_idtipodisp2'];
                        var sJLidperf_value = row.data()['send_idperfil2'];
                        var sJLiprofchange_value = row.data()['send_profile_change'];
                        console.log('IP '+ sJLip_value + 'user ' + sJLuser_value + ' id_disp ' + sJLipodisp_value + ' id perfil ' + sJLidperf_value + ' puede camb ' + sJLiprofchange_value );


                        //inicio extracción de perfiles
                        sJLiprofchange_value = sJLiprofchange_value.replace(/[^a-zA-Z0-9,]/g, '');
                        aJL_profiles=sJLiprofchange_value.split(',');
                        console.log('Puede camb2: ' + sJLiprofchange_value + ' arreglo:' + aJL_profiles );

                        sjL_detailCP_text = '<form action="" class="formName">';
                        sjL_detailCP_text += '<div class="form-group">';
                        sjL_detailCP_text += '<label>Tipo Dispositivo</label>';
                        sjL_detailCP_text += '<input type="text" placeholder="Dispositivo" class="txtdisp form-control" required />';
                        sjL_detailCP_text += '<label class="control-label mb-10" for="cbo_profile1">Actualización de Perfil</label>';
                        sjL_detailCP_text += '<select id="cbo_profile1" class="form-control" name="cbo_profile1">';

                        aJL_profiles.forEach(function(iJL_perfil)
                        {
                             console.log(iJL_perfil);

                            //1	Manager Seguridad
                            if (iJL_perfil==1)
                            {
                                sjL_detailCP_text += '<option value="1">Manager Seguridad</option>';
                            }//if
                            //2	Solicitante de Acceso
                            if (iJL_perfil==2)
                            {
                                sjL_detailCP_text += '<option value="2">Solicitante de Acceso</option>';
                            }//if
                            //3	Manager SOC
                            if (iJL_perfil==3)
                            {
                                sjL_detailCP_text += '<option value="3">Manager SOC</option>';
                            }//if
                            //4	Operacion SOC
                            if (iJL_perfil==4)
                            {
                                sjL_detailCP_text += '<option value="4">Operacion SOC</option>';
                            }//if
                            //5	Operacion Seguridad Aprobador
                            if (iJL_perfil==5)
                            {
                                sjL_detailCP_text += '<option value="5">Operacion Seguridad Aprobador</option>';
                            }//if
                            //6	Operacion SOC Aprobador
                            if (iJL_perfil==6)
                            {
                                sjL_detailCP_text += '<option value="6">Operacion SOC Aprobador</option>';
                            }//if
                            //7	Read Only / Lectura
                            if (iJL_perfil==7)
                            {
                                sjL_detailCP_text += '<option value="7">Read Only - Lectura</option>';
                            }//if
                            //8	admin / read-write/ escritura
                            if (iJL_perfil==8)
                            {
                                sjL_detailCP_text += '<option value="8">admin - read-write - escritura</option>';
                            }//if
                            //9	Trace
                            if (iJL_perfil==9)
                            {
                                sjL_detailCP_text += '<option value="9">Trace</option>';
                            }//if
                            //10	Admin Boveda
                            if (iJL_perfil==10)
                            {
                                sjL_detailCP_text += '<option value="10">Admin Boveda</option>';
                            }//if
                            //11	Admin System / root
                            if (iJL_perfil==11)
                            {
                                sjL_detailCP_text += '<option value="11">Admin System - root</option>';
                            }//if
                            //13	Purge
                            if (iJL_perfil==12)
                            {
                                sjL_detailCP_text += '<option value="12">Purge</option>';
                            }//if
                            //14	GUI
                            if (iJL_perfil==13)
                            {
                                sjL_detailCP_text += '<option value="13">GUI</option>';
                            }//if

                        });
                        sjL_detailCP_text += '</div>';
                        sjL_detailCP_text += '</form>';

                        //inicia boton
                        $.confirm({
                            title: 'Proporcione los siguientes datos',
                            content: sjL_detailCP_text,
                            buttons: {
                                formSubmit: {
                                    text: 'Actualizar',
                                    btnClass: 'btn-red',
                                    action: function () {
                                        var txtJLdisp = this.$content.find('.txtdisp').val();
                                        var txtJLperf = $('#cbo_profile1 option:selected').val();
                                        console.log('información-' + txtJLdisp + '-' + txtJLperf + '-');
                                        if(!txtJLdisp || !txtJLperf){
                                            $.alert('Coloque información valida');
                                            return false;
                                        }
                                        obj = fun_report_cambio( sJLip_value, sJLuser_value, txtJLdisp,txtJLperf)
                                        $.alert('Confirmación de Aplicación Status: ' + obj.status );
                                    }
                                },
                                Cancelar: function () {
                                    //close
                                },
                            },
                            onContentReady: function () {
                                // bind to events
                                var jc = this;
                                this.$content.find('form').on('submit', function (e) {
                                    // if the user submits the form by pressing enter in the field.
                                    e.preventDefault();
                                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                                });
                            }
                        }); // Boton

                    } );

                    //rotar_disabled
                    $('table#Tbl_usrdisp').on('click', 'a.rotar_disabled', function (e)
                    {
                        e.preventDefault();
                        $.alert('disabled: ');
                    });//rotar_disabled

                    // Rotar Password
                    $('table#Tbl_usrdisp').on('click', 'a.editor_rotar', function (e)
                    {
                        //if ($(this).hasClass("disabled"))
                        //{
                            //prevengo de que no se rellame la pantalla
                            e.preventDefault();
                            //obtengo los datos
                            var row = datatableInstance.row($(this).closest('tr'));
                            console.log('row '+row);
                            var sJLip_value = row.data()['send_ip'];
                            var sJLuser_value = row.data()['send_usuario'];
                            var sJLipodisp_value = row.data()['send_idtipodisp2'];
                            var sJLiprofchange_value = row.data()['send_profile_change'];



                            console.log('IP '+ sJLip_value + ' user ' + sJLuser_value + ' id_disp ' + sJLipodisp_value + ' puede camb ' + sJLiprofchange_value );
                            //inicio extracción de perfiles
                            sJLiprofchange_value = sJLiprofchange_value.replace(/[^a-zA-Z0-9,]/g, '');
                            aJL_profiles=sJLiprofchange_value.split(',');
                            console.log('Puede camb2: ' + sJLiprofchange_value + ' arreglo:' + aJL_profiles );

                            sjL_detailCP_text = '<form action="" class="formName">';
                            sjL_detailCP_text += '<div class="form-group">';
                            sjL_detailCP_text += '<label>Proporcione la nueva contraseña</label>';
                            sjL_detailCP_text += '<input type="text" placeholder="Contraseña" class="txtcontr form-control" required />';
                            sjL_detailCP_text += '<label class="control-label mb-10" for="cbo_profile2">Actualización de Perfil</label>';
                            sjL_detailCP_text += '<select id="cbo_profile2" class="form-control" name="cbo_profile2">';

                            aJL_profiles.forEach(function(iJL_perfil)
                            {
                                console.log(iJL_perfil);

                                //1	Manager Seguridad
                                if (iJL_perfil==1)
                                {
                                    sjL_detailCP_text += '<option value="1">Manager Seguridad</option>';
                                }//if
                                //2	Solicitante de Acceso
                                if (iJL_perfil==2)
                                {
                                    sjL_detailCP_text += '<option value="2">Solicitante de Acceso</option>';
                                }//if
                                //3	Manager SOC
                                if (iJL_perfil==3)
                                {
                                    sjL_detailCP_text += '<option value="3">Manager SOC</option>';
                                }//if
                                //4	Operacion SOC
                                if (iJL_perfil==4)
                                {
                                    sjL_detailCP_text += '<option value="4">Operacion SOC</option>';
                                }//if
                                //5	Operacion Seguridad Aprobador
                                if (iJL_perfil==5)
                                {
                                    sjL_detailCP_text += '<option value="5">Operacion Seguridad Aprobador</option>';
                                }//if
                                //6	Operacion SOC Aprobador
                                if (iJL_perfil==6)
                                {
                                    sjL_detailCP_text += '<option value="6">Operacion SOC Aprobador</option>';
                                }//if
                                //7	Read Only / Lectura
                                if (iJL_perfil==7)
                                {
                                    sjL_detailCP_text += '<option value="7">Read Only - Lectura</option>';
                                }//if
                                //8	admin / read-write/ escritura
                                if (iJL_perfil==8)
                                {
                                    sjL_detailCP_text += '<option value="8">admin - read-write - escritura</option>';
                                }//if
                                //9	Trace
                                if (iJL_perfil==9)
                                {
                                    sjL_detailCP_text += '<option value="9">Trace</option>';
                                }//if
                                //10	Admin Boveda
                                if (iJL_perfil==10)
                                {
                                    sjL_detailCP_text += '<option value="10">Admin Boveda</option>';
                                }//if
                                //11	Admin System / root
                                if (iJL_perfil==11)
                                {
                                    sjL_detailCP_text += '<option value="11">Admin System - root</option>';
                                }//if
                                //13	Purge
                                if (iJL_perfil==12)
                                {
                                    sjL_detailCP_text += '<option value="12">Purge</option>';
                                }//if
                                //14	GUI
                                if (iJL_perfil==13)
                                {
                                    sjL_detailCP_text += '<option value="13">GUI</option>';
                                }//if

                            });


                            sjL_detailCP_text += '</div>';
                            sjL_detailCP_text += '</form>';

                            //inicio de boton
                            $.confirm({
                                title: 'Rotación de Password',
                                content: 'Desea solicitar el rotado de password?',
                                content: sjL_detailCP_text,
                                buttons: {
                                    Confirmar: {
                                        text: 'Confirmar',
                                        btnClass: 'btn-red',
                                        keys: ['enter', 'shift'],
                                        action: function(){
                                            var txtJLcontr = this.$content.find('.txtcontr').val();
                                            var txtJLperf = $('#cbo_profile2 option:selected').val();
                                            console.log('información-' + txtJLcontr + '-' + txtJLperf + '-');
                                            if(!txtJLcontr){
                                                $.alert('Coloque información valida');
                                                return false;
                                            }
                                            obj21 = fun_report_rotar( sJLip_value, sJLuser_value, sJLipodisp_value, txtJLcontr,txtJLperf)
                                            console.log('obj21');
                                            console.log(obj21);
                                            $.alert('Confirmación de Aplicación Status: ' + obj21.status );
                                            console.log('deshabilito');
                                            row.data()['acciones'] = '';
                                            //row.cell(row,1).data('hola').draw();
                                            $sjl_acciones = 'hola';
                                            row.cell(row,11).data('hola').draw();
                                        }
                                    },
                                    Cancelar: {
                                        text: 'Cancelar',
                                        btnClass: 'btn-red',
                                        keys: ['enter', 'shift'],
                                        action: function()
                                        {
                                            console.log('cancelo');
                                        }
                                    }
                                }
                            }); //fin de boton


                        //}
                        //$(this).addClass("disabled")


                    } );//editor_rotar

                    // Termino de seson
                    $('table#Tbl_usrdisp').on('click', 'a.editor_force', function (e) {
                        //prevengo de que no se rellame la pantalla
                        e.preventDefault();
                        //obtengo los datos
                        var row = datatableInstance.row($(this).closest('tr'));
                        console.log('Forzado cierre row '+row);
                        var sJLip_value = row.data()['send_ip'];
                        var sJLuser_value = row.data()['send_usuario'];
                        var sJLipodisp_value = row.data()['send_idtipodisp2'];
                        console.log('IP '+ sJLip_value + ' user ' + sJLuser_value + ' id_disp ' + sJLipodisp_value);
                        //inicio de boton
                        $.confirm({
                            title: 'Forzado de Sesion',
                            content: '¿Desea solicitar el cierre forzado de la sesión?',
                            content: '' +
                            '<label>Favor de confirmar</label>',
                            buttons: {
                                Confirmar: {
                                    text: 'Confirmar',
                                    btnClass: 'btn-red',
                                    keys: ['enter', 'shift'],
                                    action: function(){

                                        obj22 = fun_report_force( sJLip_value, sJLuser_value, sJLipodisp_value)
                                        console.log('obj22');
                                        console.log(obj22);
                                        $.alert('Cierre, forzado de sesión: ' + obj22.status.toUpperCase() );

                                    }
                                },
                                Cancelar: {
                                    text: 'Cancelar',
                                    btnClass: 'btn-red',
                                    keys: ['enter', 'shift'],
                                }
                            }
                        }); //fin de boton

                        //var column = datatableInstance.column($(this).attr('data-column'));
                        //column.visible( ! column.visible() );
                    } );

                }else {
                    $("#message_error").text("No hay datos para Mostrar, seleccione una fecha");
                } //else
            } else
            {
			    $("#message_error").css('color', '#f73414');
                $("#message_error").text("Por favor ingresa un valor de " + tipo_campo + " válido " + dato);
                $.unblockUI();

            } //else
            $.unblockUI();

        })
        .fail(function() {
                $('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>   La busqueda no regreso ningun dato</strong>');
	        	$.unblockUI();
	        })
        .always(function() {
        	//console.log(obj);
        	if(obj.error){
                $('#value').val('');
				$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
				$( "#previous" ).trigger( "click" );
				$.unblockUI();
        	}
			$.unblockUI();
        });

    }//fun_ejecuta_busqueda



    // Funcion de Fin de Vista, ejecucion
    function finished(){

        if( $('#txtDateini' ).val()!='' && $('#txtDatefin' ).val()!='')
        {
            fun_ejecuta_busqueda();
        }else if ($('#txtDateini' ).val()!='' || $('#txtDatefin' ).val()!='')
        {
            if ( $('#txtDateini' ).val()=='' ){
                $('#message_error').empty();
                $('#message_error').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha inicio de consulta</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
            return false;
            }

            if ( $('#txtDatefin' ).val()=='' ){
                $('#message_error').empty();
                $('#message_error').append('<label class="alert-danger mb-30 text-left">Seleccionar Fecha fin de consulta</label>');
                $('#message').append('<label class="alert-danger mb-30 text-left">Error en validaci&oacute;n de datos</label>');
                return false;
            }
        }
    } //finished
    //Cargo comportmiento de inicio de pantalla
    $(window).on('load', function()
    {

        // aqui llenaria los combos y el comportamiento de los objetos en la pantalla

        var Operations2 = function ()
        {
            //Inicio el comporatamiento de la ventana
            var datatableInstance = null;

        	return {
		        init: function() {
                    tipo_campo="hostname";
		        	$('#previous').hide();
                    $( "#finish" ).text('Buscar');

                    $('#message_error').empty();
                    //initializePlugins2();

                    fun_ejecuta_busqueda();

				    $( "#finish" ).click(function() {
                        //Aqui va el codigo de cuando se presiona el boton
                        //$('#message').append('voy 4');
                    });
                    //$('#message').append('voy 3');
		        }
		    };
        }
        Operations2().init();
    });// fin de inicio de pantall

</script>
@endsection
