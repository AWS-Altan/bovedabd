<!-- Nombre: lef-side.blade.php -->
<!-- Descripcion: Menu de la izquierda  -->
<!-- historial Modificaciones -->
<!-- 	2020/11/11 - menu Generico  -->
<!--  -->
<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar fixed">



        <!-- Menu Administración Equipos -->
        <!-- modif 2021/01/18 Renombre - Menu Administración Equipos -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#acciones_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Admin de Equipos</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="acciones_dr" class="collapse collapse-level-1 two-col-list">

                <!-- Modificación de Catalogo de Dispositivos -->
                <!-- modif 2021/01/04 -->
                @if ( !isset( $menu[45] ) )
				<li>
                    <a href="{{ route('access.update_dispcatalog.index') }}">
						<div class="pull-left"><span class="right-nav-text">Equipos Cargados </span></div>
						<div class="clearfix"></div>
					    </a>
					</li>
                @endif


                <!-- Modificación de Masivo Catalogo de Dispositivos -->
                <!-- modif 2021/01/12 -->
                @if ( !isset( $menu[47] ) )
				<li>
                    <a href="{{ route('access.massive_dispcatalog.index') }}">
						<div class="pull-left"><span class="right-nav-text">Carga Masiva de Equipos</span></div>
						<div class="clearfix"></div>
					</a>
				</li>
                @endif

                <!-- Alta de Catalogo de dispositivos -->
                <!-- modif 2021/01/06 -->
                @if ( !isset( $menu[46] ) )
				<li>
                    <a href="{{ route('access.insert_dispcatalog.index') }}">
					    <div class="pull-left"><span class="right-nav-text">Carga de Equipo</span></div>
						<div class="clearfix"></div>
					</a>
				</li>
                @endif


			</ul>
        </li>



        <!-- Antes BATCH -->
        <!-- modif 2021/01/12 renombre - Administración de Usuarios -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#batch_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Admin de Usuarios</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="batch_dr" class="collapse collapse-level-1 two-col-list">

                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[36] ) )
                    <li>
                        <a href="{{ route('batch.masive_alta.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Alta Masiva de Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[39] ) )
                    <li>
                        <a href="{{ route('batch.masive_baja.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Baja Masiva de Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[42] ) )
                    <li>
                        <a href="{{ route('batch.masive_change.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Cambios de Priv. Masivo Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/04/08 -->
                @if ( !isset( $menu[49] ) )
                    <li>
                        <a href="{{ route('batch.masive_rotate.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Rotación Masiva de Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/04/08 -->
                @if ( !isset( $menu[50] ) )
                    <li>
                        <a href="{{ route('batch.masive_endsec.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Termino de Sesión Masivo de Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[35] ) )
                    <li>
                        <a href="{{ route('batch.altareport.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Reporte Alta Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[38] ) )
                    <li>
                        <a href="{{ route('batch.bajareport.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Reporte Baja dispositivos</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif
                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[41] ) )
                    <li>
                        <a href="{{ route('batch.changereport.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Reporte Cambio de Priv. Usuarios</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif
                <!-- Reporte de Usuarios Dispositivos -->
                <!-- modif 2021/01/04 -->
                <!-- modif 2021/01/18 Renombre - Equipos Cargados -->
                @if ( !isset( $menu[44] ) )
					<li>
						<a href="{{ route('access.report_userdisp.index') }}">
							<div class="pull-left"><span class="right-nav-text">Usuarios Cargados</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

			</ul>
        </li>


        <!-- Solicitud de Accesos -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#solicitides_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Solicitud de Accesos</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="solicitides_dr" class="collapse collapse-level-1 two-col-list">

                <!-- Alta usuarios -->
                <!-- modif 2021/01/18 Cambio de ubicación - Menu Administración Equipos -->
                @if ( !isset( $menu[26] ) )
                    <li>
                        <a href="{{ route('access.alta_user.index') }}">
                            <div class="pull-left"><span class="right-nav-text">Alta Usuarios Dispositivos</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif

            </ul>
        </li>

        <!-- Manejo de Plataformas -- Dispoitivos -->
<!--        <li><hr class="light-grey-hr mb-10"/></li> -->
<!--		@if ( !isset( $menu[10] )  )-->
<!--		<li>-->
<!--			<a href="javascript:void(0);" data-toggle="collapse" data-target="#portabilidad_dr"><div class="pull-left"><i class="fa fa-sliders  mr-20"></i><span class="right-nav-text">Dispositivos</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>-->
<!--			<ul id="portabilidad_dr" class="collapse collapse-level-1 two-col-list">-->

