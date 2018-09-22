<!doctype html>
<?php 
    include('ConnectionSucursal.php');
    //include('ConnectionPrueba.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Empleado</title>

    <!-- Bootstrap core CSS -->
    <link href="../WebPages/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../Webpages/css/dashboard.css" rel="stylesheet">

    <!-- date picker -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  </head>

  <body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Nombre de Empleado</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../WebPages/InicioSesion.php">Cerrar sesión</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
          <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="../WebPages/EmpleadoHome.php">
                      <span data-feather="home"></span>
                      Principal
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../WebPages/EmpleadoRetirarPaquete.php">
                      <span data-feather="shopping-bag"></span>
                      Retirar Paquete
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="../WebPages/EmpleadoDineroRecaudado.php">
                      <span data-feather="dollar-sign"></span>
                      Dinero Recaudado
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../WebPages/EmpleadoPaquetesMes.php">
                      <span data-feather="calendar"></span>
                      Cantidad Paquetes por Periodo (Clientes)
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../WebPages/EmpleadoMontoPromedio.php">
                      <span data-feather="trending-up"></span>
                      Monto Promedio Paquetes por Periodo (Clientes)
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link " href="../WebPages/EmpleadoMontoSucursal.php">
                      <span data-feather="dollar-sign"></span>
                      Monto por Sucursal
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="../WebPages/EmpleadoMontoSucursalPaquete.php">
                      <span data-feather="dollar-sign"></span>
                      Monto Sucursal por Paquete
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../WebPages/EmpleadoMejoresClientes.php">
                      <span data-feather="users"></span>
                      Mejores Clientes
                    </a>
                  </li>
                </ul>
          </div>
        </nav>

        <!-- recaudado por paquetes  -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h1">Monto recaudado por sucursal por tipo de paquete</h1>
          </div>

          

          <h4>Seleccionar Tipo de paquete y Sucursal</h4>

          <form>
          <div class="row mb-3">

            <div class="col-md-4 mb-3">
              <label for="tipoPaq">Tipo de Paquete</label>
              <select name="TipoPaquete" class="custom-select d-block w-100" id="tipoPaq" required>
                <option value="">Escoja un Tipo...</option>
                <option>Electronica</option>
                <option>Ropa</option>
                <option>Juguetes</option>
                <option>Hogar</option>
                <option>Comida</option>
                <option>Baterias</option>
                <option>Quimicos</option>
                <option>Herramientas</option>
              </select>
              <div class="invalid-feedback">
                Seleccione un tipo de paquete
              </div>
            </div>

            <div class="col-md-4 offset-4">
              <label  for="sucursal">Sucursal</label>
              <select name="Sucursal" class="custom-select d-block w-100" id="sucursal" required>
                <option>Escoja una sucursal...</option>
                <option>Heredia</option>
                <option>Cartago</option>
                <option>San José</option>
              </select>
              <div class="invalid-feedback">
                Seleccione una sucursal
              </div>
            </div>

          </div>

          <h4>Seleccionar rango de fechas</h4>

          <div class="row mb-3">
            <div class="col-md-4">
              <label  for="datepicker10">Fecha Inicial</label>
              <input name="FI"  id="datepicker10" width="100%" required/>
              <script>
                  $('#datepicker10').datepicker({
                      uiLibrary: 'bootstrap4'
                  });
              </script>
              <div class="invalid-feedback principal">
                Debe especificar una fecha
              </div>
            </div>

            <div class="col-md-4 offset-4">
              <label  for="datepicker11">Fecha Final</label>
              <input name="FF" id="datepicker11" width="100%" required/>

              <script>
                  $('#datepicker11').datepicker({
                      uiLibrary: 'bootstrap4'
                  });
              </script>
              <div class="invalid-feedback principal">
                Debe especificar una fecha
              </div>
            </div>
          </div>

          <button name="Consulta" mehtod="GET" class="btn btn-primary btn-lg btn-block principal mb-3">Consultar</button>

          </form>
          <?php
            if(isset($_GET['Consulta'])){
                $FI = strtotime( $_GET['FI']);
                $FF = strtotime($_GET['FF']);
                
                $FInicial = date('Y-m-d',$FI);
                $FFinal = date('Y-m-d',$FF);

                if($_GET['Sucursal'] == "Heredia"){
                    $Sucursal = 1;
                }else if($_GET['Sucursal'] == "Cartago"){
                    $Sucursal = 2;
                }else if($_GET['Sucursal'] == "San Jose"){
                    $Sucursal = 3;
                }

                if($_GET['TipoPaquete'] == "Electronica"){
                    $IdTipoPaquete = 1;
                }else if($_GET['TipoPaquete'] == "Ropa"){
                    $IdTipoPaquete = 2;
                }else if($_GET['TipoPaquete'] == "Juguetes"){
                    $IdTipoPaquete = 3;
                }else if($_GET['TipoPaquete'] == "Hogar"){
                    $IdTipoPaquete = 4;
                }else if($_GET['TipoPaquete'] == "Comida"){
                    $IdTipoPaquete = 5;
                }else if($_GET['TipoPaquete'] == "Baterias"){
                    $IdTipoPaquete = 6;
                }else if($_GET['TipoPaquete'] == "Quimicos"){
                    $IdTipoPaquete = 7;
                }else if($_GET['TipoPaquete'] == "Herramientas"){
                    $IdTipoPaquete = 8;
                }


                $GetMontoSucursalPaquete = "EXECUTE SP_MONTO_SUCURSAL_TIPOPAQUETE_PERIODO $Sucursal,$IdTipoPaquete,'$FInicial','$FFinal'";

                $ejecutar = sqlsrv_query($conn,$GetMontoSucursalPaquete);

                if($ejecutar == false){
                    die( print_r( sqlsrv_errors(), true) );
                }else{
                    $row = sqlsrv_fetch_array( $ejecutar, SQLSRV_FETCH_ASSOC);
                    
                    $Monto = number_format($row['Monto'],2,".",".");

                

            
          ?>
          <div class="card mb-5">
            <div class="card-header bg-primary text-white h4">
              Monto recaudado
            </div>
            <div class="card-body">
              <h5 class="card-title">Se recaudó</h5>
              <p><?php echo "₡ $Monto" ?></p>
            </div>
          </div>
          <?php
                }
              }
          ?>
        </main>
        <!-- fin de reacudados por paquetes  -->

      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script>window.jQuery || document.write('<script src="../Webpages/scripts/jquery-slim.min.js"><\/script>')</script>
    <script src="../WebPages/scripts/popper.min.js"></script>
    <script src="../Webpages/scripts/bootstrap.min.js"></script>

    <!-- scripts para forms -->
    <script src="../Webpages/scripts/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <script>
      $(document).ready(function(){

        $("#buscar-paqs").click(function(){
          $("#lista-paq-cli").attr("hidden", false);
        });

        $("#paq-desc-btn").click(function(){
          $("#inf-paq").attr("hidden", false);
        });

      });
    </script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>
