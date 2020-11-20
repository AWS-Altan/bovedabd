/*FormPicker Init*/

function customRange() {
	//var fechafin=$('#fechafin').datepicker("getDate");
	//var fechaini=$('#fecha').datepicker("getDate");

	//console.log($('#consumos_txtDate2').datepicker('option', 'maxDate'));

	$('#dateInicioConsumo').data("DateTimePicker").maxDate(new Date(2019, 10, 10));
}

$(document).ready(function() {
	"use strict";

	
	$('.tabla').DataTable({
		"language": {
	            		"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			},
        	"lengthMenu": [[1, 2, 5, 10, 20, 50, 100], [1, 2, 5, 10, 20, 50, 100]],
		"pageLength": 2
        });

/*	$('.tabla').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        //"lengthMenu": [[10, 50, 75, 100, -1], [10, 50, 75, 100, "Todos"]],
		scrollY:        '36.8vh',
        scrollCollapse: true,
        paging:         true,
        
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(

                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
*/
	
	/* Bootstrap Colorpicker Init*/
	$('.colorpicker').colorpicker();

	$('.colorpicker-rgb').colorpicker({
		color: '#AA3399',
		format: 'rgba'
	});

	$('.colorpicker-inline').colorpicker({
		color: '#ffaa00',
		container: true,
		inline: true
	});
	
	/* Datetimepicker Init*/
	$('.fecha').datetimepicker({
			useCurrent: false,
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
		}).on('dp.show', function() {
		
			//$(this).data("DateTimePicker").date(moment());
			customRange();
		
		}
	);
	$('.fechafin').datetimepicker({
			useCurrent: false,
			format: 'MM/DD/YYYY',
			showClose: true,
			maxDate: moment(),
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
		}).on('dp.show', function() {
		
			//$(this).data("DateTimePicker").date(moment());
			customRange();
		
		}
	);
	$('.fechafinoffert').datetimepicker({
			useCurrent: false,
			format: 'MM/DD/YYYY',
			showClose: true,
			maxDate: moment(),
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
		}).on('dp.show', function() {
		if($(this).data("DateTimePicker").date() === null){
			//$(this).data("DateTimePicker").date(moment());
		}
	});

	// -------------------------------- Tab Consumos --------------------------------------
	$('#dateInicioConsumo').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinConsumo').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinConsumo').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinConsumo').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinConsumo').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioConsumo').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioConsumo').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioConsumo').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});


	// ----------------------------------- Tab Estado -----------------------------------------
	$('#dateInicioEstado').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinEstado').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinEstado').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinEstado').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinEstado').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioEstado').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioEstado').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioEstado').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ------------------------------------ Tab Equipo -----------------------------------------------
	$('#dateInicioEquipo').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinEquipo').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinEquipo').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinEquipo').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinEquipo').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioEquipo').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioEquipo').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioEquipo').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ----------------------------------- Tab Resumen ----------------------------------------------
	$('#dateInicioResumen').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinResumen').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinResumen').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinResumen').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinResumen').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioResumen').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioResumen').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioResumen').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// -------------------------------------- Movilidad ------------------------------------------------
	$('#dateInicioMovilidad').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinMovilidad').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinMovilidad').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinMovilidad').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinMovilidad').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioMovilidad').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioMovilidad').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioMovilidad').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ----------------------------------- Tab Ofertas ---------------------------------------------
	$('#dateInicioOfertas').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinOfertas').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinOfertas').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinOfertas').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinOfertas').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioOfertas').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioOfertas').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioOfertas').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ------------------------------------ Tab Operaciones --------------------------------------------
	$('#dateInicioOperaciones').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
	}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinOperaciones').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinOperaciones').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinOperaciones').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinOperaciones').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
	}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioOperaciones').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioOperaciones').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioOperaciones').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ------------------------------------ Tab SIM --------------------------------------------
	$('#dateInicioSim').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day').subtract(7, 'days'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateFinSim').data("DateTimePicker").viewDate(), 'days') < -7 
			|| moment(e.date).diff($('#dateFinSim').data("DateTimePicker").viewDate(), 'days') >= 0){
			$('#dateFinSim').data("DateTimePicker").date(moment(e.date).add(7, 'days'));
		}
	});

	$('#dateFinSim').datetimepicker({
			useCurrent: false,
			defaultDate: moment().startOf('day'),
			format: 'MM/DD/YYYY',
			showClose: true,
			icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
		}).on('dp.change', function(e){
		if(moment(e.date).diff($('#dateInicioSim').data("DateTimePicker").viewDate(), 'days') > 7
			|| moment(e.date).diff($('#dateInicioSim').data("DateTimePicker").viewDate(), 'days') <= 0){
			$('#dateInicioSim').data("DateTimePicker").date(moment(e.date).subtract(7, 'days'));
		}
	});

	// ------------------------------------------------------------------------------------------	
	$('.input-daterange-timepicker').daterangepicker({
		timePicker: true,
		format: 'MM/DD/YYYY h:mm A',
		timePickerIncrement: 30,
		timePicker12Hour: true,
		timePickerSeconds: false,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-info',
		cancelClass: 'btn-default'
	});
	$('.input-limit-datepicker').daterangepicker({
		format: 'MM/DD/YYYY',
		minDate: '06/01/2015',
		maxDate: '06/30/2015',
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-info',
		cancelClass: 'btn-default',
		dateLimit: {
			days: 6
		}
	});
});
