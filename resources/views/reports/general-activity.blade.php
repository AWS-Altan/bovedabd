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
                        <h3><span class="head-font capitalize-font">Reporte General de Actividades</span></h3>
                        <section>
                            <div class="row" id="message">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-12">
                        @include('layouts.table-generalactivities')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsfree')

    <!--librerias para el boton del pdf -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

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
            data.operacion   = "report";

            if(  $('#initialDate').val() != '' && $('#finalDate').val() != '')
            {
                data.fecha_inicio = $('#initialDate').val();
                data.fecha_termino = $('#finalDate').val();
            }


            bloqueo();
            $.ajax({
                url: "{{ route('call.generalactivity-list') }}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify(data)
            }).done(function (response) {
                obj = jQuery.parseJSON(response);
                //console.log("obj");
                //console.log(obj);
                $('#message').hide();
                $('#message').empty();
                $('#message').css('color', '#9E1D23');
                $('#message').css("text-align", "center");
                if ( obj.status !== "ok" ){
                    $('#message').empty();
                    $('#message').show();
                    $('#message').append('</br><strong>Respuesta: </strong></br>'+obj.description);
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
                            'csv', 'excel', 'pdf'
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


