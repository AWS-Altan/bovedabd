<!-- Nombre: lef-side.blade.php -->
<!-- Descripcion: Menu de la izquierda  -->
<!-- historial Modificaciones -->
<!-- 	2020/11/11 - menu Generico  -->
<!--  -->
<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar fixed">


        <!-- BATCH -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#batch_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Batch</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="batch_dr" class="collapse collapse-level-1 two-col-list">


                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[35] ) )
					<li>
						<a href="{{ route('Batch.Report.index') }}">
							<div class="pull-left"><span class="right-nav-text">Reporte dispositivos</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif
                <!-- Adicion 2020/12/03 -->
                @if ( !isset( $menu[36] ) )
					<li>
						<a href="{{ route('Batch.Masive_SignIn.index') }}">
							<div class="pull-left"><span class="right-nav-text">Alta Masiva de Dispositivos</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
				@endif

			</ul>
        </li>


        <!-- Manejo de Usuarios de Plataformas -->
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#acciones_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Usuarios Dispositivos</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="acciones_dr" class="collapse collapse-level-1 two-col-list">

                <!-- Alta usuarios -->
                @if ( !isset( $menu[26] ) )
					<li>
						<a href="{{ route('Access.alta_userman.index') }}">
							<div class="pull-left"><span class="right-nav-text">Alta Relacion Accesos Usuarios</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

				@if ( !isset( $menu[25] ))
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#prereg_dr">
						<div class="pull-left"></i><span class="right-nav-text">Usuarios Dispositivos</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="prereg_dr" class="collapse collapse-level-1 two-col-list">
                        <!-- Alta usuarios -->
                        @if ( !isset( $menu[26] ) )
                            <li>
                                <a href="{{ route('Access.alta_user.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Alta Usuarios Dispositivos</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif


                        @if ( !isset( $menu[27] ) )
                            <li>
                                <a href="{{ route('Access.baja_user.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Baja Accesos Usuario</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[28] ) )
                            <li>
                                <a href="{{ route('Access.modif_user.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Modificación de Accesos Usuario</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[29] ) )
                            <li>
                                <a href="{{ route('Access.View_pass.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Consulta de Password</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[30] ) )
                            <li>
                                <a href="{{ route('Access.Active_user.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Activación de usuarios</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[31] ) )
                            <li>
                                <a href="{{ route('Access.Deactive_user.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Desactivación de usuarios</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[32] ) )
                            <li>
                                <a href="{{ route('Access.Change_pass.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Cambiar / Rotar Passwords</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        @if ( !isset( $menu[33] ) )
                            <li>
                                <a href="{{ route('Access.Send_pass.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Envio de Contraseñas</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                        <!-- Adicion 2020/11/26 -->
                        @if ( !isset( $menu[34] ) )
                            <li>
                                <a href="{{ route('Access.Masive_Sign_in.index') }}">
                                    <div class="pull-left"><span class="right-nav-text">Alta Masiva de usuarios</span></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                        @endif

                    </ul>
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

                <!-- sisfen - falta gestion de credenciales del elemento -->


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
        <li><hr class="light-grey-hr mb-10"/></li>
        @if ( !isset( $menu[14] )  )
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#guias_dr"><div class="pull-left"><i class="fa fa-file-text mr-20"></i><span class="right-nav-text">Actividades</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="guias_dr" class="collapse collapse-level-1 two-col-list">

                @if ( !isset( $menu[15] )  )
					<li>
						<a href="{{ route('Actividades.View_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Consulta de Actividades</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[16] )  )
					<li>
						<a href="{{ route('Actividades.Modif_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Modificacion de Actividades</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
				@endif

                @if ( !isset( $menu[17] )  )
					<li>
						<a href="{{ route('Actividades.View_Remedy.index') }}">
							<div class="pull-left"><span class="right-nav-text">Revision de parametros Remedy</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[18] )  )
					<li>
						<a href="{{ route('Actividades.Calendar_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Calendariazación passwords</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[19] )  )
					<li>
						<a href="{{ route('Actividades.Program_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Reprogramación de Actividades</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                @if ( !isset( $menu[20] )  )
					<li>
						<a href="{{ route('Actividades.Cancel_activ.index') }}">
							<div class="pull-left"><span class="right-nav-text">Cancelación de Actividades</span></div>
							<div class="clearfix"></div>
						</a>
					</li>
                @endif

                <!--Sisfen - Agregar revision de Historial -->

                @if ( !isset( $menu[53] ) )
				<li>
					<a href="{{ route('consulta.index' , array('isMob'=>'false') ) }}">
						<div class="pull-left"><span class="right-nav-text">Consulta con busqueda</span></div>
						<div class="clearfix"></div></a>
				</li>
                @endif

			</ul>
	    </li>
		@endif

		<li><hr class="light-grey-hr mb-10"/></li>

        <!-- Manejo de Tickets -->
        @if ( !isset( $menu[21] )  )
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#Tickets"><div class="pull-left"><i class="fa fa-sliders  mr-20"></i><span class="right-nav-text">Tickets</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="Tickets" class="collapse collapse-level-1 two-col-list">

               @if ( !isset( $menu[22] ) )
				<li>
					<a href="{{ route('Tickets.View_ticket.index' , array('isMob'=>'false') ) }}">
						<div class="pull-left"><span class="right-nav-text">Consulta de Tickets</span></div>
						<div class="clearfix"></div></a>
				</li>
                @endif

                <!--Sisfen - Agregar revision de Historial -->


            </ul>





		</li>
		@endif

<!-- aqui -->




        <!-- Manejo de Usuarios Internos del sistema -->
        <li><hr class="light-grey-hr mb-10"/></li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#operaciones_dr"><div class="pull-left"><i class="fa fa-cogs mr-20"></i><span class="right-nav-text">Autogestion</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="operaciones_dr" class="collapse collapse-level-1 two-col-list">

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



                <!-- @if ( !isset( $menu[51] ) ) -->
				<!-- 	<li>-->
				<!-- 		<a href="{{ route('portinbatch.index') }}">-->
				<!-- 			<div class="pull-left"><span class="right-nav-text">Prueba Pantalla con Busqueda</span></div>-->
				<!-- 			<div class="clearfix"></div>-->
				<!-- 		</a>-->
				<!-- 	</li>-->
				<!-- @endif-->




                <!-- Sisfen - aqui  -->
				<!--@if ( !isset( $menu[50] ) )-->
				<!--<li>-->
				<!--	<a href="{{ route('batch.index') }}">-->
				<!--		<div class="pull-left"></i><span class="right-nav-text">Pantalla con seleccion</span></div>-->
				<!--		<div class="clearfix"></div>-->
				<!--	</a>-->
				<!--</li>-->
				<!--@endif-->

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
