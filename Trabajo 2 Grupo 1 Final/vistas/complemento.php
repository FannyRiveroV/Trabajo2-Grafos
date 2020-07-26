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
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded">            
            <?php
            
            $tipo_auto=$_POST['tipo_auto'];
            // ESTO ES SOLO PARA AFD
            class AFD{
              public $estados = array();
              public $est_ini;
              public $est_fin = array();
              public $leng=array();
              public $trans=array();
              
              function verAuto()
              {
                echo "QUINTUPLA <br><br>";
                // imprime el automata 
                  echo "K = {";
                      for($a=0;$a<count($this->estados);$a++){
                          echo $this->estados[$a].",";
                      }
                  echo "} <br>";
                  
                  echo "I = ".$this->est_ini."<br>";
  
                  echo "F = {";
                    for($a=0;$a<count($this->est_fin);$a++){
                      if(isset($this->est_fin[$a])){
                        echo $this->est_fin[$a].",";
                      }
                    }
                  echo "}<br>";
                  
                  echo "σ = {";
                  for($a=0;$a<count($this->leng);$a++)
                  {
                      echo $this->leng[$a].",";
                  }
                  echo "}<br>";
  
                  echo 'δ = {';
                  $aux=0;
                  for($a=0; $a < count($this->estados); $a++){
                    for($b=0; $b <count($this->leng); $b++){
                      echo '(('.$this->estados[$a].', '.$this->leng[$b].'), '.$this->trans[$aux].'), ';
                      $aux++;
                    }
                  }
                  echo "}<br><br>";
              }
            }

            $A = new AFD();
            $B = new AFD();

           
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
              echo "COMPLEMENTOS: <br><br>";
              $A->verAuto();
              $B->verAuto();

            }

            if($tipo_auto=="1afnd")
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
              $A->verAuto();
              

            }

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
                $A->est_fin[$b]=NULL;
                $b++;
              }

              }
            }
            ?>

            <form action="index.php?pagina=simplificar" method="POST">
            <?php 
            
              if($tipo_auto == "2afd")
              {
                $value='" value="';
                echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">
                  <input type="hidden" name="est_ini" value="'.$A->est_ini.'">
                  <input type="hidden" name="est_ini2" value="'.$B->est_ini.'">

                  <input type="hidden" name="cant_est" value="'.count($A->estados).'">
                  <input type="hidden" name="cant_est2" value="'.count($B->estados).'">

                  <input type="hidden" name="cant_fin" value="'.count($A->est_fin).'">
                  <input type="hidden" name="cant_fin2" value="'.count($B->est_fin).'">

                  <input type="hidden" name="cant_leng" value="'.count($A->leng).'">
                  <input type="hidden" name="cant_leng2" value="'.count($B->leng).'">';

                  for($a=0;$a<count($A->estados);$a++)
                  {
                    echo '<input type="hidden" name="est_'.$a.$value.$A->estados[$a].'">';
                  }
                  for($a=0;$a<count($B->estados);$a++)
                  {
                    echo '<input type="hidden" name="est2_'.$a.$value.$B->estados[$a].'">';
                  }
                    
                  for($a=0;$a<count($A->est_fin);$a++)
                  {
                   
                    echo '<input type="hidden" name="estfinal_'.$a.$value.$A->est_fin[$a].'">';

                  }
                  for($a=0;$a<count($B->est_fin);$a++)
                  {
                    
                    echo '<input type="hidden" name="estfinal2_'.$a.$value.$B->est_fin[$a].'">';

                  }

                  for($a=0;$a<count($A->leng);$a++)
                  {
                    echo '<input type="hidden" name="leng_'.$a.$value.$A->leng[$a].'">';
                  }

                  for($a=0;$a<count($B->leng);$a++)
                  {
                    echo '<input type="hidden" name="leng2_'.$a.$value.$B->leng[$a].'">';
                  }

              
                 
                  $aux=0;
                  for($a=0; $a < count($A->estados); $a++){
                    for($b=0; $b <count($A->leng); $b++){
                      echo '<input type="hidden" name="trans_'.$aux.$value.$A->estados[$a].','.$A->leng[$b].','.$A->trans[$aux].'">';
                      $aux++;
                    }
                  }
                  echo '<input type="hidden" name="cant_trans" value="'.$aux.'">';
                  

                  $aux=0;
                  for($a=0; $a < count($B->estados); $a++)
                  {
                    for($b=0; $b <count($B->leng); $b++)
                    {
                      echo '<input type="hidden" name="trans2_'.$aux.$value.$B->estados[$a].','.$B->leng[$b].','.$B->trans[$aux].'">';
                      $aux++;
                    }
                  }
                  echo '<input type="hidden" name="cant_trans2" value="'.$aux.'">';
              }
              if($tipo_auto == "1afnd")
              {
                echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">
                  <input type="hidden" name="est_ini" value="'.$A->est_ini.'">
                  <input type="hidden" name="cant_est" value="'.count($A->estados).'">
                  <input type="hidden" name="cant_fin" value="'.count($A->est_fin).'">
                  <input type="hidden" name="cant_leng" value="'.count($A->leng).'">';

                  for($a=0;$a<count($A->estados);$a++)
                  {
                    echo '<input type="hidden" name="est_'.$a.'" value="'.$A->estados[$a].'">';
                  }
                  
                  for($a=0;$a<count($A->est_fin);$a++)
                  {
                    echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$A->est_fin[$a].'">';

                  }
                  for($a=0;$a<count($A->leng);$a++)
                  {
                    echo '<input type="hidden" name="leng_'.$a.'" value="'.$A->leng[$a].'">';
                  }

                  $aux=0;
                  for($a=0; $a < count($A->estados); $a++){
                    for($b=0; $b <count($A->leng); $b++){
                      echo '<input type="hidden" name="trans_'.$aux.'" value="'.$A->estados[$a].','.$A->leng[$b].','.$A->trans[$aux].'">';
                      $aux++;
                    }
                  }
                  echo '<input type="hidden" name="cant_trans" value="'.$aux.'">';
                  


              } 
              
            ?>

            <input class="btn btn-secondary btn-sm btninput active" type="submit" value="Simplificar Autómatas">
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