@extends('layouts.app')

@section('content')

@if ( $blank == 1 )
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="form-wrap">
						<form action="#">
							<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Informaci&oacute;n General</h6>
							<div class="table-wrap mt-40">
								<div class="table-responsive">
									<table class="table table-striped table-bordered mb-0">
										<thead>
											<tr>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">MVNO</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">MSISDN</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">BE_ID</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">IMSI</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">IMEI <img src="{{ asset('img/signo.png') }}" width="10" height="10" title="Si se ha reemplazado el equipo o la Sim Card no ha sido utilizada en ning&uacute;n equipo el IMEI podr&iacute;a no ser el actual."></span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">ICC</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">Estado</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">Razón</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">Producto</span></th>
												<th><span style="color:#9E1D22; font-weight: bold; font-size: 10px;">Coordenadas (HBB, Alta o Cambio)</span></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{ $profile->mvno->nombre }}</td>
												<td>{{ $profile->subscriber->msisdn }}</td>
												<td>{{ $profile->mvno->beId }}</td>
												<td>{{ $profile->subscriber->imsi }}</td>
												<td>{{ $imei }}</td>
                                                <td>{{ $profile->subscriber->iccid }}</td>
												<td>{{ $profile->subscriber->status->status }}</td>
												<td>{{ $profile->subscriber->status->reason }}</td>
												<td>
													@if ($profile->subscriber->status->status == 'Idle')
														Oferta por defecto
													@else
														{{ $profile->subscriber->product }}
													@endif
												</td>
												<td>
														@if ( strlen($profile->subscriber->coordinates) > 3 )
															{{ $profile->subscriber->coordinates }}
														@else
															N/A
														@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="msisdn360" value="{{ $profile->subscriber->msisdn }}">
<input type="hidden" id="statusSubscriber" value="{{ $profile->subscriber->status->status }}">
<input type="hidden" id="reasonStatusSubscriber" value="{{ $profile->subscriber->status->reason }}">


<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div  class="tab-struct custom-tab-1 product-desc-tab">
						<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">



                        </ul>
						<div class="tab-content" id="myTabContent_7">
							<!-- RESUMEN -->
							<div id="controlM" class="tab-pane fade" role="tabpanel">
						</div>
						<div id="imeiL" class="tab-pane fade" role="tabpanel">
						</div>


						<ul><hr class="light-grey-hr mt-50 mb-20"/></ul>

                 		<div class="table-wrap">
                  			<div class="table-responsive">
                  		</div>
                 	</div>
                </div>
            </div>
        </div>
	</div>
</div>
@else

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="form-wrap" style="text-align: center;color: red;">
						<form action="#">
							<h6 class="txt-dark capitalize-font"><br>
								@if (isset($error))
									{{$error}}
								@else
									<i class="zmdi zmdi-info-outline mr-10"></i>Informaci&oacute;n Incorrecta
								@endif

							</h6>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@endsection

