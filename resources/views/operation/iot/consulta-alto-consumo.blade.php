@extends('layouts.app')
@section('content')
<div class="col-sm-12">

    <div class="row">
        <div class="col-sm-12">
            @include('operation.iot.table')
        </div>
    </div>
    <br>
    <div class="row" id="message">
    </div>
    <div class="alert-danger" id="message_error_result"></div>
    <input type="hidden" id="value" />

</div>
@endsection

@section('jsfree')
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script>
    $(window).on('load', function() {
        $.blockUI({
            message: 'Procesando ...',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
        $.ajax({
                url: "{{ route('iot.query-high-consumptions') }}",
                type: 'GET',
                data: {
                    'mvno': "{{app('session')->get('choose_mvno')->partnerId}}"
                }
            })
            .done(function(response) {
                var obj = jQuery.parseJSON(response);
                //console.log(obj);
                
                if (obj.statusCode != null && obj.statusCode != 200) {
                    //console.log('fail')
                    $('#message_error_result').empty();
                    $('#message_error_result').append('<label class="alert-danger mb-30 text-left">Error al consultar ' + tipo_campo.toUpperCase() + ' ' + $('#inputData').val() + '<br><strong>' + obj.error + '</strong></label>');
                    $('#resultadoTable').hide();
                } else {
                    $('table#tableIoT').DataTable({
                        "data": obj,
                        "pageLength": 5,
                        "order": [
                            [0, "desc"]
                        ],
                        "columns": [{
                                "data": "fecha_notificacion",
                                "render": function ( data, type, row ) {
			                       	var date = moment(row.fecha_notificacion, "YYYY-MM-DD HH:mm:ss");
			                        return date.format('YYYY-MM-DD');
			                    }
                            },
                            {
                                "data": "fecha_notificacion",
                                "render": function ( data, type, row ) {
			                       	var date = moment(row.fecha_notificacion, "YYYY-MM-DD HH:mm:ss");
			                        return date.format('HH:mm:ss');
			                    }
                            },
                            {
                                "data": "msisdn"
                            },
                            {
                                "data": "msisdn",
                                "render": function(data, type, row) {
                                    return "{{app('session')->get('choose_mvno')->partnerId}}";
                                }
                            },
                            {
                                "data": "total_amount",
                                "render": function ( data, type, row ) {
			                       	var newTotal = row.total_amount / 5;
                                    var num = newTotal/1024/1024;
			                        return Math.round((num + Number.EPSILON) * 100) / 100;
			                    }
                            },
                            {
                                "data": "unsused_amount",
                                "render": function ( data, type, row ) {
                                    var totalAmount = (row.total_amount/1024/1024/5) *4;
			                       	var newAmount = row.unsused_amount/1024/1024 - totalAmount ;
                                    var num =newAmount;
			                        return newAmount > 0 ?  Math.round((num + Number.EPSILON) * 100) / 100 : 0;
			                    }
                            },
                            {
                                "data": "threshold",
                                "render": function ( data, type, row ) {
                                    var newThreshold = row.threshold * 5;
			                        return newThreshold;
			                    }
                            },
                            {
                                "data": "offeringid"
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
                $('#message').empty();
                $('#message').append('<label class="alert-danger mb-30 text-left"><strong>Time Out</strong></label>');
                $('#resultadoTable').hide();
                $.unblockUI();
            })
            .always(function() {
                $.unblockUI();
            });
    });
</script>
@endsection