<!--                @if ( !isset( $menu[11] )  )-->
<!--					<li>-->
<!--						<a href="{{ route('Dispositivo.Alta_dispos.index') }}">-->
<!--							<div class="pull-left"><span class="right-nav-text">Alta Dispositivos</span></div>-->
<!--							<div class="clearfix"></div>-->
<!--						</a>-->
<!--					</li>-->
<!--				@endif-->

<!--                @if ( !isset( $menu[12] )  )-->
<!--					<li>-->
<!--						<a href="{{ route('Dispositivo.View_dispos.index') }}">-->
<!--							<div class="pull-left"><span class="right-nav-text">Consulta Dispositivos</span></div>-->
<!--							<div class="clearfix"></div>-->
<!--						</a>-->
<!--					</li>-->
<!--				@endif-->

<!--                @if ( !isset( $menu[13] )  )-->
<!--					<li>-->
<!--						<a href="{{ route('Dispositivo.Modif_dispos.index') }}">-->
<!--							<div class="pull-left"><span class="right-nav-text">Modificacion Dispositivos</span></div>-->
<!--							<div class="clearfix"></div>-->
<!--						</a>-->
<!--					</li>-->
<!--                @endif-->

                <!-- Adicion 2020/11/27 -->
<!--                @if ( !isset( $menu[24] ) ) -->
<!--					<li>-->
<!--						<a href="{{ route('Dispositivo.Masive_creation.index') }}">-->
<!--							<div class="pull-left"><span class="right-nav-text">Alta Masiva de Dispositivos</span></div>-->
<!--							<div class="clearfix"></div>-->
<!--						</a>-->
<!--					</li>-->
<!--				@endif-->


<!--                @if ( !isset( $menu[52] )  )-->
<!--					<li>-->
<!--						<a href="{{ route('iot.home.query-high-consumptions') }}">-->
<!--							<div class="pull-left"><span class="right-nav-text">Reporte tabla 1</span></div>-->
<!--							<div class="clearfix"></div>-->
<!--						</a>-->
<!--					</li>-->
<!--				@endif-->


