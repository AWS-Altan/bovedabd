<!-- Nombre: Login.blade.pe-7s-phone -->
<!-- Descripcion: este es la segunda pantalla de login   -->
<!-- historial Modificaciones -->
<!-- 	2020/11/11 - menu Generico  -->
<!--  -->
<!DOCTYPE html>
<html lang="es-ES" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Altán Boveda Manager SGI - Iniciar Sesi&oacute;n</title>

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
                                    </div>
                                    <div class="form-wrap">
                                         <form id="form_login" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="exampleInputEmail_2">Usuario</label>
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocu>

                                               @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert" id="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @else
                                                    <span class="invalid-feedback" role="alert" id="alert"></span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Contraseña</label>
                                                <!--a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="">¿Olvid&oacute; su contraseña?</a-->
                                                <div class="clearfix"></div>
                                                <input id="password" placeholder="***********" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group mb-10">
                                                <label id="mvno_name" class="control-label mb-10 text-left">Plataforma a Consultar</label>
                                                <select id="mvno" name="mvno" class="form-control" required>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary pr-10 pull-left">
                                                    <input id="checkbox_2" type="checkbox">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button id="consulta" class="btn btn-primary btn-xs">Iniciar Sesi&oacute;n</button>
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
                    $('#mvno_name').hide();
                    $('#mvno').hide();
                    $('#submit').hide();

                    $( "#consulta" ).click(function() {
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
                            url: "{{ route('support.call.mvo') }}",
                            type: 'GET',
                            data: {
                                'email': $('#email').val(),
                                'password': $('#password').val()
                            }
                        })
                        .done(function(response) {
                            var obj = jQuery.parseJSON(response);
                            //console.log(obj);
                            $('#mvno').empty();
                            if(obj.error){
                                $('#alert').empty();
                                $('#email, #password').val('');
                                $("#alert").css('color', '#f73414');
                                $('#alert').append('Credenciales no válidas');
                                $('#email').focus();
                            }else{
                                var mySelect = $('#mvno');
                                //console.log(obj.mvno.length);

                                $.each(obj.mvno, function(val, text) {
                                    //console.log(text.name);
                                    mySelect.append(
                                        $('<option></option>').val(text.id).html(text.name)
                                    );
                                });

                                //actualización 20201215 - solicitud Clau, retirar obtencion de MVNO
                                /*if(obj.mvno.length == 1){
                                    mySelect.hide();
                                    $('#mvno_name').hide();
                                    $('#submit').prop('disabled', false);
                                    $('#submit').trigger('click');
                                    $("#form_login").submit();
                                }else{
                                    mySelect.show();
                                    $('#mvno_name').show();
                                    $( "#consulta" ).hide();
                                     $('#submit').show();
                                }*/

                                mySelect.hide();
                                $('#mvno_name').hide();
                                $('#submit').prop('disabled', false);
                                $('#submit').trigger('click');
                                $("#form_login").submit();
                                //termina actualización 20201215

                                $('#submit').prop('disabled', false);
                            }
                        })
                        .always(function() {
                            setTimeout(function(){
                              $.unblockUI();
                            }, 2500);

                        });
                        return false;
                    });

                    $("#password").blur(function (e) {

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
