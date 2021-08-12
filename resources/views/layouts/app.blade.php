<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Altán Boveda Manager SGI </title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- Bootstrap Datetimepicker CSS -->
 	<link href="/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
	<!-- Bootstrap Daterangepicker CSS -->
 	<link href="/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
	<!-- jquery-steps css -->
	<link rel="stylesheet" href="/vendors/bower_components/jquery.steps/demo/css/jquery.steps.css">
	<!-- checkboxes in dataTable -->
	<link type="text/css" href="/vendors/bower_components/jquery-datatables-checkboxes-1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
	<!-- bootstrap-touchspin CSS -->
	<link href="/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
	<!-- Custom CSS -->
	<link href="/dist/css/style.css" rel="stylesheet" type="text/css">
	<link href="/dist/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/modals.css') }}">
</head>
<body>

	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->

	<div class="wrapper theme-1-active pimary-color-pink">

		<!-- Top Menu Items -->
		@include('layouts.header')
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		@include('layouts.lef-side')
		<!-- /Left Sidebar Menu -->

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="{{ route('home.index') }}">Boveda</a></li>
							<li class="active"><span>Inicio</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>

				<!-- Row -->
				<div class="row">
					@yield('content')
				</div>
				<!-- /Row -->
			</div>

			<!-- Footer -->
			@include('layouts.footer')
			<!-- /Footer -->

		</div>
		<!-- /Main Content -->

	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="/vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="{{asset('js/printThis.js')}}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
	<!-- Sweet-Alert  -->
	<script src="/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<!-- Form Wizard JavaScript -->
	<script src="/vendors/bower_components/jquery.steps/build/jquery.steps.min.js"></script>
	<script src="/dist/js/jquery.validate.min.js"></script>
	<!-- Form Wizard Data JavaScript -->
	<script src="/dist/js/form-wizard-data.js"></script>
	<!-- Data table JavaScript -->
	<script src="/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<!-- Bootstrap Touchspin JavaScript -->
	<script src="/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	  <!-- Moment JavaScript -->
	<script type="text/javascript" src="/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
	<!-- Bootstrap Colorpicker JavaScript -->
	<script src="/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<!-- Bootstrap Datetimepicker JavaScript -->
	<script type="text/javascript" src="/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Bootstrap Daterangepicker JavaScript -->
	<script src="/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="/vendors/bower_components/jquery-ui/ui/widgets/datepicker.js"></script>
	<script type="text/javascript" src="/dist/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/dist/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons in dataTable -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<!-- check boxes in dataTable -->
	<script type="text/javascript" src="/vendors/bower_components/jquery-datatables-checkboxes-1.2.12/js/dataTables.checkboxes.min.js"></script>

	<!-- Form Picker Init JavaScript -->
	<script src="/dist/js/form-picker-data.js"></script>
	<!-- Starrr JavaScript -->
	<script src="/dist/js/starrr.js"></script>
	<!-- Slimscroll JavaScript -->
	<script src="/dist/js/jquery.slimscroll.js"></script>
	<!-- Fancy Dropdown JS -->
	<script src="/dist/js/dropdown-bootstrap-extended.js"></script>
	<!-- Owl JavaScript -->
	<script src="/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<!-- Switchery JavaScript -->
	<script src="/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="/dist/js/jquery.blockUI.js"></script>
	<!-- Init JavaScript -->
	<script src="/dist/js/init.js"></script>

	<!-- begin::Page Loader -->

    <script>
    	var glob = new Array();
    	var offerts = new Array();
    	var tipo_campo='email';
    	var tipo_campo_lef='email';
		var patrones = new Array();
		patrones['msisdn']=/^[1-9][0-9]{9}$/;
		patrones['imsi']=/^[1-9][0-9]{14}$/;
		patrones['imei']=/^[0-9][0-9]{13,15}$/;
		patrones['icc']=/^(8952140)[0-9]{12}$/;
		patrones['coordenadas']=/^([-+]?\d{1,2}[.]\d+),\s*([-+]?\d{1,3}[.]\d+)$/;
		patrones['latitud']=/^([-+]?\d{1,2}[.]\d+)$/;
		patrones['longitud']=/^([-+]?\d{1,3}[.]\d+)$/;
		patrones['orderid']=/^[1-9][0-9]{7,19}$/;
		patrones['beid']=/^[1-9][0-2]{3}$/;
		patrones['idPreregistro']=/^[1-9][0-9]{1,10}$/;
        patrones['nir']=/^[1-9][0-9]{1,4}$/;
        patrones['email']=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/;
        patrones['hostname']=/^[_a-z0-9]{50}$/;
        patrones['ip']=/^([0-9]{1,3}\.){3}[0-9]{1,3}$/;
        patrones['username']=/^[1-9][0-9]{50}$/;
        patrones['cr']=/^((CRQ)|(crq))[0-9]{12}$/;
        patrones['inc']=/^((INC)|(inc))[0-9]{12}$/;
        patrones['nombre']=/^[_a-z0-9]{50}$/;
        patrones['apellido']=/^[_a-z0-9]{50}$/;
        patrones['usuario']=/^[_a-z0-9]{50}$/;
        patrones['status']=/^[_a-z0-9]{50}$/;

        patrones['ambiente']=/^[_a-z0-9]{50}$/;
        patrones['tipo']=/^[_a-z0-9]{50}$/;
        patrones['modelo']=/^[_a-z0-9]{50}$/;
		
		



		var inputTope = new Array();
		inputTope['msisdn']=10;
		inputTope['imsi']=15;
		inputTope['imei']=16;
		inputTope['icc']=19;
		inputTope['beid']=3;
        inputTope['idPreregistro']=10;
        inputTope['email']=100;
        inputTope['hostname']=50;
        inputTope['ip']=17;
        inputTope['username']=50;
        inputTope['cr']=15;
        inputTope['inc']=15;
        inputTope['nombre']=50;
        inputTope['apellido']=50;
        inputTope['usuario']=50;
        inputTope['status']=50;
		inputTope['ambiente']=50;
		inputTope['tipo']=50;
		inputTope['modelo']=50;
		
		
		


		function bloqueo() {
			$.blockUI({ message: 'Procesando ...',css: {
	            border: 'none',
	            padding: '15px',
	            backgroundColor: '#000',
	            '-webkit-border-radius': '10px',
	            '-moz-border-radius': '10px',
	            opacity: .5,
	            color: '#fff'
	        } });
		}


		function TipoDato4(valor){
			tipo_campo=valor;
			$("#inputData").prop('maxLength', inputTope[tipo_campo]);
			$("#inputData").attr('placeholder', 'Ingrese valor de '+tipo_campo.toUpperCase()+' a consultar')
			$("#inputData").val('');
			$('#inputData').focus();
			$("#inputData").css({'border' : '1px solid rgba(33, 33, 33, 0.12)'});
			$("#message_error").text("");
		}

		function TipoDatoIdPreregistro(valor){
			tipo_campo=valor;
			$("#inputData").prop('maxLength', inputTope[tipo_campo]);
			$("#inputData").attr('placeholder', 'Ingrese valor de '+tipo_campo.toUpperCase()+' a consultar')
			$("#inputData").val('');
			$('#inputData').focus();
			$("#inputData").css({'border' : '1px solid rgba(33, 33, 33, 0.12)'});
			$("#message_error").text("");
		}

		function TipoDato360(valor){
			tipo_campo_lef=valor;
			$("#data360").prop('maxLength', inputTope[tipo_campo_lef]);
			$("#data360").attr('placeholder', 'Ingrese valor de '+tipo_campo_lef.toUpperCase())
			$("#data360").val('');
			$('#data360').focus();
			$("#data360").css({'border' : '1px solid rgba(33, 33, 33, 0.12)'});
			$("#message_error_360").text("");
		}

		function ValidateNext() {
            var dato=$('#inputData').val();
			if (patrones[tipo_campo].test(dato)) {
				identify();
				return true;
			} else {
				$("#inputData").css({'border' : '1px solid #f73414'});
				$("#message_error").css('color', '#f73414');
				$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
				return false;
			}
		}

		function validateSearchPreRegister() {
            var dato=$('#inputData').val();
			if (patrones[tipo_campo].test(dato)) {
				searchPreRegister();
				return true;
			} else {
				$("#inputData").css({'border' : '1px solid #f73414'});
				$("#message_error").css('color', '#f73414');
				$("#message_error").text("Por favor ingresa un valor de " + tipo_campo.toUpperCase()+" válido");
				return false;
			}
		}

    	function cleardate(){
    		$('#txtDate').val('');
    	}
    	function cleardate2(){
    		$('#txtDate2').val('');
    	}
    	function cleardate3(){
    		$('#txtDate3').val('');
    	}

    	function valida_cordenadas(){
    		var status = true;
    		val = $("#latitud").val();
			if (!patrones['latitud'].test(val)) {
				status = false;
			 	$("#latitud").val('');
			}

			val = $("#longitud").val();
			if (!patrones['longitud'].test(val)) {
				status = false;
			 	$("#longitud").val('');
			}

			return status;
    	}

    	function validconsulta360() {
    		if (patrones[tipo_campo_lef].test( $('#data360').val() )) {
    			$('#btnconsulta').hide();
    			bloqueo();
				$('#consulta360').submit();
			} else {
				$("#data360").blur();
				$("#data360").val('');
				$("#data360").css({'border' : '1px solid #f73414'});
				$("#message_error_360").css('color', '#f73414');
				$("#message_error_360").css({'font-size': '11px'});
				$("#message_error_360").text("Ingresa un valor de " + tipo_campo_lef.toUpperCase()+" válido");
				return false;
			}

    	}


	  	function identify(){
	        $('#message,#setmsisdn,#setimsi,#setimei,#seticc,#setmsisdn2,#setbeid').empty();
	  		bloqueo();
			$.ajax({
				url: "{{ route('imei.call.identify') }}",
				type: 'GET',
			 	data: {
			 		'type': tipo_campo,
			 		'value': $('#inputData').val()
			 	}
			})
	        .done(function(response) {
	        	var obj = jQuery.parseJSON(response);
	        	//console.log(obj);
	        	if(obj.error){
	        		$('#value').val('');
					$('#message_error').empty();
					$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Datos proporcionados no son correctos por favor verificar</strong> ');
					$( "#previous" ).trigger( "click" );
	        	}else{
	        		$('#message_error').empty();
		        	$('#setmsisdn2').append(obj.msisdn);
		        	$('#setmsisdn').append(obj.msisdn);
		        	$('#setimsi').append(obj.imsi);
		        	$('#setimei').append(obj.imei);
		        	$('#seticc').append(obj.iccid);
		        	$('#setbeid').append(obj.beId);
		        	$('#value').val(obj.msisdn);
		        }
	        })
	        .fail(function() {
	        	$('#message_error').empty();
				$('#message_error').append('<label class="help-block mb-30 text-left"><strong>Time Out</strong>');
	        	$.unblockUI();
	        })
	        .always(function() {
				$.unblockUI();
	        });
		}

    	$(window).on('load', function() {
            $('body').removeClass('m-page--loading');

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });



            var Operations = function () {
            	var initializePlugins = function initializePlugins() {
					$(function(){
					    var dtToday = new Date();

					    var month = dtToday.getMonth() + 1;
					    var day = dtToday.getDate();
					    var year = dtToday.getFullYear();
					    if(month < 10)
					        month = '0' + month.toString();
					    if(day < 10)
					        day = '0' + day.toString();

					    var maxDate = year + '-' + month + '-' + day;
					    $('#txtDate').attr('min', maxDate);
					    $('#txtDate2').attr('min', maxDate);
					    $('#txtDate3').attr('min', maxDate);
					});

					$("#data360").keyup(function (e) {
						val = $("#data360").val().replace(/^(0*)/,"");
						$("#data360").val(val.replace(/[^0-9]/g,''));
						if ((event.which != 46 || $("#data360").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
							event.preventDefault();
						}
					});

					$("#value").keyup(function (e) {
						val = $("#value").val().replace(/^(0*)/,"");
						$("#value").val(val.replace(/[^0-9]/g,''));
						if ((event.which != 46 || $("#value").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
							event.preventDefault();
						}
					});

                    /*Se comento por que no dejaba escribir texto*/
					/*$("#inputData").keyup(function (e) {
						val = $("#inputData").val().replace(/^(0*)/,"");
						$("#inputData").val(val.replace(/[^0-9]/g,''));
						if ((event.which != 46 || $("#inputData").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
							event.preventDefault();
						}
					});*/

					$("#secondstep").keyup(function (e) {
						val = $("#secondstep").val().replace(/^(0*)/,"");
						$("#secondstep").val(val.replace(/[^0-9]/g,''));
						if ((event.which != 46 || $("#secondstep").val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
							event.preventDefault();
						}
					});

					$( "#previous" ).click(function( event ) {
					  event.preventDefault();
					  $('#message').empty();
					  $( '#finish' ).show();
					});

					$('#consulta360').bind('keydown', function(e) {
					    if (e.keyCode == 13) {
					        validconsulta360();
					        e.preventDefault();
					    }
					});

					$('#form_tabs').bind('keydown', function(e) {
					    if (e.keyCode == 13) {
					    	$( "#finish" ).trigger( "click" );
					        e.preventDefault();
					    }
					});

					$('#form_identify').bind('keydown', function(e) {
						if (e.keyCode == 13) {
					        $( "#next" ).trigger( "click" );
					        e.preventDefault();
					    }
					});

					$('#stepdos').bind('keydown', function(e) {
						if (e.keyCode == 13) {
					        $( "#next" ).trigger( "click" );
					        e.preventDefault();
					    }
					});

					$('#steptres').bind('keydown', function(e) {
						if (e.keyCode == 13) {
					        $( "#next" ).trigger( "click" );
					        e.preventDefault();
					    }
					});

				}

				// Public Methods
			    return {
			        init: function() {
			            initializePlugins();
			        }
			    };

			}

			Operations().init();

            @yield('js')
        });
    </script>
    @yield('jsfree')
</body>
</html>
