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
                        <h3><span class="head-font capitalize-font">Lista de Actividades en curso</span></h3>
                        <section>
                            <form id="form_tabs" action="#">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('layouts.tableticketsoncurse')
                                    </div>
                                </div>
                                <!-- /Row -->
                                <br>
                                <div class="row">
                                    <div id="message" class="col-sm-12">
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsfree')
<style type="text/css">
    .wizard > .steps > ul > li{
            width: 45%;
    }
</style>
<script>
    function finished(){
        $('#message' ).empty();
        
        if ( $('#usuarioReset' ).val()=='' ){
            $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Error:</strong>&nbsp; capture el correo del usuario a dar reset</label>');
            return false;
        }
        
        if (!patrones['email'].test($('#usuarioReset').val())) {
            $('#message').empty();
            $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Error en email:</strong>&nbsp;El formato no es v&aacute;lido</label>');
            return false;
        }

        if ( $('#passUsuarioReset' ).val()=='' ){
            
            $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Error:</strong>&nbsp; capture la contrase&ntilde;a fijar al usuario de View360</label>');
            return false;
        }

        if ( $('#passAdmin' ).val()=='' ){
            
            $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Error:</strong>&nbsp; capture la contrase&ntilde;a que utiliza el usuario para acceder a  View360</label>');
            return false;
        }


        //bloqueo();
        $.blockUI({ message: 'Validando password ...',css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } });
        $.ajax({
            url: "{{ route('access.call.report_userdisp') }}",
            type: 'GET',
            data: {
                'value': $('#passAdmin').val()
                
            }
        })
        .done(function(response) {
            obj2 = jQuery.parseJSON(response);
            console.log(obj2);
            

        })
        .fail(function() {
                $('#message').empty();
                $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong> al validar su contrase&ntilde;a para acceder a  View360 </label>');
                $.unblockUI();
            })
        .always(function() {
            

            if ( obj2.statusCode!= null && obj2.statusCode!=200 )  {    
                $('#message').empty();
                $('#message').append('<label class="alert-danger mb-30 text-left">Validaci&oacute;n de contrase&ntilde;a administrador<strong> no  exitosa </strong><br> No corresponde al valor que utiliza el usuario para acceder a  View360</label>');
                $.unblockUI();

            }else{

            }

            //$.unblockUI();
        });

    }

    

    $(window).on('load', function() {
        var datatableInstance    = null;

        var initializeDatatable = function initializeDatatable(check) {
            //bloqueo();
            console.log('inicia consulta operaciones'+moment().format('YYYY-MM-DD HH:mm:ss'))

            //Ejecuto la busqueda del dato, armo la busqueda
            var sJL_mail = '{{app('auth')->user()->email}}';

            var data = {};
            data.operacion   = "consulta";
/*           
            if( $('#initialDate' ).val() != '' && $('#finalDate' ).val() != '')
            {
                data.fecha_ini = $('#initialDate' ).val();
                data.fecha_fin = $('#finalDate' ).val()
            }

           
           if(document.getElementById('radio5').checked)
            {
                data.IP = $('#inputData').val();
            }
            if(document.getElementById('radio6').checked)
            {
                data.hostname = $('#inputData').val();
            }
            if(document.getElementById('radio7').checked)
            {
                data.user = $('#inputData').val();
            }
            if(document.getElementById('radio8').checked)
            {
                data.solicitante = $('#inputData').val();
            }
            if(document.getElementById('radio9').checked)
            {
                data.status = $('#inputData').val();
            }
*/            
            bloqueo();
            $.ajax({
                url: "{{ route('tickets.call.list') }}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify(data)
            }).done(function (response) {
                obj = jQuery.parseJSON(response);
                console.log("obj");
                console.log(obj);
                $('#msg_operations').hide();
                $('#msg_operations').empty();
                $('#msg_operations').css('color', '#9E1D23');
                $('#msg_operations').css("text-align", "center");
                if ( obj.status !== "ok" ){
                    $('#msg_operations').show();
                    $('#msg_operations').append('</br><strong>Respuesta: </strong></br>'+response.description);
                    $('#operations_history_panel').hide();
                }else{
                    console.log('termina consulta actividades'+moment().format('YYYY-MM-DD HH:mm:ss'))
                    
                    data = obj.actividades;
                    console.log('DATA');
                    console.log(data);

                    if (datatableInstance) {
                        datatableInstance.destroy();
                    }
                    //var datatableInstance
                    datatableInstance = $('table#Tbl_usrdisp').DataTable({
                        "data": data,
                        "pageLength": 5,

                        "order": [
                            [1, "desc"]
                        ],
                        "columnDefs": [
                          {
                             "targets": 0,
                             "checkboxes": {
                                "selectRow": true
                             }
                          }
                        ],
                        "select": {
                            "style": 'multi'
                        },
                        "columns": [
                            {
                                "data": "id_acceso"
                                
                            },
                            {
                                "data": "ticket"
                            },
                            {
                                "data": "descripcion"
                            },
                            {
                                "data": "fecha_inicio"
                            },
                            {
                                "data": "fecha_termino",
                                "render": function ( data, type, row ) {
                                        if (row.fecha_termino!=='null') {return row.fecha_termino;}
                                        return ' ';
                                }

                            },
                            {
                                "data": "fecha_pausa",
                                "render": function ( data, type, row ) {
                                        if (row.fecha_pausa!=='null') {return row.fecha_pausa;}
                                        return ' ';
                                }

                            },
                            {
                                "data": "fecha_reanuda",
                                "render": function ( data, type, row ) {
                                        if (row.fecha_reanuda!=='null') {return row.fecha_reanuda;}
                                        return ' ';
                                }

                            }
                        ],
                        dom: 'Bfrtip',
                        buttons: [
                            'csv'
                        ]
                    });

                }

            })
            .fail(function() {
                $.unblockUI();
            })
            .always(function () {
                if (check == 1) {$.unblockUI();}
            })
        };



        var Consulta = function () {

            var initializePlugins2 = function initializePlugins2() {
                
                initializeDatatable(1);


                $("#consultaActividades").click(function (e) {
                    f1 = $("#initialDate").val();
                    f2 = $("#finalDate").val();
                    $('#msg_operations').empty();
                    if ( f1.length < 1 || f2.length < 1 ) {
                        $('#msg_operations').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
                        return false;
                    }

                    initializeDatatable(1);
                });


                $("#pausarActividades").click(function (e) {
                    //alert ("entra");
                      //var form = this;

                      var rows_selected = datatableInstance.column(0).checkboxes.selected();


                      // Iterate over all selected checkboxes
                        //datatableInstance.$('input[type="checkbox"]').each(function(){
                       $.each(rows_selected, function(index, rowId){  
                        alert("Seleccionado" +  rowId );
                         // Create a hidden element
                         // $(form).append(
                         //     $('<input>')
                         //        .attr('type', 'hidden')
                         //        .attr('name', 'id[]')
                         //        .val(rowId)
                         // );
                      });
                   
                });



            };

            

            return {
                init: function() {
                    $('#previous').hide();
                    $('#finish').text('Consultar');
                    $('#finish').hide();
                    initializePlugins2();
                    
                }
            };
        }
        Consulta().init();

    });
    
</script>
@endsection


