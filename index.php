
<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Comite Olimpico Ecuatoriano </title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">   
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="dashboard/css/sb-admin-2.css">
    </head>
    
    <body class="bg-gradient-primary">
    
      <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido al Comite Olimpico Ecuatoriano!</h1>
                                            </div>
                                                <form class="user" id="formLogin" action="" method="post">
                                                    <!--h1 class="login-form-title">COMITE OLIMPICO ECUATORIANO</h1-->
                                                    <div class="form-group" data-validate = "Usuario incorrecto">
                                                        <input type="text" id="usuario" name="usuario" 
                                                         class="form-control form-control-user"  placeholder="Ingresa tu usuario">
                                                    </div>
                                                    <div class="form-group" data-validate="Password incorrecto">
                                                        <input type="password" id="password" name="password" 
                                                        class="form-control form-control-user" placeholder="Ingresa tu contraseña">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox small">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                                            <label class="custom-control-label" for="customCheck">Recuerdame</label>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Ingresar</button>
                                                            </div>
                                                    </form>
                                                    <hr>
                                                    <div class="text-center">
                                                        <a class="small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                                                            </div>
                                                    <div class="text-center">
                                                        <a class="small" href="register.html">¡Crea una cuenta!</a>
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div> 
                </div>
            </div>             
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    
     <script src="codigo.js"></script>    
    </body>
</html>