<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grafos T1</title>
</head>
<body>
        <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Automatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

            <?php 
                //recuperamos los datos de los automatas
                $cant_array= $_POST['cantida_estados_1'];
                $cant_array2= $_POST['cantida_estados_2'];

                $cant_finales = $_POST['cantf_1'];
                $c = $_POST['c'];

                $pal=$_POST['lenguaj_1'];
                $pal2=$_POST['lenguaj_2'];

                $NT1 = strlen($pal);
                $NT2 = strlen($pal2);

                $K1= array();
                $Final1=array();
                $lenguaje_1=array();
                $estad_inicial=$_POST['inicial_1'];


                $K2= array();
                $Final2=array();              
                $lenguaje_2=array();
                $estad_inicial2=$_POST['inicial_2'];


                //pushean los nombres a los arrays de los automatas
                for($a=0;$a<$cant_array;$a++){
                    array_push($K1,$_POST['estado'.$a]);                 
                }
                
                for($a=0;$a<$cant_array2;$a++){
                    array_push($K2,$_POST['estado_'.$a]);                                   
                }
                
                
                // push para los arrays FINALES
                
                for($a=0;$a<$cant_array;$a++)
                {    
                  if(isset($_POST['fin_'.$a])){
                    array_push($Final1,$K1[$_POST['fin_'.$a]]);
                    
                  }
                  
                }

               
                for($a=0;$a<$cant_array2;$a++)
                {
                  if(isset($_POST['fin2_'.$a])){
                    array_push($Final2,$K2[$_POST['fin2_'.$a]]);
                  }
                }

                for($a=0;$a<$NT1;$a++)
                {
                  array_push($lenguaje_1,$pal[$a]);
                }
                
                for($a=0;$a<$NT2;$a++)
                {
                  array_push($lenguaje_2,$pal2[$a]);
                }

                $estad_inicial=$K1[$estad_inicial];
                $estad_inicial2=$K2[$estad_inicial2];


                //recuperamos las transiciones


                $t1= array();
                $t2= array();

                $n_trans=strlen($estad_inicial);
                $n_trans2=strlen($estad_inicial2);

                $cont=0;
                while( isset($_POST['t_'.$cont]) == 'true'){
                  array_push($t1,$_POST['t_'.$cont]);
                  $cont++;
                }

                $cont2=0;
                while( isset($_POST['t2_'.$cont2]) == 'true'){
                  array_push($t2,$_POST['t2_'.$cont2]);
                  $cont2++;
                }


                echo "PRIMERA QUINTUPLA <br><br>";
                // imprime el automata 1
                echo "K1 = {";
                    for($a=0;$a<count($K1);$a++){
                        echo $K1[$a].",";
                    }
                echo "} <br>";

                echo "I1 = ".$estad_inicial."<br>";
                
                echo "F1 = {";
                  for($a=0;$a<count($Final1);$a++){
                      echo $Final1[$a].",";
                  }
                echo "}<br>";

                echo "σ_1 = {";
                  for($a=0;$a<count($lenguaje_1);$a++){
                      echo $lenguaje_1[$a].",";
                  }
                echo "}<br>";

                echo 'δ_1: {((';
                  $aux=0;
                  for($a=0; $a < $cant_array; $a++){
                    for($b=0; $b <count($lenguaje_1); $b++){
                      echo '('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].'), ';
                      $aux++;
                    }
                  }
                  echo ")}<br><br>";


                echo "SEGUNDA QUINTUPLA <br><br>";
                // imprime el automata 2
                echo "K2 = {";
                    for($a=0;$a<count($K2);$a++){
                        echo $K2[$a].",";
                    }
                echo "}<br>";
                
                echo "I2 = ".$estad_inicial2."<br>";

                echo "F2 = {";
                  for($a=0;$a<count($Final2);$a++){
                      echo $Final2[$a].",";
                  }
                echo "}";
                echo "<br>";
                
                
               

                echo "σ_2 = {";
                  for($a=0;$a<count($lenguaje_2);$a++){
                      echo $lenguaje_2[$a].",";
                  }
                echo "}<br>";



                echo 'δ_2: {((';
                $aux=0;
                for($a=0; $a < $cant_array2; $a++){
                  for($b=0; $b <count($lenguaje_2); $b++){
                    echo '('.$K2[$a].', '.$lenguaje_2[$b].'), '.$t2[$aux].'), ';
                    $aux++;
                  }
                }
                echo ")}";




            ?>
            
            </div>
          </div>
        </div>
        <div class="col-2"></div>

        
      </div>
    </div>

</body>

</html>