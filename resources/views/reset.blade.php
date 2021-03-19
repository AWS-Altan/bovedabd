<!DOCTYPE html>
<html lang="es-ES" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Boveda Manager SGI - Cambio de Contraseña</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->

    <div class="wrapper pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <a href="#">
                    <img class="brand-img mr-10" src="../img/logo_small.png" alt="brand" />
                </a>
            </div>

        </header>

        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0 auth-page">
            <div class="container-fluid">
                <!-- Row -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Boveda <br> Manager SGI</h3>
                                        <h6 class="text-center txt-dark mb-10">Por seguridad es necesario un cambio de contraseña</h6>

                                    </div>
                                    <div class="form-wrap">
                                         <form id="form_login" method="POST" action="{{ route('support.reset') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="exampleInputEmail_2">Contraseña</label>
                                                <input id="password" placeholder="***********" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocu>

                                               @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert" id="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Confirma tu Contraseña</label>
                                                <!--a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="">¿Olvid&oacute; su contraseña?</a-->
                                                <div class="clearfix"></div>
                                                <input id="c_password" placeholder="***********" type="password" class="form-control{{ $errors->has('c_password') ? ' is-invalid' : '' }}" name="c_password" required>

                                                @if ($errors->has('c_password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('c_password') }}</strong>
                                                    </span>
                                                @else
                                                    <span class="invalid-feedback" role="alert" id="alert"></span>
                                                @endif
                                            </div>
                                            <div class="form-group mb-10">

                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary pr-10 pull-left">
                                                    <input id="checkbox_2" type="checkbox">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button id="consulta" class="btn btn-primary btn-xs">Cambiar Contraseña</button>
                                                <button id="submit" type="submit" class="btn btn-primary btn-xs" disabled>Iniciar Sesi&oacute;n</button>
                                                <!---a type="" class="btn btn-primary  btn-rounded" href="02_altan_crear_usuario.html">Iniciar sesi&oacute;n</a-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="/dist/js/jquery.blockUI.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <script >
        $(window).on('load', function() {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            var Login = function () {

                var initializePlugins = function initializePlugins() {
                    $('#submit').hide();

                    $( "#consulta" ).click(function() {
                        pass = $('#password').val()
                        pasc = $('#c_password').val()

                        if ( pass.length < 6 ) {
                            $('#alert').empty();
                            $('#password, #c_password').val('');
                            $("#alert").css('color', '#f73414');
                            $('#alert').append('La contraseña debe ser mayor a 5 caracteres');
                            $('#password').focus();
                            return false;
                        }

                        if ( pass !== pasc ) {
                            $('#alert').empty();
                            $('#password, #c_password').val('');
                            $("#alert").css('color', '#f73414');
                            $('#alert').append('Las contraseñas no coinciden');
                            $('#password').focus();
                            return false;
                        }

                        $('#submit').trigger('click');
                        return true;
                    });
                }

                // Public Methods
                return {
                    init: function() {
                        initializePlugins();
                    }
                };

            }

            Login().init();

            @yield('js')
        });
    </script>
</body>

</html>
