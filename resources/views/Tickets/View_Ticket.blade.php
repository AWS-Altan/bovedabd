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
                            <div class="row" id="message">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-12">
                        @include('layouts.tableticketsoncurse')
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
   

    $(window).on('load', function() {
        var datatableInstance    = null;

        var initializeDatatable = function initializeDatatable(check) {
            //bloqueo();
            console.log('inicia consulta actividades'+moment().format('YYYY-MM-DD HH:mm:ss'))

            //Ejecuto la busqueda del dato, armo la busqueda
            var sJL_mail = '{{app('auth')->user()->email}}';

            var data = {};
            data.operacion   = "query";
           
            if(  $('#initialDate').val() != '' && $('#finalDate').val() != '')
            {
                data.fecha_ini = $('#initialDate').val();
                data.fecha_fin = $('#finalDate').val();
            }

            
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
                $('#message').hide();
                $('#message').empty();
                $('#message').css('color', '#9E1D23');
                $('#message').css("text-align", "center");
                if ( obj.status !== "ok" ){
                    $('#message').empty();
                    $('#message').show();
                    $('#message').append('</br><strong>Respuesta: </strong></br>'+obj.description);
                    //$('#operations_history_panel').hide();
                    $('#Tbl_usrdisp').hide();
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
                                "data": "ticket"
                                
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

                    $('#message').empty();
                    if ( $('#initialDate').val() == '' || $('#finalDate').val() == '') {
                        $('#message').append('<label class="help-block mb-30 text-left"><strong>Las fechas de consulta son obligatorias</strong> ');
                        return false;
                    }
                    initializeDatatable(1);
                });


                $("#pausarActividades").click(function (e) {
                    $('#message').hide();
                    var activitiesList = [];
                    activityindex=0;
                    var actividades="";

                    var rows_selected = datatableInstance.column(0).checkboxes.selected();


                    $.each(rows_selected, function(index, rowId){  
                        //alert("Seleccionado" +  rowId );
                        activitiesList[ activityindex ] = rowId;
                        activityindex++;
                        actividades+="" + rowId + ","

                    });
                    if (actividades.length>1)
                        actividades=actividades.substring(0,actividades.length-1);

                    console.log("actividades " +  activitiesList);
/***********************************************/
                    var data = {};
                    data.operacion= "pause";
                    data.fecha_inicio= "2021-04-03";
                    data.fecha_termino= "2021-04-15";
                    data.mensaje= "Incidencia en el cor";
                    data.responsable= '{{app('auth')->user()->name}}';
                    data.actividades= actividades;


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
                        url: "{{ route('tickets.call.actionsredbutton') }}",
                        type: 'POST',
                        contentType: "application/json",
                        data: JSON.stringify( data )
                    })
                    .done(function(response) {
                        var obj = jQuery.parseJSON(response);
                        console.log(obj);
                        

                        if ( (obj.stackTrace) || (obj.errorMessage) ||  ( obj.Message && obj.Message.indexOf("error")>-1 )  )  {  
                            var descriptionError = "";
                            
                            if( obj.stackTrace ){
                                descriptionError= obj.errorMessage;
                                descriptionError+= " <br>"
                                descriptionError+= obj.stackTrace[0];
                            }else if ( (obj.errorMessage) ){
                                descriptionError= obj.errorMessage;
                            }else if ( obj.Message || obj.Message.indexOf("error")>-1 ) {
                                descriptionError= obj.Message;
                            }
                        
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left">Error al pausar las siguientes actividades: ' + activitiesList +' <br> <strong>'+ descriptionError + '</strong>');

                        }else{
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-success mb-30 text-center">Actividades pausadas <strong>'+ obj.Message +'</strong>' );
                            initializeDatatable(1);

                        }
                    })
                    .fail(function() {
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left"><strong>Time Out</strong></label>');
                            $.unblockUI();
                        })
                    .always(function() {
                        $.unblockUI();
                    });

/***********************************************/                   
                });


                $("#reanudarActividades").click(function (e) {
                    $('#message').hide();
                    var activitiesList = [];
                    activityindex=0;
                    var actividades="";

                    var rows_selected = datatableInstance.column(0).checkboxes.selected();


                    $.each(rows_selected, function(index, rowId){  
                        //alert("Seleccionado" +  rowId );
                        activitiesList[ activityindex ] = rowId;
                        activityindex++;
                        actividades+="" + rowId + ","

                    });
                    if (actividades.length>1)
                        actividades=actividades.substring(0,actividades.length-1);

                    console.log("actividades " +  activitiesList);
/***********************************************/
                    var data = {};
                    data.operacion= "resume";
                    data.fecha_inicio= "2021-04-03";
                    data.fecha_termino= "2021-04-15";
                    data.mensaje= "Incidencia en el cor";
                    data.responsable= '{{app('auth')->user()->name}}';
                    data.actividades= actividades;


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
                        url: "{{ route('tickets.call.actionsredbutton') }}",
                        type: 'POST',
                        contentType: "application/json",
                        data: JSON.stringify( data )
                    })
                    .done(function(response) {
                        var obj = jQuery.parseJSON(response);
                        console.log(obj);
                        if ( (obj.stackTrace) || (obj.errorMessage) ||  ( obj.Message && obj.Message.indexOf("error")>-1 )  )  {  
                            var descriptionError = "";
                            
                            if( obj.stackTrace ){
                                descriptionError= obj.errorMessage;
                                descriptionError+= " <br>"
                                descriptionError+= obj.stackTrace[0];
                            }else if ( (obj.errorMessage) ){
                                descriptionError= obj.errorMessage;
                            }else if ( obj.Message || obj.Message.indexOf("error")>-1 ) {
                                descriptionError= obj.Message;
                            }
                        
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left">Error al reanudar las siguientes actividades: ' + activitiesList +' : <br><strong>'+ descriptionError + '</strong>');

                        }else{
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-success mb-30 text-center">Actividades Reactividadas <strong>'+ obj.Message +'</strong>' );
                            initializeDatatable(1);

                        }
                    })
                    .fail(function() {
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left"><strong>Time Out</strong></label>');
                            $.unblockUI();
                        })
                    .always(function() {
                        $.unblockUI();
                    });

