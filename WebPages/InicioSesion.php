<!doctype html>
<?php 
include('Connection.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Inicio de Sesion</title>

    <!-- Bootstrap core CSS -->
    <link href="../WebPages/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../WebPages/css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    
    <div class="container">
      <div class="text-center">
        <h1 class="display-1 py-5">CourierTEC</h1>
      </div>

      <form class="form-signin" method="POST" action=" " onSubmit="window.location.reload()">

        <div class="text-center mb-4">
          <h1 class="h3 mb-5 font-weight-normal">Iniciar Sesión</h1>
        </div>

        <div class="form-label-group">
          <input type="email" id="inputEmail"name="Correo"  class="form-control" placeholder="Correo electrónico" required autofocus>
          <label for="inputEmail">Correo Electronico</label>
        </div>

        <div class="form-label-group">
          <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Contraseña" required>
          <label for="inputPassword">Contraseña</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block mt-5" name="InicioSesion" type="submit">Iniciar Sesión</button>

        <div class="text-center mt-5">
          <a href="Registrar.php" class="font-weight-normal">Registrar</a>
          
        </div>

      </form>

    </div>

    <?php 
        if(isset($_POST['InicioSesion'])){
            $Password = $_POST['Password'];
            $Correo = $_POST['Correo'];
            
            
            
            $POSTusuarios = "EXECUTE LOGINUSUARIO '$Correo','$Password'";

            $ejecutar = sqlsrv_query($conn, $POSTusuarios);

            if( $ejecutar === false) {
                die( print_r( sqlsrv_errors(), true) );
            }else{
                $row = sqlsrv_fetch_array( $ejecutar, SQLSRV_FETCH_ASSOC);
            
                if(($row['IdRol'] == 1) || ($row['IdRol'] == 2)){
                    setcookie("Nombre",$row['NombreUsuario'],time()+3600);
                    setcookie("Apellido",$row['ApellidosUsuario'],time()+3600);
                    setcookie("Cedula",$row['CedulaUsuario'],time()+3600);
                    setcookie("IdSucursal",$row['IdSucursal'],time()+3600);
                    setcookie("Correo",$row['CorreoUsuario'],time()+3600);
                    setcookie("Telefono",$row['TelefonoUsuario'],time()+3600);

                    echo "<script>window.location = 'ClienteOrdenes.php'</script>";
                }if($row['IdRol'] == 3 ){
                    setcookie("Nombre",$row['NombreUsuario'],time()+3600);
                    setcookie("Apellido",$row['ApellidosUsuario'],time()+3600);
                    setcookie("Cedula",$row['CedulaUsuario'],time()+3600);
                    setcookie("IdSucursal",$row['IdSucursal'],time()+3600);
                    setcookie("Correo",$row['CorreoUsuario'],time()+3600);
                    setcookie("Telefono",$row['TelefonoUsuario'],time()+3600);
                    setcookie("IdTipoCliente",$row['IdTipoCliente'],time()+3600);
                    setcookie("Provincia",$row['ProvinciaCliente'],time()+3600);
                    setcookie("Cuenta",$row['NumeroCuentaCliente'],time()+3600);
                    
                    echo "<script>window.location = 'ClienteHome.php'</script>";
                }
            }
        }
    ?>

    


  </body>
</html>