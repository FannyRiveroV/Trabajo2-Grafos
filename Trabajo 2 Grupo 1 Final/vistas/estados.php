<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grafos T2</title>
</head>
<body>
    <!-- Page Content -->
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-7"> <br> <br>
          <h3  class="display-4  text-center">Ingreso de Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded">

            <form action="index.php?pagina=transiciones" method="POST">

               <?php
                  //número de estados que tendrá el array
                  $cant_array = $_POST['cantidad_estados_1'];
                  $cant_array2 = $_POST['cantidad_estados_2'];
                  $tipo_auto=$_POST['tipo_auto'];
                    //se imprimen n formularios según $cant_array
                    echo "1° Autómata: ";
                    if($tipo_auto=="2afnd"){
                      echo 'AFND <br>';
                    }
                    else{
                      echo 'AFD<br>';
                    }
                    for($a=0;$a<$cant_array;$a++){

                        echo '<input class="casillainput" type="text" size="25" name="estado'.$a.'" placeholder="Nombre estado '.$a.'" required>
                              <input type="radio" name="inicial" value="'.$a.'" required>Inicial
                              <input type="checkbox" name="final_'.$a.'" value="'.$a.'">Final
                        
                        
                        <br>';
                    }
                    
                    echo '<br>2° Autómata';

                    if($tipo_auto=="2afd"){
                      echo ': AFD <br>';
                    }
                    else{
                      echo ': AFND<br>';
                    }  
                    for($a=0;$a<$cant_array2;$a++){
                        echo '<input class="casillainput" type="text" size="25" name="estado_'.$a.'" placeholder="Nombre estado '.$a.'" required>
                              <input type="radio" name="inicial2" value="'.$a.'" required>Inicial
                              <input type="checkbox" name="final2_'.$a.'" value="'.$a.'">Final
                              <br>';
                    }
                    echo '<br>';
                  ?>
                
                  <?php

              
                    if($tipo_auto == "2afd")
                    {
                      echo'Ingrese el lenguaje con el cual trabajará el autómata:
                      <br>
                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_1" placeholder="1° Autómata" required><br>
                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_2" placeholder="2° Autómata" required>';
                    }
                    
                    if($tipo_auto == "1afnd")
                    {
                      echo'Ingrese el lenguaje con el cual trabajará el autómata:
                      <br>
                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_1" placeholder="1° Autómata" required><br><br>

                      Separe con una coma "," cada caracter, o palabra que leerá el autómata.<br>
                      Si quiere leer un epsilon, pongalo al final Ej: "a,b, ... ,epsilon"

                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_2" placeholder="2° Autómata" required><br>
                      N° de transiciones por lenguaje: <input class="casillainput" type="number" size="5" name="n_trans_afnd" min="0" required pattern="[0-9]{1,2}">
                      
                      <br>';
      
                    }


                    if($tipo_auto == "2afnd")
                    {
                      echo'Ingrese el lenguaje con el cual trabajará el autómata:<br><br>

                      Separe con una coma "," cada caracter, o palabra que leerá el autómata:<br>
                      Si quiere leer un epsilon, pongalo al final Ej: "a,b, ... ,epsilon"<br>
                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_1" placeholder="1° Autómata" required><br>
                      N° Máx de transiciones por c/lenguaje: <input type="number" size="5" name="n_trans_afnd" min="0" required pattern="[0-9]{1,2}"><br><br>
                      
                      Separe con una coma "," cada caracter, o palabra que leerá el autómata:<br>
                      Si quiere leer un epsilon, pongalo al final Ej: "a,b, ... ,epsilon" <br>
                      σ: <input class="casillainput" type="text" size="25" name="lenguaje_2" placeholder="2° Autómata" required><br>
                      N° Máx de transiciones por c/lenguaje: <input type="number" size="5" name="n_trans_afnd2" min="0" required pattern="[0-9]{1,2}"><br>';
                    }                       
                        

                ?><br>



                <input class="btn btn-secondary btn-lg active btninput" type="submit" value="Avanzar">
                <input type="hidden" name='cantida_estados_1' value="<?php echo $cant_array?>">
                <input type="hidden" name='cantida_estados_2' value="<?php echo $cant_array2?>">
                <input type="hidden" name='tipo_auto' value="<?php echo $tipo_auto?>">
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