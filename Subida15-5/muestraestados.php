<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Diego Velázquez">
  <meta name="description" content="Tablero con Bootstrap 4 - Webook">

  <title>Grafos T1</title>

  <!-- Bootstrap Css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Hoja de estilos -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">

  <!-- Ionic icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>





<body>

  <div class="d-flex" id="content-wrapper">


    <!-- Sidebar -->
    <div id="sidebar-container" class="bg-light border-right">

      <div class="logo">
        <h2 class="font-weight-bold mb-0" style="text-align: center;">Grafos</h2>
      </div>

      <div class="menu list-group-flush">

        <a href="index.html" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons"> account_circle </i> Nosotros </a>

        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">add_circle</i>  Ingresar Automatas </a>


        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">adjust</i>  AFD Equivalente </a>


        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">blur_circular</i>  Union Automatas </a>


        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">border_style</i> Simplificación </a>


      </div>
    </div>
    <!-- Fin sidebar -->





    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Automatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

            <?php 
                //recuperamos la cantidad de estados
                $cant_array= $_POST['cantida_estados_1'];
                $cant_array2= $_POST['cantida_estados_2'];

                $estado_inicial=$_POST['inicial'];
                $estado_inicial2=$_POST['inicial2'];

                $K1= array();
                $K2= array();
                $F1=array();
                $F2=array();

                //pushean los nombres a los arrays del primer automata
                for($a=0;$a<$cant_array;$a++){
                    array_push($K1,$_POST['estado'.$a]);
                }
                //pushean los nombres a los arrays del segundo automata
                for($a=0;$a<$cant_array2;$a++){
                    array_push($K2,$_POST['estado_'.$a]);
                }


                for($a=0;$a<$cant_array;$a++){
                  array_push($F1,$_POST['final'.$a]);
                }

                for($a=0;$a<$cant_array2;$a++){
                  array_push($F2,$_POST['final_'.$a]);
                }



                // imprime el automata 1
                echo "K1 = {";
                    for($a=0;$a<$cant_array;$a++){
                        echo $K1[$a].",";
                    }
                echo "} <br>";

                echo "I1 = {".$estado_inicial."}";
                
                echo "F1 = {";
                  for($a=0;$a<$cant_array2;$a++){
                      echo $F1[$a].",";
                  }
                echo "}<br>";



                // imprime el automata 2
                echo "K2 = {";
                    for($a=0;$a<$cant_array2;$a++){
                        echo $K2[$a].",";
                    }
                echo "}<br>";
                
                echo "I2 = {".$estado_inicial2."}";

                echo "F2 = {";
                  for($a=0;$a<$cant_array2;$a++){
                      echo $F2[$a].",";
                  }
                echo "}";
                echo "<br>";





            ?>
            
            </div>
          </div>
        </div>
        <div class="col-2"></div>

        
      </div>
    </div>

  <!-- Bootstrap y JQuery -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>