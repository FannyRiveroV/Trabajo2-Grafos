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
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">
            
            <form action="index.php?pagina=muestraestados" method="POST">
              <?php
                $cant_array= $_POST['cantida_estados_1'];
                $cant_array2= $_POST['cantida_estados_2'];
                $tipo_auto=$_POST['tipo_auto'];
          
                
                $estado_inicial=$_POST['inicial'];
                $estado_inicial2=$_POST['inicial2'];

                $K1= array();
                $K2= array();

                $F1=array();
                $F2=array();

                //pushean los nombres a los arrays del primer automata
                for($a=0;$a<$cant_array;$a++)
                {
                    array_push($K1,$_POST['estado'.$a]);
                    if(isset($_POST['final_'.$a])){
                      array_push($F1,$_POST['final_'.$a]);
                    }
                
                }
                //pushean los nombres a los arrays del segundo automata
                for($a=0;$a<$cant_array2;$a++){
                  array_push($K2,$_POST['estado_'.$a]);
                  if(isset($_POST['final2_'.$a])){
                    array_push($F2,$_POST['final2_'.$a]);
                  }
                    
                }
                $Kaux=$K1;
                array_unshift($Kaux,"x");
                $Kaux2=$K2;
                array_unshift($Kaux2,"x");


                $pal=$_POST['lenguaje_1'];
                $pal2=$_POST['lenguaje_2'];
                
                if($tipo_auto == "2afd")
                {

                  $Numero_transiciones_1=strlen($pal);
                  $Numero_transiciones_2=strlen($pal2);


                  echo 'Transiciones del 1° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) ///// Ingrese "qX"; X:N° de estado al que se dirige<br><br>';
                  $cont=0;
                  for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <$Numero_transiciones_1; $b++){
                          $nombre='t_'.$cont;
                          echo $K1[$a].'  = q'.$a.'-----> '.$pal[$b].' '.'------> δ: ';
                          opciones($K1,$nombre);
                          $cont++;
                      }
                      
                  }

                  echo 'Transiciones del 2° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) <br><br>';
                  $cont2=0;
                  for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <$Numero_transiciones_2; $b++){
                        $nombre2='t2_'.$cont2;
                        echo $K2[$a].'  = q'.$a.'-----> '.$pal2[$b].' '.'------> δ: ';
                        opciones($K2,$nombre2);
                        $cont2++;
                      }
                      
                  }
            
                }

                if($tipo_auto == "1afnd")
                {
                  $Numero_transiciones_1=strlen($pal);
                  echo 'Transiciones del 1° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) ///// Ingrese "qX"; X:N° de estado al que se dirige<br><br>';
                  $cont=0;
                  for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <$Numero_transiciones_1; $b++){
                        $nombre='t_'.$cont;
                        echo $K1[$a].'  = q'.$a.'-----> '.$pal[$b].' '.'------> δ: ';
                        opciones($K1,$nombre);
                        $cont++;
                      }
                  }


                  $Num_trans=$_POST['n_trans_afnd'];
                  echo '<input type="hidden" name="n_transxd" value="'.$Num_trans.'"';

                  
                  $leng_afnd=explode(",",$pal2);
                  echo '<br>Transiciones del 2° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) <br>
                      Si no existe la trancision, escriba un x o X<br><br>';
                  $cont2=0;
                  for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($leng_afnd); $b++){
                        for($c=0;$c<$Num_trans;$c++){
                          $nombre2='t2_'.$cont2;
                          echo $K2[$a].'  = q'.$a.'-----> '.$leng_afnd[$b].' '.'------> δ: ';
                          opciones($Kaux2,$nombre2);
                          $cont2++;
                        }
                      }
                   
                  }


                }
                
                if($tipo_auto =="2afnd")
                {


                  $leng_afnd=explode(",",$pal);
                  $Num_trans=$_POST['n_trans_afnd'];
                  echo '<input type="hidden" name="n_transxd" value="'.$Num_trans.'"';
                  
                  echo 'Transiciones del 1° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) <br>
                      Si no existe la trancision, escriba un x o X<br><br>';
                  $cont=0;
                  for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($leng_afnd); $b++){
                        for($c=0;$c<$Num_trans;$c++){
                          $nombre='t_'.$cont;
                          echo $K1[$a].'  = q'.$a.'-----> '.$leng_afnd[$b].' '.'------> δ: ';
                          opciones($Kaux,$nombre);
                          $cont++;
                        }
                      }
                   
                  }

                  $leng_afnd2=explode(",",$pal2);
                  $Num_trans2=$_POST['n_trans_afnd2'];
                  echo '<input type="hidden" name="n_transxd2" value="'.$Num_trans2.'"';

                  echo 'Transiciones del 2° Autómata'.'<br>
                      Q-------------> σ ------>δ(Q,σ) <br>
                      Si no existe la trancision, escriba un x o X<br><br>';
                  $cont2=0;
                  for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($leng_afnd2); $b++){
                        for($c=0;$c<$Num_trans2;$c++){
                          $nombre2='t2_'.$cont2;
                          echo $K2[$a].'  = q'.$a.'-----> '.$leng_afnd2[$b].' '.'------> δ: ';
                          opciones($Kaux2,$nombre2);
                          $cont2++;
                        }
                      }
                   
                  }

                }
                

                function opciones($K,$nombre){?>
                  <select type="text" name="<?php echo $nombre?>">
                    <?php
                    foreach($K as $opciones){
                    ?>
                      <option value="<?php echo $opciones?>"><?php echo $opciones?></option>
                     
                    <?php
                    }
                    ?>
                    
                  </select>
                <?php
                  echo "</br>";
                }
                ?>


              


               <?php
                for($a=0;$a<$cant_array;$a++)
                {
                  echo '<input type="hidden" name="estado'.$a.'" value="'.$K1[$a].'">';
                }
                for($a=0;$a<$cant_array2;$a++)
                {
                  echo '<input type="hidden" name="estado_'.$a.'" value="'.$K2[$a].'" >';
                }

                for($a=0;$a<count($F1);$a++)
                {
                  echo '<input type="hidden" name="fin_'.$a.'" value="'.$F1[$a].'" >';
                }

                for($a=0;$a<count($F2);$a++)
                {
                  echo '<input type="hidden" name="fin2_'.$a.'" value="'.$F2[$a].'" >';
                }
               
              ?> 

              
               <input type="hidden" name='cantida_estados_1' value="<?php echo $cant_array?>">
               <input type="hidden" name='cantida_estados_2' value="<?php echo $cant_array2?>">
               <input type="hidden" name='inicial_1' value="<?php echo $estado_inicial?>">
               <input type="hidden" name='inicial_2' value="<?php echo $estado_inicial2?>">
               <input type="hidden" name="tipo_auto" value="<?php echo $tipo_auto?>">
               
               


              <?php
              
                if($tipo_auto=="2afd")
                {
                  echo'<input type="hidden" name="lenguaj_1" value="'.$pal.'"  >  
                       <input type="hidden" name="lenguaj_2" value="'.$pal2.'" >  ';
                }

                if($tipo_auto=="1afnd")
                {
                  echo'<input type="hidden" name="lenguaj_1" value="'.$pal.'" >';

                  echo'<input type="hidden" name="cant_leng" value="'.count($leng_afnd).'" >';
                  for($a=0;$a<count($leng_afnd);$a++)
                  {
                    echo '<input type="hidden" name="text'.$a.'" value="'.$leng_afnd[$a].'" >';
                  }

                }

                if($tipo_auto=="2afnd")
                {
                  echo'<input type="hidden" name="cant_leng" value="'.count($leng_afnd).'" >';
                  echo'<input type="hidden" name="cant_leng2" value="'.count($leng_afnd2).'" >';


                  for($a=0;$a<count($leng_afnd);$a++){
                    echo '<input type="hidden" name="lenguaj_1'.$a.'" value="'.$leng_afnd[$a].'" >';
                  }

                  for($a=0;$a<count($leng_afnd2);$a++)
                  echo '<input type="hidden" name="lenguaj_2'.$a.'" value="'.$leng_afnd2[$a].'" >';
                }

              ?>

              <input type="submit" value="Next">
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