<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grafos T1</title>
</head>
<body>
    <!-- Page Content -->
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

            <form action="index.php?pagina=transiciones" method="POST">

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