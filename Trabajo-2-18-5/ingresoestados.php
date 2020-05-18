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
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

            <form action="transiciones.php" method="POST">

                <?php

                  //número de estados que tendrá el array
                  $cant_array = $_POST['cantidad_estados_1'];
                  $cant_array2 = $_POST['cantidad_estados_2'];
                  echo "Cantidad de estados del 1° Autómata: ".$cant_array."<br>
                        Cantidad de estados del 2° Autómata: ".$cant_array2."<br><br>";
               
                    //se imprimen n formularios según $cant_array
                    echo "1° Autómata<br>";
                    for($a=0;$a<$cant_array;$a++){

                        echo '<input type="text" size="25" name="estado'.$a.'" placeholder="Nombre estado '.$a.'" required>
                              <input type="radio" name="inicial" value="'.$a.'" required>Inicial
                              <input type="checkbox" name="final_'.$a.'" value="'.$a.'">Final
                        
                        
                        <br>';
                    }
                    echo '<br>                         
                    2° Autómata<br>';
                    for($a=0;$a<$cant_array2;$a++){
                        echo '<input type="text" size="25" name="estado_'.$a.'" placeholder="Nombre estado '.$a.'" required>
                              <input type="radio" name="inicial2" value="'.$a.'" required>Inicial
                              <input type="checkbox" name="final2_'.$a.'" value="'.$a.'">FinaL
                              <br>';
                    }
                    echo '<br>';
                ?>
              
                <?php

                  echo 'Ingrese el lenguaje con el cual trabajará el autómata:
                        <br>
                        σ: <input type="text" size="25" name="lenguaje_1" placeholder="1° Autómata" required><br>
                        σ: <input type="text" size="25" name="lenguaje_2" placeholder="2° Autómata" required>
                        <br>';

                ?>



                <input type="submit" value="Next">
                <input type="hidden" name='cantida_estados_1' value="<?php echo $cant_array?>">
                <input type="hidden" name='cantida_estados_2' value="<?php echo $cant_array2?>">





            </form>
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