/***********************************************/                   
                });



               $("#stopActividades").click(function (e) {
                    $('#message').hide();
                    var activitiesList = [];
                    activityindex=0;
                    var actividades="";

                    $( ".dt-checkboxes-select-all" ).trigger( "click" );

                    var rows_selected = datatableInstance.column(0).checkboxes.selected();
                    //alert (rows_selected.length); 
                    if (rows_selected.length<=0){
                        $( ".dt-checkboxes-select-all" ).trigger( "click" );
                        var rows_selected = datatableInstance.column(0).checkboxes.selected();
                    }

                    $.each(rows_selected, function(index, rowId){  
                        //alert("Seleccionado" +  rowId );
                        activitiesList[ activityindex ] = rowId;
                        activityindex++;
                        actividades+="" + rowId + ","

                    });

                    if (actividades.length>1)
                        actividades=actividades.substring(0,actividades.length-1);

                    console.log("actividades " +  activitiesList);
/***********************************************/

                    var data = {};
                    data.operacion= "stop";
                    data.fecha_inicio= "2021-04-03";
                    data.fecha_termino= "2021-04-15";
                    data.mensaje= "Incidencia en el cor";
                    data.responsable= '{{app('auth')->user()->name}}';
                    data.actividades= actividades ;


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
                        url: "{{ route('tickets.call.actionsredbutton') }}",
                        type: 'POST',
                        contentType: "application/json",
                        data: JSON.stringify( data )
                    })
                    .done(function(response) {
                        var obj = jQuery.parseJSON(response);
                        console.log(obj);
                        if ( (obj.stackTrace) || (obj.errorMessage) ||  ( obj.Message && obj.
                            Message.indexOf("error")>-1 )  )  {  
                            var descriptionError = "";
                            alert("Entra Error");
                            if ( (obj.errorMessage) ){
                                descriptionError= obj.errorMessage;
                                descriptionError+= " <br>"
                                descriptionError+= obj.stackTrace[0];
                            }else if ( obj.Message || obj.Message.indexOf("error")>-1 ) {
                                descriptionError= obj.Message;
                            }
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left">Error al detener las siguientes actividades: ' + activitiesList +' <br> <strong>'+ descriptionError + '</strong>');

                        }else{
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-success mb-30 text-center">Actividades detenidas <strong>'+ obj.status +'</strong>' );
                            initializeDatatable(1);

                        }
                    })
                    .fail(function() {
                            $('#message').empty();
                            $('#message').show();
                            $('#message').append('</br><label class="alert-danger mb-30 text-left"><strong>Time Out</strong></label>');
                            $.unblockUI();
                        })
                    .always(function() {
                        $.unblockUI();
                    });

/***********************************************/                   
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