<!--			</ul>-->
<!--		</li>-->
<!--		@endif-->


        <!-- Manejo de Actividades -->
        <!-- modif 2021/01/18 Renombre - Actividades CQR -->
        <li><hr class="light-grey-hr mb-10"/></li>
        @if ( !isset( $menu[14] )  )
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#guias_dr"><div class="pull-left"><i class="fa fa-file-text mr-20"></i><span class="right-nav-text">Actividades (CRQ)</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="guias_dr" class="collapse collapse-level-1 two-col-list">

                @if ( !isset( $menu[15] )  )
					<li>
						<a href="{{ route('Actividades.View_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Actividades Cargadas</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                <!-- @if ( !isset( $menu[16] )  ) -->
				<!-- 	<li> -->
				<!-- 		<a href="{{ route('Actividades.Modif_activ.index') }}"> -->
				<!-- 			<div class="pull-left"><span class="right-nav-text">Modificacion de Actividades</span></div> -->
				<!-- 			<div class="clearfix"></div> -->
				<!-- 		</a> -->
				<!-- 	</li> -->
				<!-- @endif -->

                @if ( !isset( $menu[17] )  )
					<li>
						<a href="{{ route('Actividades.View_Remedy.index') }}">
							<div class="pull-left"><span class="right-nav-text">Revision de actividades vigentes Remedy</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                <!-- @if ( !isset( $menu[18] )  ) -->
				<!-- 	<li> -->
				<!-- 		<a href="{{ route('Actividades.Calendar_activ.index') }}"> -->
				<!-- 			<div class="pull-left"><span class="right-nav-text">Calendariazación passwords</span></div> -->
				<!-- 			<div class="clearfix"></div> -->
				<!-- 		</a> -->
				<!-- 	</li> -->
                <!-- @endif -->

                <!-- @if ( !isset( $menu[19] )  ) -->
				<!-- 	<li> -->
				<!-- 		<a href="{{ route('Actividades.Program_activ.index') }}"> -->
				<!-- 			<div class="pull-left"><span class="right-nav-text">Reprogramación de Actividades</span></div> -->
				<!-- 			<div class="clearfix"></div> -->
				<!-- 		</a> -->
				<!-- 	</li> -->
                <!-- @endif -->

                <!-- @if ( !isset( $menu[20] )  ) -->
				<!-- 	<li> -->
				<!-- 		<a href="{{ route('Actividades.Cancel_activ.index') }}"> -->
				<!-- 			<div class="pull-left"><span class="right-nav-text">Cancelación de Actividades</span></div> -->
				<!-- 			<div class="clearfix"></div> -->
				<!-- 		</a> -->
				<!-- 	</li> -->
                <!-- @endif       -->

                <!-- @if ( !isset( $menu[53] ) ) -->
				<!-- <li> -->
				<!-- 	<a href="{{ route('consulta.index' , array('isMob'=>'false') ) }}"> -->
				<!-- 		<div class="pull-left"><span class="right-nav-text">Consulta con busqueda</span></div> -->
				<!-- 		<div class="clearfix"></div></a> -->
				<!-- </li> -->
                <!-- @endif -->

			</ul>
	    </li>
		@endif

		<li><hr class="light-grey-hr mb-10"/></li>

        <!-- Manejo de Tickets -->
        <!-- modif 2021/01/18 Renombre - Incidentes -->
        @if ( !isset( $menu[21] )  )
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#Tickets"><div class="pull-left"><i class="fa fa-sliders  mr-20"></i><span class="right-nav-text">Incidentes</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="Tickets" class="collapse collapse-level-1 two-col-list">

               @if ( !isset( $menu[22] ) )
				<li>
					<a href="{{ route('Tickets.View_ticket_cons.index' , array('isMob'=>'false') ) }}">
						<div class="pull-left"><span class="right-nav-text">Consulta de Tickets</span></div>
						<div class="clearfix"></div></a>
				</li>
                @endif


            </ul>

		</li>
		@endif

        <li><hr class="light-grey-hr mb-10"/></li>

        @if ( !isset( $menu[37] )  )
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#Bton_red"><div class="pull-left"><i class="fa fa-sliders  mr-20"></i><span class="right-nav-text">Bot&oacute;n rojo</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="Bton_red" class="collapse collapse-level-1 two-col-list">

               @if ( !isset( $menu[38] ) )
				<li>
					<a href="{{ route('Tickets.View_ticket.index') }}">
						<div class="pull-left"><span class="right-nav-text">Actividades Actuales</span></div>
						<div class="clearfix"></div></a>
				</li>
                @endif

            </ul>

		</li>
		@endif




        <!-- Manejo de Usuarios Internos del sistema -->
        <li><hr class="light-grey-hr mb-10"/></li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#operaciones_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Configuración</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="operaciones_dr" class="collapse collapse-level-1 two-col-list">


                <!-- Alta usuarios -->
                @if ( !isset( $menu[47] ) )
					<li>
						<a href="{{ route('Users.alta_solicitantes.index') }}">
							<div class="pull-left"><span class="right-nav-text">Alta de solicitantes</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif


                <!-- Alta usuarios -->
                @if ( !isset( $menu[2] ) )
					<li>
						<a href="{{ route('Users.alta_user.index') }}">
							<div class="pull-left"><span class="right-nav-text">Alta usuarios</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[3] ) )
					<li>
						<a href="{{ route('Users.baja_user.index') }}">
							<div class="pull-left"><span class="right-nav-text">Baja usuario</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[4] ) )
					<li>
						<a href="{{ route('Users.modif_user.index') }}">
							<div class="pull-left"><span class="right-nav-text">Modificación de usuario</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[6] ) )
					<li>
						<a href="{{ route('Users.Active_user.index') }}">
							<div class="pull-left"><span class="right-nav-text">Activación de usuario</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[7] ) )
					<li>
						<a href="{{ route('Users.Deactive_user.index') }}">
							<div class="pull-left"><span class="right-nav-text">Desactivación de usuario</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[8] ) )
					<li>
						<a href="{{ route('Users.Change_pass.index') }}">
							<div class="pull-left"><span class="right-nav-text">Cambiar / Rotar Password</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif


                <!-- Adicion 2020/11/26 -->
                @if ( !isset( $menu[23] ) )
					<li>
						<a href="{{ route('Users.Masive_Sign_in.index') }}">
							<div class="pull-left"><span class="right-nav-text">Alta Masiva de usuarios</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
				@endif

			</ul>
		</li>





		<li><hr class="light-grey-hr mb-10"/></li>

		<li>
			<a href="#" onclick="document.getElementById('logout-form').submit();"><div class="pull-left"><i class="fa fa-sign-out mr-20"></i><span class="right-nav-text">Cerrar sesi&oacute;n</span></div><div class="clearfix"></div></a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
		</li>
	</ul>
</div>
