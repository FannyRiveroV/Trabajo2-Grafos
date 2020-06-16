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
            <?php
            

            $tipo_auto=$_POST['tipo_auto'];
            echo "TIPO AUTO: ".$tipo_auto."<br>";

            // ESTO ES SOLO PARA AFD
            class AFD{
              public $estados = array();
              public $est_ini;
              public $est_fin = array();
              public $leng=array();
              public $trans=array();

            }

            $A = new AFD();
            $B = new AFD();

            function complemento($A)
            {
              $arrayaux=array();
              for($a=0;$a<count($A->estados);$a++){
                $arrayaux[$a]=$A->estados[$a];
              }



              $b=0;
              while( $b < count($A->est_fin))
              {
                for($a=0;$a<count($A->estados);$a++){
                  if($A->est_fin[$b] == $A->estados[$a]){
                    unset($arrayaux[$a]);
                  }
                }
                $b = $b +1;
              }

              $b=0;
              for($a=0;$a<count($A->estados);$a++){
                if(isset($arrayaux[$a])){
                  $A->est_fin[$b]=$arrayaux[$a];
                  $b++;
                }
              else{
                $A->est_fin[$b]="";
                $b++;
              }

              }
            }


            if($tipo_auto=="2afd")
            {
              $cant_est=$_POST['cant_est1'];
              $cant_fin=$_POST['cant_fin'];
              $cant_leng=$_POST['cant_leng1'];
              $cant_tran=$_POST['cant_tran1'];
                
              $A->est_ini=$_POST['estado_inicial'];
              for($a=0;$a<$cant_est;$a++){
                $A->estados[$a] =$_POST['estado1_'.$a];
              }
              for($a=0;$a<$cant_fin;$a++){
                $A ->est_fin[$a]=$_POST['estados_finales_'.$a];
              }
              for($a=0;$a<$cant_leng;$a++){
                $A->leng[$a]=$_POST['lenguaje_'.$a];
              }

              for($a=0;$a<$cant_tran;$a++){
                $A->trans[$a]=$_POST['tran_'.$a];
              }


              $cant_est2=$_POST['cant_est2'];
              $cant_fin2=$_POST['cant_fin2'];
              $cant_leng2=$_POST['cant_leng2'];
              $cant_tran2=$_POST['cant_tran2'];
              $B->est_ini=$_POST['estado_inicial2'];
              for($a=0;$a<$cant_est2;$a++){
                $B->estados[$a] =$_POST['estado2_'.$a];
              }
              for($a=0;$a<$cant_fin2;$a++){
                $B ->est_fin[$a]=$_POST['estados2_finales_'.$a];
              }
              for($a=0;$a<$cant_leng2;$a++){
                $B->leng[$a]=$_POST['lenguaje2_'.$a];
              }
              for($a=0;$a<$cant_tran2;$a++){
                $B->trans[$a]=$_POST['tran2_'.$a];
              }

              complemento($A);
              complemento($B);

              echo "PRIMERA QUINTUPLA <br><br>";
              // imprime el automata 
                echo "K1 = {";
                    for($a=0;$a<count($A->estados);$a++){
                        echo $A->estados[$a].",";
                    }
                echo "}<br>";
                
                echo "I1 = ".$A->est_ini."<br>";

                echo "F1 = {";
                  for($a=0;$a<count($A->est_fin);$a++){
                      echo $A->est_fin[$a].",";
                  }
                echo "}";
                echo "<br>";
                
                echo "σ_1 = {";
                for($a=0;$a<count($A->leng);$a++)
                {
                    echo $A->leng[$a].",";
                }
                echo "}<br>";

                echo 'δ_1: {';
                $aux=0;
                for($a=0; $a < $cant_est; $a++){
                  for($b=0; $b <count($A->leng); $b++){
                    echo '(('.$A->estados[$a].', '.$A->leng[$b].'), '.$A->trans[$aux].'), ';
                    $aux++;
                  }
                }
                echo "}<br><br>";


                echo "SEGUNDA QUINTUPLA <br><br>";
               // imprime el automata 
                echo "K2 = {";
                    for($a=0;$a<count($B->estados);$a++){
                        echo $B->estados[$a].",";
                    }
                echo "}<br>";
                
                echo "I2 = ".$B->est_ini."<br>";

                echo "F2 = {";
                  for($a=0;$a<count($B->est_fin);$a++){
                      echo $B->est_fin[$a].",";
                  }
                echo "}";
                echo "<br>";
                
                echo "σ_2 = {";
                for($a=0;$a<count($B->leng);$a++)
                {
                    echo $B->leng[$a].",";
                }
                echo "}<br>";


                echo 'δ_2: {';
                $aux=0;
                for($a=0; $a < $cant_est2; $a++){
                  for($b=0; $b <count($B->leng); $b++){
                    echo '(('.$B->estados[$a].', '.$B->leng[$b].'), '.$B->trans[$aux].'), ';
                    $aux++;
                  }
                }
                echo "}";

            }

            if ($tipo_auto=="1afnd")
            {
              $cant_est=$_POST['cant_est1'];
              $cant_fin=$_POST['cant_fin'];
              $cant_leng=$_POST['cant_leng1'];
              $cant_tran=$_POST['cant_tran1'];
                
              $A->est_ini=$_POST['estado_inicial'];
              for($a=0;$a<$cant_est;$a++){
                $A->estados[$a] =$_POST['estado1_'.$a];
              }
              for($a=0;$a<$cant_fin;$a++){
                $A ->est_fin[$a]=$_POST['estados_finales_'.$a];
              }
              for($a=0;$a<$cant_leng;$a++){
                $A->leng[$a]=$_POST['lenguaje_'.$a];
              }

              for($a=0;$a<$cant_tran;$a++){
                $A->trans[$a]=$_POST['tran_'.$a];
              }

              complemento($A);

              echo "PRIMERA QUINTUPLA <br><br>";
              // imprime el automata 
                echo "K1 = {";
                    for($a=0;$a<count($A->estados);$a++){
                        echo $A->estados[$a].",";
                    }
                echo "}<br>";
                
                echo "I1 = ".$A->est_ini."<br>";

                echo "F1 = {";
                  for($a=0;$a<count($A->est_fin);$a++){
                      echo $A->est_fin[$a].",";
                  }
                echo "}";
                echo "<br>";
                
                echo "σ_1 = {";
                for($a=0;$a<count($A->leng);$a++)
                {
                    echo $A->leng[$a].",";
                }
                echo "}<br>";

                echo 'δ_1: {';
                $aux=0;
                for($a=0; $a < $cant_est; $a++){
                  for($b=0; $b <count($A->leng); $b++){
                    echo '(('.$A->estados[$a].', '.$A->leng[$b].'), '.$A->trans[$aux].'), ';
                    $aux++;
                  }
                }
                echo "}<br><br>";

            }

            
            


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