@section('jsfree')
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>


	function evalJson(jsonObj){
		var text = "";
		var data = [];
		recursiveCols(data, jsonObj);
		text = '<table>';
		for ( var i = 0; i < data.length; i++){
			for ( key in data[i]){
				if (key.toUpperCase()==="REASON"){
                   text += '<tr><td><strong>Reason:    </strong></td><td>'+getDescriptionReason( data[i][key] )+'</td></tr>';
				}else {
				   text += '<tr><td><strong>'+key+':   </strong></td><td>'+ data[i][key]+ '</td></tr>';
				}
			}
		}
		text += '</table>';


		return text;
	}

	function recursiveCols(data, jsonObj){
		for (var key in jsonObj) {
          	if ( Array.isArray(jsonObj[key]) ){
              for ( key2 in jsonObj[key] ){
              	var pair = {};
				pair[key + '_' + key2] =  jsonObj[key][key2];
				data.push(pair);
              }
          	}
			if ( (typeof jsonObj[key])  == "object" ){
				recursiveCols(data, jsonObj[key]);
			}
			else if ( !data.key && isNaN(key) ) {
				var pair = {};
				pair[key] = jsonObj[key];
				data.push(pair);
			}
		}
	}

	function getDescriptionReason(resonCode){
		var text = "";
		switch (resonCode){
			case "0": text="NA";                                 break;
			case "1": text="Notified by client";                 break;
			case "2": text="By mobility";                        break;
			case "3": text="By IMEI locked";                     break;
			case "4": text="By NoB28";                           break;
			case "5": text="By NoB28";                           break;
			case "6": text="By IMEI not homologated";            break;
			case "7": text="By IMEI not homologated and locked"; break;
			 default: text += codeReason;                        break;
		}

		return text;
	}

	function test(res) {

		if ( res.length > 0 && res[0]['imei'] ) {
			var imei = res[0]['imei']
			console.log('aca '+res[0]['imei']);

			var originalImei = '{{ $imei }}';

			console.log('originalimei '+(originalImei==imei))
			if(originalImei!=imei)
				imei = originalImei;

			$.ajax({
		            url: "{{ route('history.equipow') }}",
		            data: {
		                'value': $('#msisdn360').val(),
		                'imei': imei
		            }
		        }).done(function (response) {
		        	var obj = jQuery. parseJSON(response);
		        	//console.log( obj );
		            if (obj.eventDate) {
		            	var date = moment(obj.eventDate)
		            	$("#equipofecha").append( date.format('YYYY-MM-DD') );
		            }else{
		            	var date = moment()
		            	$("#equipofecha").append( date.format('YYYY-MM-DD') );
		            }

		            if (obj.eventDate) {
		            	var date2 = moment(obj.eventDate)
		            	$("#equipohora").append( date2.format('HH:mm') );
		            }else{
		            	var date2 = moment()
		            	//$("#equipohora").append( date2.format('HH:mm') );
						$("#equipohora").append( 'N/A' );
		            }

		            $("#equipoimei").append( imei );

                    //Valor de la columna homologated
		            if ( obj.imei ) {
		            	$("#equipohomo").append( obj.imei.homologated );
		            }

		        	//Se agregan los valores de las nuevas columnas
		        	if (obj.deviceFeatures.band28) {
		            	$("#equipoband").append(obj.deviceFeatures.band28);
		            }

		            if (obj.deviceFeatures.volteCapable ) {
			        	$("#equipovolte").append(obj.deviceFeatures.volteCapable);
			        }

                    //Valor de la columna status
		            if ( obj.imei ) {
		                 $("#equipostatus").append( obj.imei.status );
		            }

		            if (obj.brand && obj.model ) {
		            	$("#equipobrand").append( obj.brand +' / '+ obj.model );
		            }

		            if (obj.deviceFeatures.supportedBearers) {$("#equipofeature").append( '<p><strong>SupportedBearers: </strong> '+ obj.deviceFeatures.supportedBearers + '</p><br>');}
		            if (obj.deviceFeatures.radioStack)
					{
						$("#equipofeature").append( '<p><strong>RadioStack: </strong> '+ obj.deviceFeatures.radioStack + '</p><br>');
					}else{
						$("#equipofeature").append( '<p><strong>RadioStack: </strong> </p><br>');
					}
		            if (obj.deviceFeatures.deviceType) {$("#equipofeature").append( '<p><strong>DeviceType: </strong> '+ obj.deviceFeatures.deviceType + '</p><br>');}
		            if (obj.deviceFeatures.os) {$("#equipofeature").append( '<p><strong>OS: </strong> '+ obj.deviceFeatures.os + '</p><br>');}

		            /*if (obj.deviceFeatures) {
			            $.each( obj.deviceFeatures, function( key, value ) {
			            	$("#equipofeature").append( '<p>'+value.value+'</p><p><br></p>' );
			            });
		            }*/

		        })
		        .fail(function() {
		            //$.unblockUI();
		        })
		        .always(function () {
		            //if (check == 1) {$.unblockUI();}
		        })
		}else{
			var imei = '{{$imei}}'
			$.ajax({
		            url: "{{ route('history.equipow') }}",
		            data: {
		                'value': $('#msisdn360').val(),
		                'imei': imei
		            }
		        }).done(function (response) {
		        	//console.log( response );
		        	var obj = jQuery.parseJSON(response);
		        	//console.log( obj );
		            if (obj.eventDate) {
		            	var date = moment(obj.eventDate)
		            	$("#equipofecha").append( date.format('YYYY-MM-DD') );
		            }else{
		            	var date = moment()
		            	$("#equipofecha").append( date.format('YYYY-MM-DD') );
		            }

		            if (obj.eventDate) {
		            	var date2 = moment(obj.eventDate)
		            	$("#equipohora").append( date2.format('HH:mm') );
		            }else{
		            	var date2 = moment()
		            	//$("#equipohora").append( date2.format('HH:mm') );
						$("#equipohora").append( 'N/A');
		            }

		            $("#equipoimei").append( imei );


		            //Columna homologated
		            if ( obj.imei ) {
		            	$("#equipohomo").append( obj.imei.homologated );
		            }


		            //Se agrega valor a la comluna "Soporta banda28"
		            if (obj.deviceFeatures.band28) {
		            	$("#equipoband").append(obj.deviceFeatures.band28);
		            }

		            //Se agrega valor a la columna "Soporta VoLTE"
		            if (obj.deviceFeatures.volteCapable) {
			        	$("#equipovolte").append(obj.deviceFeatures.volteCapable);
			        }

		            //Columna status
		            if ( obj.imei ) {
		                 $("#equipostatus").append( obj.imei.status );
		            }

		            if (obj.brand && obj.model ) {
		            	$("#equipobrand").append( obj.brand +' / '+ obj.model );
		            }

		            if (obj.deviceFeatures.supportedBearers) {$("#equipofeature").append( '<p><strong>SupportedBearers: </strong> '+ obj.deviceFeatures.supportedBearers + '</p><br>');}
					if (obj.deviceFeatures.radioStack)
					{
						$("#equipofeature").append( '<p><strong>RadioStack: </strong> '+ obj.deviceFeatures.radioStack + '</p><br>');
					}else{
						$("#equipofeature").append( '<p><strong>RadioStack: </strong> </p><br>');
					}
		            if (obj.deviceFeatures.deviceType) {$("#equipofeature").append( '<p><strong>DeviceType: </strong> '+ obj.deviceFeatures.deviceType + '</p><br>');}
		            if (obj.deviceFeatures.os) {$("#equipofeature").append( '<p><strong>OS: </strong> '+ obj.deviceFeatures.os + '</p><br>');}


		            /*if (obj.deviceFeatures) {
			            $.each( obj.deviceFeatures, function( key, value ) {
			            	$("#equipofeature").append( '<p>'+value.value+'</p><p><br></p>' );
			            });
		            }*/

		        })
		        .fail(function() {
		            //$.unblockUI();
		        })
		        .always(function () {
		            //if (check == 1) {$.unblockUI();}
		        })
		}

		console.log(res.length)
		console.log(res)
	}
	$(window).on('load', function() {
		var Perfil360 = function () {
        	var datatableInstance    = null,
        		datatableInstanceoffert = null,
        		datatableInstanceconsumos = null,
        		datatableInstancesim = null,
        		datatableInstancestatus = null,
        		datatableInstanceequipo = null,
        		datatableInstanceSusp = null,
        		datatableInstanceRes = null;

        	var initializeDatatablemovilidad = function initializeDatatablemovilidad(check) {
        		bloqueo();
				//alert('ini: '+ $("#mov_txtDate2").val() );
				//alert('fin: '+ $("#mov_txtDate3").val() );
        		$.ajax({
		            url: "{{ route('history.movilidad') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#mov_txtDate2").val(),
		                'fin': $("#mov_txtDate3").val()
		            }
		        }).done(function (response) {
					$('#msg_movilidad').hide();
		        	$('#msg_movilidad').empty();
		        	$('#msg_movilidad').css('color', '#9E1D23');
		        	$('#msg_movilidad').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_movilidad').show();
		            	$('#msg_movilidad').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#movilidad_susp_history_panel').hide();
						$('#movilidad_res_history_panel').hide();
		            }else{
			            console.log('termina consulta movilidad'+moment().format('YYYY-MM-DD HH:mm:ss'));
			            $('#movilidad_susp_history_panel').show();
                        $('#movilidad_res_history_panel').show();
     			        if (datatableInstanceSusp) {
		                	datatableInstanceSusp.destroy();
		            	}
			            datatableInstanceSusp = $('table#movilidad_susp_history').DataTable({
			            	"data": response[0],
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                    	"data": "detectionDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.detectionDate, "YYYYMMDDHH");
			                            return date.format('YYYY-MM-DD');
			                        }
			                	},
			                    {
			                    	"data": "detectionDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.detectionDate, "YYYYMMDDHH");
			                            return date.format('HH:mm:ss');
			                        }
			                    },
			                    {
			                    	"data": "suspendDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.suspendDate);
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                    	"data": "suspendDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.suspendDate);
			                            return date.format('HH:mm:ss');
			                        }
			                    },
			                    {"data": "msisdn"},
			                    {"data": "imsi"},
			                    {"data": "be_id"}
			                ],
			                dom: 'Bfrtip',
							buttons: [
								'csv'
							]

			            });

			            if (datatableInstanceRes) {
			                datatableInstanceRes.destroy();
			            }
			            datatableInstanceRes = $('table#movilidad_res_history').DataTable({
			            	"data": response[1],
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                    	"data": "detectionDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.detectionDate, "YYYYMMDDHH");
			                            return date.format('YYYY-MM-DD');
			                        }
			                	},
			                    {
			                    	"data": "detectionDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.detectionDate, "YYYYMMDDHH");
			                            return date.format('HH:mm:ss');
			                        }
			                    },
			                    {
			                    	"data": "resumeDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.resumeDate);
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                    	"data": "resumeDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.resumeDate);
			                            return date.format('HH:mm:ss');
			                        }
			                    },
			                    {"data": "msisdn"},
			                    {"data": "imsi"},
			                    {"data": "be_id"}
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

        	var initializeDatatableperfil = function initializeDatatableperfil(check) {
        		bloqueo();
        		$.ajax({
		            url: "{{ route('history.perfil') }}",
		            data: {
		                'value': $('#msisdn360').val()
		            }
		        }).done(function (response) {
		        	var obj = jQuery.parseJSON(response);
		        	//console.log( obj );
		        	var tableHSS = $("table#perfilTable");

		        	$('#msg_perfil').hide();
		        	$('#msg_perfil').empty();
		        	$('#msg_perfil').css('color', '#9E1D23');
		        	$('#msg_perfil').css("text-align", "center");
		            if ( obj.errorCode ){
		            	$('#msg_perfil').show();
		            	$('#msg_perfil').append('</br><strong>Respuesta: </strong></br>'+obj.description);
		            }
		        	else{
			        	if ( tableHSS ) {
			        		$("#hlr").empty();
			        		$("#umt").empty();
			        		$("#pdp").empty();
			        		$("#epsPdn").empty();
			        		$("#vlr").empty();
			        		$("#sgs").empty();
			        		$("#eps").empty();
							$("#hss").empty();

							$("#Dscimsi").empty();
			            	$("#Dscnai").empty();
							$("#Dsccategory").empty();
							$("#Dscoverage").empty();
							$("#Dscsubstate").empty();
							$("#Dscsmsenable").empty();
							$("#Dscsubscriberprofileitem").empty();

			        	}


			            if (obj.hlr[0]) {
			            	$.each( obj.hlr[0], function( key, value ) {
				            	$("#hlr").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
			            }

			            if (obj.umtsSubscriber[0]) {
				            $.each( obj.umtsSubscriber[0], function( key, value ) {
				            	$("#umt").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
				        }

				        for (i = 0; i < obj.pdpContext.length; i++ ){
				            if (obj.pdpContext[i]) {
				            	$("#pdp").append( '<li><strong>['+i+']</strong></li>' );
					            $.each( obj.pdpContext[i], function( key, value ) {
					            	$("#pdp").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
					            });
				            }
			        	}
			            for (i = 0; i < obj.epsPdnContext.length; i++ ){
				            if (obj.epsPdnContext[i]) {
				            	$("#epsPdn").append( '<li><strong>['+i+']</strong></li>' );
					            $.each( obj.epsPdnContext[i], function( key, value ) {
					            	$("#epsPdn").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
					            });
				            }
			        	}

			            if (obj.vlrMobData[0]) {
				            $.each( obj.vlrMobData[0], function( key, value ) {
				            	$("#vlr").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
			            }

			            if (obj.sgsnMobData[0]) {
				            $.each( obj.sgsnMobData[0], function( key, value ) {
				            	$("#sgs").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
			            }

			            if (obj.eps[0]) {
				            $.each( obj.eps[0], function( key, value ) {
				            	$("#eps").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
			            }

			            if (obj.hss[0]) {
				            $.each( obj.hss[0], function( key, value ) {
				            	$("#hss").append( '<li><strong>'+key+':</strong> '+value+'</li>' );
				            });
			            }

			            if (obj.dscImsi) {$("#Dscimsi").append( '<li><strong>Dscimsi: </strong> '+ obj.dscImsi + '</li>');}
			            if (obj.dscNai) {$("#Dscnai").append( '<li><strong>Dscnai: </strong> ' + obj.dscNai +'</li>');}
			            if (obj.dscCategory) {$("#Dsccategory").append( '<li><strong>Dsccategory: </strong> ' + obj.dscCategory + '</li>');}
			            if (obj.dsCoverage) {$("#Dscoverage").append( '<li><strong>Dscoverage: </strong> ' + obj.dsCoverage + '</li>');}
			            if (obj.dscSubState) {$("#Dscsubstate").append( '<li><strong>Dscsubstate: </strong> ' + obj.dscSubState + '</li>');}
			            if (obj.dscSmsEnable) {$("#Dscsmsenable").append( '<li><strong>Dscsmsenable: </strong> ' + obj.dscSmsEnable + '</li>');}
			            if (obj.dscSubscriberProfileItem) {$("#Dscsubscriberprofileitem").append( '<li><strong>Dscsubscriberprofileitem: </strong> ' +  obj.dscSubscriberProfileItem + '</li>');}

		        	}
		        })
		        .fail(function() {
		            $.unblockUI();
		        })
		        .always(function () {
		            if (check == 1) {$.unblockUI();}
		        })
		    };

        	var initializeDatatableequipo = function initializeDatatableequipo(check) {
        		bloqueo();
		        var tableEquipo = $("table#tableEquipo");
		        if ( tableEquipo ){
		        	$("#equipofecha").empty();
		        	$("#equipohora").empty();
		        	$("#equipoimei").empty();
		        	$("#equipohomo").empty();

		        	$("#equipoband").empty();
		        	$("#equipovolte").empty();
		        	$("#equipostatus").empty();
		        	$("#equipobrand").empty();
		        	$("#equipofeature").empty();
		        }


		        $.ajax({
		            url: "{{ route('history.equipo') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#equipo_txtDate2").val(),
		                'fin': $("#equipo_txtDate3").val()
		            }
		        }).done(function (response) {
		        	//console.log(response);
                    test(response);

		            $('#msg_equipo').hide();
		        	$('#msg_equipo').empty();
		        	$('#msg_equipo').css('color', '#9E1D23');
		        	$('#msg_equipo').css("text-align", "center");
		            if ( response.errorCode ){
		             	$('#msg_equipo').show();
		             	$('#msg_equipo').append('</br><strong>Respuesta: </strong></br>'+response.description);
		             	$('#equipo_history_panel').hide();
		            }else{
			            console.log('termina consulta equipo'+moment().format('YYYY-MM-DD HH:mm:ss'))
			            $('#equipo_history_panel').show();
			            if (datatableInstanceequipo) {
		                	datatableInstanceequipo.destroy();
		            	}

			            response.shift();
			            datatableInstanceequipo = $('table#equipo_history').DataTable({
			                "data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.eventDate)
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                            var date2 = moment(row.eventDate)
			                            return date2.format('HH:mm');
			                        }
			                    },
			                    {"data": "imei"},

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


        	var initializeDatatableCurrentStatus = function initializeDatatableCurrentStatus(check) {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('history.status') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#status_txtDate2").val(),
		                'fin': $("#status_txtDate3").val()
		            }
		        }).done(function (response) {
		            $('#msg_status').hide();
		        	$('#msg_status').empty();
		        	$('#msg_status').css('color', '#9E1D23');
		        	$('#msg_status').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_status').show();
		            	$('#msg_status').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            }else{
			            console.log('termina consulta current status: '+moment().format('YYYY-MM-DD HH:mm:ss'))
			            var cstatus = 0;
			            $.each( response, function( key, value ) {
			            	if (cstatus == 0) {
			            		if ($('#statusSubscriber').val()==value.status) {
				            		if(value.eventDate.length > 2){
				            			var date = moment(value.eventDate);
					            		$('#fecha_estado').text(date.format('YYYY-MM-DD'))
					            		$('#hora_estado').text(date.format('HH:mm'))
				            		}else{
				            			$('#fecha_estado').text('N/A')
					            		$('#hora_estado').text('N/A')
				            		}

				            		$('#status_estado').text(value.status)
				            		$('#status_reason').text(value.reason)
			            		}else{
			            			$('#fecha_estado').text('N/A')
					            	$('#hora_estado').text('N/A')
					            	$('#status_estado').text( $('#statusSubscriber').val() )
					            	$('#status_reason').text( $('#reasonStatusSubscriber').val() )

			            		}

			            	}
			            	cstatus=1;
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


        	var initializeDatatablestatus = function initializeDatatablestatus(check) {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('history.status') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#status_txtDate2").val(),
		                'fin': $("#status_txtDate3").val()
		            }
		        }).done(function (response) {
		            $('#msg_status').hide();
		        	$('#msg_status').empty();
		        	$('#msg_status').css('color', '#9E1D23');
		        	$('#msg_status').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_status').show();
		            	$('#msg_status').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#state_history_panel').hide();
		            }else{
			            console.log('termina consulta status: '+moment().format('YYYY-MM-DD HH:mm:ss'))
			            $('#state_history_panel').show();
    		            if (datatableInstancestatus) {
		                    datatableInstancestatus.destroy();
		                }
			            datatableInstancestatus = $('table#status_history').DataTable({
			                "data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.eventDate)
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                            var date2 = moment(row.eventDate)
			                            return date2.format('HH:mm');
			                        }
			                    },
			                    {"data": "status"},
			                    {"data": "reason"}
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

        	var initializeDatatablesim = function initializeDatatablesim(check) {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('history.sim') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#sim_txtDate2").val(),
		                'fin': $("#sim_txtDate3").val()
		            }
		        }).done(function (response) {
		        	//console.log(response);
		        	$('#msg_sim').hide();
		        	$('#msg_sim').empty();
		        	$('#msg_sim').css('color', '#9E1D23');
		        	$('#msg_sim').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_sim').show();
		            	$('#msg_sim').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#sim_history_panel').hide();
		            }
		            else{
		            	$('#sim_history_panel').show();
			            if (datatableInstancesim) {
			                datatableInstancesim.destroy();
			            }
			            datatableInstancesim = $('table#sim_history').DataTable({
			                "data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.eventDate)
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                            var date2 = moment(row.eventDate)
			                            return date2.format('HH:mm');
			                        }
			                    },
			                    {"data": "imsi"},
			                    {"data": "iccid"}
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

        	var initializeDatatableconsumos = function initializeDatatableconsumos(check) {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('history.consumos') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),

		                'ini': $("#consumos_txtDate2").val(),
		                'fin': $("#consumos_txtDate3").val()
		            }
		        }).done(function (response) {
					$('#msg_consumos').hide();
		        	$('#msg_consumos').empty();
		        	$('#msg_consumos').css('color', '#9E1D23');
		        	$('#msg_consumos').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_consumos').show();
		            	$('#msg_consumos').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#consumos_history_panel').hide();
		            }else{
			            console.log('termina consulta consumos'+moment().format('YYYY-MM-DD HH:mm:ss'));
			            $('#consumos_history_panel').show();
			            if (datatableInstanceconsumos) {
		                	datatableInstanceconsumos.destroy();
		            	}
			            datatableInstanceconsumos = $('table#consumos_history').DataTable({
			                "data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.eventDate)
			                            return date.format('YYYY-MM-DD');
			                        }
			                    },
			                    {
			                        "data": "eventDate",
			                        "render": function ( data, type, row ) {
			                            var date2 = moment(row.eventDate)
			                            return date2.format('HH:mm');
			                        }
			                    },
			                    {
			                    	"data": "service",
			                        "render": function ( data, type, row ) {
			                            if (row.service) {return row.service;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "type",
			                        "render": function ( data, type, row ) {
			                            if (row.type) {return row.type;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "origin",
			                        "render": function ( data, type, row ) {
			                            if (row.origin) {
			                            	if ( row.origin == '52140' || row.origin == '52141' || row.origin == '1086' ) {
			                            		return row.origin+'(*)';
			                            	}
			                            	return row.origin;
			                            }
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "destiny",
			                        "render": function ( data, type, row ) {
			                            if (row.destiny) {
			                            	if ( row.destiny == '52140' || row.destiny == '52141' ) {return row.destiny+'(*)';}
			                            	return row.destiny;
			                            }
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "callForwarding",
			                        "render": function ( data, type, row ) {
			                            if (row.callForwarding) {return row.callForwarding;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "endReason",
			                        "render": function ( data, type, row ) {
			                            if (row.endReason) {return row.endReason;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "sendResult",
			                        "render": function ( data, type, row ) {
			                            if (row.sendResult) {return row.sendResult;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "smsMessageId",
			                        "render": function ( data, type, row ) {
			                            if (row.smsMessageId) {return row.smsMessageId;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "amount",
			                        "render": function ( data, type, row ) {
			                            if (row.amount) {return row.amount;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "service",
			                        "render": function ( data, type, row ) {
			                            if (row.service == 'Datos') {return 'Mb';}
			                            if (row.service == 'Voz') {return 'Minutos';}
			                            if (row.service == 'SMS') {return 'Eventos';}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "nationalRoaming",
			                        "render": function ( data, type, row ) {
			                            if (row.nationalRoaming) {return row.nationalRoaming;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "internationalRoaming",
			                        "render": function ( data, type, row ) {
			                            if (row.internationalRoaming) {return row.internationalRoaming;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "imsi",
			                        "render": function ( data, type, row ) {
			                            if (row.imsi) {return row.imsi;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "imei",
			                        "render": function ( data, type, row ) {
			                            if (row.imei) {return row.imei;}
			                            return ' ';
			                        }
			                    },
			                    {"data": "accessPrefix",
			                        "render": function ( data, type, row ) {
			                            if (row.accessPrefix) {return row.accessPrefix;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "apn",
			                        "render": function ( data, type, row ) {
			                            if (row.apn) {return row.apn;}
			                            return ' ';
			                        }
			                	},
			                    {
			                    	"data": "rg",
			                        "render": function ( data, type, row ) {
			                            if (row.rg) {return row.rg;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "offeringId",
			                        "render": function ( data, type, row ) {
			                            if (row.offeringId) {return row.offeringId;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "ldi",
			                        "render": function ( data, type, row ) {
			                            if (row.ldi) {return row.ldi;}
			                            return ' ';
			                        }
			                    },
			                    {
			                    	"data": "country" ,
			                        "render": function ( data, type, row ) {
			                            if (row.country) {return row.country;}
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

        	var initializeDatatableoffert = function initializeDatatableoffert(check) {
        		bloqueo();
		        $.ajax({
		            url: "{{ route('history.offerts') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#offert_txtDate2").val(),
		                'fin': $("#offert_txtDate3").val()
		            }
		        }).done(function (response) {
		        	$('#msg_offert').hide();
		        	$('#msg_offert').empty();
		        	$('#msg_offert').css('color', '#9E1D23');
		        	$('#msg_offert').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_offert').show();
		            	$('#msg_offert').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#offert_history_panel').hide();
		            }else{
			            console.log('termina consulta operaciones'+moment().format('YYYY-MM-DD HH:mm:ss'));
			            $('#offert_history_panel').show();
		            	if (datatableInstanceoffert) {
		                	datatableInstanceoffert.destroy();
		            	}
			            datatableInstanceoffert = $('table#offert_history').DataTable({
			                "data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    { "data": "offeringId" },
			                    {"data": "service"},
			                    {"data": "uom",
			                        "render": function ( data, type, row ) {
										return <?php
			                        				if ( isset($profile->subscriber->product) and $profile->subscriber->product=='IoT' ){
			                        					echo "'MB'";
			                        				}else{
			                        					echo "row.uom";
			                        				}
			                        				?>;
									}
								},
			                    {"data": "initialAmt"},
			                    {"data": "startEffectiveDate"},
			                    {"data": "expireEffectiveDate"},
								{"data": "downlinkSpeed"},
								{"data": "isRenewable"}
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
        	var initializeDatatable = function initializeDatatable(check) {
        		bloqueo();
        		console.log('inicia consulta operaciones'+moment().format('YYYY-MM-DD HH:mm:ss'))
		        $.ajax({
		            url: "{{ route('history.operations') }}",
		            dataType: 'json',
		            data: {
		                'value': $('#msisdn360').val(),
		                'ini': $("#op_txtDate2").val(),
		                'fin': $("#op_txtDate3").val()
		            }
		        }).done(function (response) {
		        	$('#msg_operations').hide();
		        	$('#msg_operations').empty();
		        	$('#msg_operations').css('color', '#9E1D23');
		        	$('#msg_operations').css("text-align", "center");
		            if ( response.errorCode ){
		            	$('#msg_operations').show();
		            	$('#msg_operations').append('</br><strong>Respuesta: </strong></br>'+response.description);
		            	$('#operations_history_panel').hide();
		            }else{
			            console.log('termina consulta operaciones'+moment().format('YYYY-MM-DD HH:mm:ss'))
			            $('#operations_history_panel').show();
         		        if (datatableInstance) {
		                	datatableInstance.destroy();
		            	}
			            datatableInstance = $('table#operations_history').DataTable({
			            	"data": response,
			                "pageLength": 5,
			                "order": [[ 0, "desc" ]],
			                "columns": [
			                    {
			                    	"data": "receivedDate",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.receivedDate)
			                            return date.format('YYYY-MM-DD HH:mm');
			                        }
			                    },
			                    {"data": "type"},

			                    {"data": "mvno",
			                        "render": function ( data, type, row ) {
			                        	return " <?php
			                        				if ( isset($profile) ){
			                        					echo $profile->mvno->nombre;
			                        				}else{
			                        					echo "";
			                        				}
			                        				?>";
			                        }
			                    },
			                    {"data": "user"},
			                    {
			                    	"data": "startExecute",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.startExecute)
			                            return date.format('YYYY-MM-DD HH:mm');
			                        }
			                    },
			                    {
			                    	"data": "endExecute",
			                        "render": function ( data, type, row ) {
			                        	var date = moment(row.endExecute)
			                            return date.format('YYYY-MM-DD HH:mm');
			                        }
			                    },
			                    {
			                        "data": "totalTime",
			                        "render": function ( data, type, row ) {
			                            return row.totalTime +'s';
			                        }
								},
								{
			                        "data": "request",
			                        "render": function ( data, type, row, meta ) {
										if (row.type == 'Historial de Consumos' || row.type == 'Historial de Operaciones') { return 'N/A' }

										try{
											var a = jQuery.parseJSON(row.request.payload);
											if ( a && a.payload && a.payload.content){
												return evalJson(JSON.parse(a.payload.content));
											}
										}catch(e){
											return "N/A";
										}
			                        	return "N/A";
			                        }
			                    },
								{
			                        "data": "transactionStatus",
			                        "render": function ( data, type, row ) {
			                            return row.transactionStatus == "1" ? "Exitosa" : "Fallida";
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
				    $("#op_txtDate3").attr('max', maxDate);
				    $("#offert_txtDate3").attr('max', maxDate);
				    $("#consumos_txtDate3").attr('max', maxDate);

				    $("#sim_txtDate3").attr('max', maxDate);
				    $("#status_txtDate3").attr('max', maxDate);
				});

				$("#consult_operations").click(function (e) {
					f1 = $("#op_txtDate2").val();
					f2 = $("#op_txtDate3").val();
					$('#msg_operations').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_operations').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatable(1);
				});
				$("#consult_offert").click(function (e) {
					f1 = $("#offert_txtDate2").val();
					f2 = $("#offert_txtDate3").val();
					$('#msg_offert').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_offert').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatableoffert(1);
				});
				$("#consult_consumos").click(function (e) {
					f1 = $("#consumos_txtDate2").val();
					f2 = $("#consumos_txtDate3").val();
					$('#msg_offert').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_consumos').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatableconsumos(1);
				});
				$("#consult_sim").click(function (e) {
					f1 = $("#sim_txtDate2").val();
					f2 = $("#sim_txtDate3").val();
					$('#msg_offert').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_sim').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatablesim(1);
				});
				$("#consult_status").click(function (e) {
					f1 = $("#status_txtDate2").val();
					f2 = $("#status_txtDate3").val();
					$('#msg_status').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_status').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatablestatus(1);
				});
				$("#consult_equipo").click(function (e) {
					f1 = $("#equipo_txtDate2").val();
					f2 = $("#equipo_txtDate3").val();
					$('#msg_equipo').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_equipo').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatableequipo(1)
				});
				$("#consult_movilidad").click(function (e) {
					console.log("inicializando boton movilidad")
					f1 = $("#mov_txtDate2").val();
					f2 = $("#mov_txtDate3").val();
					$('#msg_movilidad').empty();
					if ( f1.length < 1 || f2.length < 1 ) {
						$('#msg_movilidad').append('<label class="help-block mb-30 text-left"><strong>Las fechas son obligatorias</strong> ');
						return false;
					}

					initializeDatatablemovilidad(1);
				});


				$("#export_operations").on("click", function() {
				    datatableInstance.button( '.buttons-csv' ).trigger();
				});


				$("#ofertas_tab").on("click", function() {
				    initializeDatatableoffert(1);
				});
				$("#status_tab").on("click", function() {
				    initializeDatatableCurrentStatus(1);
				});
				$("#operaciones_tab").on("click", function() {
				    initializeDatatable(1);
				});
				$("#consumos_tab").on("click", function() {
				    initializeDatatableconsumos(1);
				});
				//$("#sim_card_tab").on("click", function() {
				//});
				$("#caracteristicas_tab").on("click", function() {
				    initializeDatatableequipo(1);
				});
				$("#perfil_tab").on("click", function() {
				    initializeDatatableperfil(1);
				});
				$("#movi_tab").on("click", function() {
				    initializeDatatablemovilidad(1);
				});
			}

			// Public Methods
		    return {
		        init: function() {
		            initializePlugins();
		            /*initializeDatatable(0);
		            initializeDatatablestatus(0);
		            initializeDatatablesim(0);
		            initializeDatatableconsumos(0);
		            initializeDatatableequipo(0);
		            initializeDatatableoffert(0);

		            initializeDatatableperfil(0);
		            initializeDatatablemovilidad(0);*/

		            /*var ini = moment().subtract(30, 'days');
		            var fin = moment();

		            $("#status_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#status_txtDate3").val(fin.format('YYYY-MM-DD'));
					$("#sim_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#sim_txtDate3").val(fin.format('YYYY-MM-DD'));
					//$("#consumos_txtDate2").val(ini.format('YYYY-MM-DD'));
					//$("#consumos_txtDate3").val(fin.format('YYYY-MM-DD'));
					$("#op_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#op_txtDate3").val(fin.format('YYYY-MM-DD'));
					$("#offert_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#offert_txtDate3").val(fin.format('YYYY-MM-DD'));
		            $("#equipo_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#equipo_txtDate3").val(fin.format('YYYY-MM-DD'));
					$("#perfil_txtDate2").val(ini.format('YYYY-MM-DD'));
					$("#perfil_txtDate3").val(fin.format('YYYY-MM-DD'));
					*/

					/*Test date components*/

					//console.log($('.fecha').datetimepicker());

					$.unblockUI();
		        }
		    };

		}
		Perfil360().init();

	});
</script>
@endsection

