
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
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded">
            <?php 
                //recuperamos los datos de los automatas

                $cant_array= $_POST['cantida_estados_1'];
                $cant_array2= $_POST['cantida_estados_2'];
                $tipo_auto=$_POST['tipo_auto'];
                                
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

                $estad_inicial=$K1[$estad_inicial];
                $estad_inicial2=$K2[$estad_inicial2];
                


                if($tipo_auto=="2afd")
                {
                  $pal=$_POST['lenguaj_1'];
                  $pal2=$_POST['lenguaj_2'];

                  $NT1 = strlen($pal);
                  $NT2 = strlen($pal2);

                  for($a=0;$a<$NT1;$a++)
                  {
                    $lenguaje_1[$a]= $pal[$a];
                  }

                  for($a=0;$a<$NT2;$a++)
                  {
                    $lenguaje_2[$a]= $pal2[$a];
                  }
                }
               
                if($tipo_auto=="1afnd")
                {
                  $pal=$_POST['lenguaj_1'];
                  for($a=0;$a<strlen($pal);$a++)
                  {
                  $lenguaje_1[$a]=$pal[$a];
                  }

                  $cant_leng2=$_POST['cant_leng'];
                  for($a=0;$a<$cant_leng2;$a++)
                  {
                    $lenguaje_2[$a]=$_POST['text'.$a];
              
                  }

                }

                if($tipo_auto=="2afnd")
                {
                  $cant_leng=$_POST['cant_leng'];
                  for($a=0;$a<$cant_leng;$a++)
                  {
                    $lenguaje_1[$a]=$_POST['lenguaj_1'.$a];
              
                  }

                  $cant_leng2=$_POST['cant_leng2'];
                  for($a=0;$a<$cant_leng2;$a++)
                  {
                    $lenguaje_2[$a]=$_POST['lenguaj_2'.$a];
              
                  }
                }

                //recuperamos las transiciones

                $t1= array();
                $t2= array();
                $cont=0;
                $cont2=0;
               
                if($tipo_auto=="2afd")
                {
                  while( isset($_POST['t_'.$cont]) == 'true')
                  {
                      array_push($t1,$_POST['t_'.$cont]);
                      $cont++;
                  }
                  while( isset($_POST['t2_'.$cont2]) == 'true'){
                    array_push($t2,$_POST['t2_'.$cont2]);
                    $cont2++;
                  }


                    echo "PRIMERA QUINTUPLA <br><br>";
                  // imprime el automata 1
                  echo "K1 = {";
                      for($a=0;$a<count($K1);$a++){
                        if(count($K1)==1){
                          echo $K1[$a];
                        }
                        else{
                          if($a==count($K1)-1){
                            echo $K1[$a];
                          }else{
                            echo $K1[$a].",";
                          }
                          
                        }  
                      }
                  echo "} <br>";

                  echo "I1 = ".$estad_inicial."<br>";
                  
                  echo "F1 = {";
                    for($a=0;$a<count($Final1);$a++){
                      if(count($Final1)==1){
                        echo $Final1[$a];
                      }
                      else{
                        echo ",".$Final1[$a];
                      } 
                    }
                    echo "}<br>";

                  echo "σ_1 = {";
                    for($a=0;$a<count($lenguaje_1);$a++){
                      if(count($lenguaje_1)==1){
                        echo $lenguaje_1[$a];
                      }
                      else{
                        if($a==count($lenguaje_1)-1){
                          echo $lenguaje_1[$a];
                        }else{
                          echo $lenguaje_1[$a].",";
                        }
                      }  
                    }
                  echo "}<br>";

                  echo 'δ_1 = { ';
                    $aux=0;
                    for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($lenguaje_1); $b++){
                        if(($a==count($lenguaje_1)-1) and ($b==count($lenguaje_1)-1)){
                          echo '(('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].') ';
                        }else{
                          echo '(('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].'), ';
                        }
                        $aux++;
                      }
                    }
                    echo "}<br><br>";

                    echo "SEGUNDA QUINTUPLA <br><br>";
                  // imprime el automata 2
                  echo "K2 = {";
                    for($a=0;$a<count($K2);$a++){
                      if(count($K2)==1){
                        echo $K2[$a];
                      }
                      else{
                        if($a==count($K2)-1){
                          echo $K2[$a];
                        }else{
                          echo $K2[$a].",";
                        }
                        
                      }  
                    }  
                  echo "} <br>";

                  echo "I2 = ".$estad_inicial2."<br>";
                  
                  echo "F2 = {";
                    for($a=0;$a<count($Final2);$a++){
                      if(count($Final2)==1){
                        echo $Final2[$a];
                      }
                      else{
                        echo ",".$Final2[$a];
                      } 
                    }
                  echo "}<br>";

                  echo "σ_2 = {";
                    for($a=0;$a<count($lenguaje_2);$a++){
                      if(count($lenguaje_2)==1){
                        echo $lenguaje_2[$a];
                      }
                      else{
                        if($a==count($lenguaje_2)-1){
                          echo $lenguaje_2[$a];
                        }else{
                          echo $lenguaje_2[$a].",";
                        }
                      }  
                    }
                  echo "}<br>";

                  echo 'δ_2 = { ';
                    $aux=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++){
                        if(($a==count($lenguaje_2)-1) and ($b==count($lenguaje_2)-1)){
                          echo '(('.$K2[$a].', '.$lenguaje_2[$b].'), '.$t2[$aux].') ';
                        }else{
                          echo '(('.$K2[$a].', '.$lenguaje_2[$b].'), '.$t2[$aux].'), ';
                        }
                        $aux++;
                      }
                    }
                    echo "}<br><br>";

                }
            
                if($tipo_auto=="1afnd")
                {
                  while( isset($_POST['t_'.$cont]) == 'true')
                  {
                      array_push($t1,$_POST['t_'.$cont]);
                      $cont++;
                  }
                
                  while( isset($_POST['t2_'.$cont2]) == 'true'){
                 
                      $t2[$cont2]=$_POST['t2_'.$cont2];
                      
                    //
                  
                    $cont2++;
                  }
                  echo "PRIMERA QUINTUPLA: AFD <br><br>";
                  // imprime el automata 1
                  echo "K1 = {";
                    for($a=0;$a<count($K1);$a++){
                      if(count($K1)==1){
                        echo $K1[$a];
                      }
                      else{
                        if($a==count($K1)-1){
                          echo $K1[$a];
                        }else{
                          echo $K1[$a].",";
                        }
                        
                      }  
                    }
                  echo "} <br>";

                  echo "I1 = ".$estad_inicial."<br>";
                  
                  echo "F1 = {";
                    for($a=0;$a<count($Final1);$a++){
                      if(count($Final1)==1){
                        echo $Final1[$a];
                      }
                      else{
                        echo ",".$Final1[$a];
                      } 
                    }
                    echo "}<br>";

                    echo "σ_1 = {";
                      for($a=0;$a<count($lenguaje_1);$a++){
                        if(count($lenguaje_1)==1){
                          echo $lenguaje_1[$a];
                        }
                        else{
                          if($a==count($lenguaje_1)-1){
                            echo $lenguaje_1[$a];
                          }else{
                            echo $lenguaje_1[$a].",";
                          }
                        }  
                      }
                    echo "}<br>";

                    echo 'δ_1 = { ';
                      $aux=0;
                      for($a=0; $a < $cant_array; $a++){
                        for($b=0; $b <count($lenguaje_1); $b++){
                          if(($a==count($lenguaje_1)-1) and ($b==count($lenguaje_1)-1)){
                            echo '(('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].') ';
                          }else{
                            echo '(('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].'), ';
                          }
                          $aux++;
                        }
                      }
                      echo "}<br><br>";



                  $Num_trans=$_POST['n_transxd'];
                  echo'SEGUNDA QUINTUPLA: AFND<br>';
                  echo "K1 = {";
                  for($a=0;$a<count($K2);$a++){
                    if(count($K2)==1){
                      echo $K2[$a];
                    }
                    else{
                      if($a==count($K2)-1){
                        echo $K2[$a];
                      }else{
                        echo $K2[$a].",";
                      } 
                    }  
                  }
                  echo "} <br>";

                  echo "I2 = ".$estad_inicial2."<br>";
                  
                  echo "F2 = {";
                  for($a=0;$a<count($Final2);$a++){
                    if(count($Final2)==1){
                      echo $Final2[$a];
                    }
                    else{
                      echo ",".$Final2[$a];
                    } 
                  }
                  echo "}<br>";

                  echo "σ_2 = {";
                  for($a=0;$a<count($lenguaje_2);$a++){
                    if(count($lenguaje_2)==1){
                      echo $lenguaje_2[$a];
                    }
                    else{
                      if($a==count($lenguaje_2)-1){
                        echo $lenguaje_2[$a];
                      }else{
                        echo $lenguaje_2[$a].",";
                      }
                    }  
                  }
                  echo "}<br>";
                  
                  //Arreglar
                  echo 'δ_2 = {';
                  $cont2=0;
                  for($a=0; $a < $cant_array2; $a++){
                    for($b=0; $b <count($lenguaje_2); $b++)
                    {
                      for($c=0;$c<$Num_trans;$c++){
                        if($t2[$cont2]!='x'){
                        echo '(('.$K2[$a].','.$lenguaje_2[$b].'), '.$t2[$cont2]."), ";
                        
                        }
                        $cont2++;
                      }
                    }
                   
                  }
                  echo'}';


                }

                if($tipo_auto=="2afnd")
                {               
                  while( isset($_POST['t_'.$cont]) == 'true'){
                 
                      $t1[$cont]=$_POST['t_'.$cont];
                    //
                    $cont++;
                  }
             
                  while( isset($_POST['t2_'.$cont2]) == 'true'){
                      $t2[$cont2]=$_POST['t2_'.$cont2];
                      
                    //
                  
                    $cont2++;
                  }


                  $Num_trans=$_POST['n_transxd'];
                  echo'PRIMERA QUINTUPLA: AFND<br>';
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
                  echo 'δ_1 = {';

                  $cont=0;
                  for($a=0; $a < $cant_array; $a++){
                    for($b=0; $b <count($lenguaje_1); $b++)
                    {
                      for($c=0;$c<$Num_trans;$c++){
                        if($t1[$cont]!='x'){
                        echo '(('.$K1[$a].','.$lenguaje_1[$b].'), '.$t1[$cont]."), ";
                        
                        }
                        $cont++;
                      }
                    }
                   
                  }
                  echo'}<br><br>';

                  $Num_trans2=$_POST['n_transxd2'];
                  echo'SEGUNDA QUINTUPLA: AFND<br>';
                  echo "K2 = {";
                    for($a=0;$a<count($K2);$a++){
                        echo $K2[$a].",";
                    }
                  echo "} <br>";

                  echo "I2 = ".$estad_inicial2."<br>";
                  
                  echo "F2 = {";
                    for($a=0;$a<count($Final2);$a++){
                        echo $Final2[$a].",";
                    }
                  echo "}<br>";

                  echo "σ_2 = {";
                    for($a=0;$a<count($lenguaje_2);$a++){
                        echo $lenguaje_2[$a].",";
                    }
                  echo "}<br>";
                  echo 'δ_2 = {';

                  $cont2=0;
                  for($a=0; $a < $cant_array2; $a++){
                    for($b=0; $b <count($lenguaje_2); $b++)
                    {
                      for($c=0;$c<$Num_trans2;$c++){
                        if($t2[$cont2]!='x'){
                        echo '(('.$K2[$a].','.$lenguaje_2[$b].'), '.$t2[$cont2]."), ";
                        
                        }
                        $cont2++;
                      }
                    }
                  }
                  echo'}';

                }

                
            ?>
            
              <form action="index.php?pagina=complemento" method="POST">
                    <?php

                      echo '<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">';

                      if($tipo_auto=="2afd")
                      {
                        echo '<input type="hidden" name="cant_est1" value="'.$cant_array.'">
                              <input type="hidden" name="cant_est2" value="'.$cant_array2.'">

                              <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                              <input type="hidden" name="cant_fin2" value="'.count($Final2).'">

                              <input type="hidden" name="cant_leng1" value="'.count($lenguaje_1).'">
                              <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">

                              <input type="hidden" name="cant_tran1" value="'.count($t1).'">
                              <input type="hidden" name="cant_tran2" value="'.count($t2).'">
                              
                        ';



                        for($a=0;$a<count($K1);$a++){
                          echo '<input type="hidden" name="estado1_'.$a.'" value="'.$K1[$a].'">
                          ';
                        }

                        echo '<input type="hidden" name="estado_inicial" value="'.$estad_inicial.'">';

                        for($a=0;$a<count($Final1);$a++){
                          echo '<input type="hidden" name="estados_finales_'.$a.'" value="'.$Final1[$a].'">
                          ';
                        }
                        
                        for($a=0;$a<count($lenguaje_1);$a++){
                          echo '<input type="hidden" name="lenguaje_'.$a.'" value="'.$lenguaje_1[$a].'">
                          ';
                        }
                        
                        for($a=0;$a<count($t1);$a++){
                          echo '<input type="hidden" name="tran_'.$a.'" value="'.$t1[$a].'">
                          ';
                        }

                        //////////////////////////////
                        //2do automata uwu

                        for($a=0;$a<count($K2);$a++){
                          echo '<input type="hidden" name="estado2_'.$a.'" value="'.$K2[$a].'">
                          ';
                        }

                        echo '<input type="hidden" name="estado_inicial2" value="'.$estad_inicial2.'">';

                        for($a=0;$a<count($Final2);$a++){
                          echo '<input type="hidden" name="estados2_finales_'.$a.'" value="'.$Final2[$a].'">
                          ';
                        }
                        
                        for($a=0;$a<count($lenguaje_2);$a++){
                          echo '<input type="hidden" name="lenguaje2_'.$a.'" value="'.$lenguaje_2[$a].'">
                          ';
                        }
                        for($a=0;$a<count($t2);$a++){
                          echo '<input type="hidden" name="tran2_'.$a.'" value="'.$t2[$a].'">
                          ';
                        }
                      }

                      if($tipo_auto=="1afnd")
                      {
                        echo '<input type="hidden" name="cant_est1" value="'.$cant_array.'">               
                              <input type="hidden" name="cant_fin" value="'.count($Final1).'">                 
                              <input type="hidden" name="cant_leng1" value="'.count($lenguaje_1).'">
                              <input type="hidden" name="cant_tran1" value="'.count($t1).'">
                    
          
                        ';



                        for($a=0;$a<count($K1);$a++){
                          echo '<input type="hidden" name="estado1_'.$a.'" value="'.$K1[$a].'">
                          ';
                        }

                        echo '<input type="hidden" name="estado_inicial" value="'.$estad_inicial.'">';

                        for($a=0;$a<count($Final1);$a++){
                          echo '<input type="hidden" name="estados_finales_'.$a.'" value="'.$Final1[$a].'">
                          ';
                        }
                        
                        for($a=0;$a<count($lenguaje_1);$a++){
                          echo '<input type="hidden" name="lenguaje_'.$a.'" value="'.$lenguaje_1[$a].'">
                          ';
                        }
                        
                        for($a=0;$a<count($t1);$a++){
                          echo '<input type="hidden" name="tran_'.$a.'" value="'.$t1[$a].'">
                          ';
                        }
                      }
                      
                    ?>
                    <?php

                      if($tipo_auto=="2afd")
                      {
                        echo '<input class="btn btn-secondary btn-sm btninput active" type="submit" value="Complemento de los automatas">';
                      }

                      if($tipo_auto=="1afnd"){
                        echo '<input class="btn btn-secondary btn-sm btninput active" type="submit" value="Complemento del AFD" >';
                      }
                    ?>
              </form>

              <form action="index.php?pagina=union" method="POST">
                <?php
                  
                  echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">

                      <input type="hidden" name="est_ini" value="'.$estad_inicial.'">
                      <input type="hidden" name="est_ini2" value="'.$estad_inicial2.'">

                      <input type="hidden" name="cant_est" value="'.count($K1).'">
                      <input type="hidden" name="cant_est2" value="'.count($K2).'">

                      <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                      <input type="hidden" name="cant_fin2" value="'.count($Final2).'">

                      <input type="hidden" name="cant_leng" value="'.count($lenguaje_1).'">
                      <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">';

        
      
                  for($a=0;$a<count($K1);$a++)
                  {
                    echo '<input type="hidden" name="est_'.$a.'" value="'.$K1[$a].'">';
                  }
                  for($a=0;$a<count($K2);$a++)
                  {
                    echo '<input type="hidden" name="est2_'.$a.'" value="'.$K2[$a].'">';
                  }
                    
                  for($a=0;$a<count($Final1);$a++)
                  {
                    echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final1[$a].'">';

                  }
                  for($a=0;$a<count($Final2);$a++)
                  {
                    echo '<input type="hidden" name="estfinal2_'.$a.'" value="'.$Final2[$a].'">';

                  }

                  for($a=0;$a<count($lenguaje_1);$a++)
                  {
                    echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_1[$a].'">';
                  }

                  for($a=0;$a<count($lenguaje_2);$a++)
                  {
                    echo '<input type="hidden" name="leng2_'.$a.'" value="'.$lenguaje_2[$a].'">';
                  }

                  if($tipo_auto =="2afd")
                  {
                    $aux=0;
                      for($a=0; $a < $cant_array; $a++){
                        for($b=0; $b <count($lenguaje_1); $b++){
                          
                          echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";

                      $aux=0;
                      for($a=0; $a < $cant_array2; $a++){
                        for($b=0; $b <count($lenguaje_2); $b++){
                          
                          echo'<input type=hidden name="trans2_'.$aux.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                  }

                  if($tipo_auto=="1afnd")
                  {
                
                      $aux=0;
                      for($a=0; $a < $cant_array; $a++){
                        for($b=0; $b <count($lenguaje_1); $b++){
                          
                          echo'<input type=hidden name="trans_'.$aux.'" value="(('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$aux].')">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";
                    
                
                        $cont2=0;
                        $aux=0;
                        for($a=0; $a < $cant_array2; $a++){
                          for($b=0; $b <count($lenguaje_2); $b++)
                          {
                            for($c=0;$c<$Num_trans;$c++){
                              if($t2[$cont2]!='x')
                              {
                                echo'<input type=hidden name="trans2_'.$aux.'" value=" (('.$K2[$a].', '.$lenguaje_2[$b].'), '.$t2[$cont2].') ">';
                                $aux++;
                              }
                              $cont2++;
                            }
                          }
                        
                        }
                        echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                  
                  }

                  if($tipo_auto=="2afnd")
                  {
                    $cont=0;
                        $aux=0;
                        for($a=0; $a < $cant_array; $a++){
                          for($b=0; $b <count($lenguaje_1); $b++)
                          {
                            for($c=0;$c<$Num_trans;$c++){
                              if($t1[$cont]!='x'){

                                echo'<input type=hidden name="trans_'.$aux.'" value=" (('.$K1[$a].', '.$lenguaje_1[$b].'), '.$t1[$cont].') ">';
                                $aux++;
                              }
                              $cont++;
                            }
                          }
                        
                        }
                        echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";

                        
                    $cont=0;
                    $aux=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++)
                      {
                        for($c=0;$c<$Num_trans2;$c++){
                          if($t1[$cont]!='x'){

                            echo'<input type=hidden name="trans2_'.$aux.'" value=" (('.$K2[$a].', '.$lenguaje_2[$b].'), '.$t2[$cont].') ">';
                            $aux++;
                          }
                          $cont++;
                        }
                      }
                    
                    }
                    echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                  }


                ?>
                  <input class="btn btn-secondary btn-sm btninput active" type="submit" value="Union de los automatas">
              </form>
              
              <form action="index.php?pagina=concatenacion" method="POST">
                <?php
                echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">
                  
                  <input type="hidden" name="est_ini" value="'.$estad_inicial.'">
                  <input type="hidden" name="est_ini2" value="'.$estad_inicial2.'">

                  <input type="hidden" name="cant_est" value="'.count($K1).'">
                  <input type="hidden" name="cant_est2" value="'.count($K2).'">

                  <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                  <input type="hidden" name="cant_fin2" value="'.count($Final2).'">

                  <input type="hidden" name="cant_leng" value="'.count($lenguaje_1).'">
                  <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">';

                  for($a=0;$a<count($K1);$a++)
                  {
                    echo '<input type="hidden" name="est_'.$a.'" value="'.$K1[$a].'">';
                  }
                  for($a=0;$a<count($K2);$a++)
                  {
                    echo '<input type="hidden" name="est2_'.$a.'" value="'.$K2[$a].'">';
                  }
                    
                  for($a=0;$a<count($Final1);$a++)
                  {
                    echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final1[$a].'">';

                  }
                  for($a=0;$a<count($Final2);$a++)
                  {
                    echo '<input type="hidden" name="estfinal2_'.$a.'" value="'.$Final2[$a].'">';

                  }

                  for($a=0;$a<count($lenguaje_1);$a++)
                  {
                    echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_1[$a].'">';
                  }

                  for($a=0;$a<count($lenguaje_2);$a++)
                  {
                    echo '<input type="hidden" name="leng2_'.$a.'" value="'.$lenguaje_2[$a].'">';
                  }

                  if($tipo_auto =="2afd")
                  {
                    $aux=0;
                      for($a=0; $a < $cant_array; $a++){
                        for($b=0; $b <count($lenguaje_1); $b++){
                          
                          echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].', '.$lenguaje_1[$b].','.$t1[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";

                      $aux=0;
                      for($a=0; $a < $cant_array2; $a++){
                        for($b=0; $b <count($lenguaje_2); $b++){
                          
                          echo'<input type=hidden name="trans2_'.$aux.'" value="'.$K2[$a].', '.$lenguaje_2[$b].','.$t2[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                  }

                  if($tipo_auto=="1afnd")
                  {
                  
                        $aux=0;
                        for($a=0; $a < $cant_array; $a++){
                          for($b=0; $b <count($lenguaje_1); $b++){
                            
                            echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$aux].'">';
                            $aux++;
                          }
                        }
                        echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";
                      
                  
                          $cont2=0;
                          $aux=0;
                          for($a=0; $a < $cant_array2; $a++){
                            for($b=0; $b <count($lenguaje_2); $b++)
                            {
                              for($c=0;$c<$Num_trans;$c++){
                                if($t2[$cont2]!='x')
                                {
                                  echo'<input type=hidden name="trans2_'.$aux.'" value="'.$K2[$a].', '.$lenguaje_2[$b].','.$t2[$cont2].'">';
                                  $aux++;
                                }
                                $cont2++;
                              }
                            }
                          
                          }
                          echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                  }

                  if($tipo_auto=="2afnd")
                  {
                    $cont=0;
                    $aux=0;
                    for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($lenguaje_1); $b++)
                      {
                        for($c=0;$c<$Num_trans;$c++){
                          if($t1[$cont]!='x'){
                            echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].', '.$lenguaje_1[$b].','.$t1[$cont].'">';
                            $aux++;
                          }
                          $cont++;
                        }
                      }    
                    }
                    echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";

                    $cont=0;
                    $aux=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++)
                      {
                        for($c=0;$c<$Num_trans2;$c++){
                          if($t2[$cont]!='x'){
                            echo'<input type=hidden name="trans2_'.$aux.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$cont].'">';
                            $aux++;
                          }
                          $cont++;
                        }
                      }         
                    }
                    echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";

                  }

                ?>
                <input class="btn btn-secondary btn-sm btninput active" type="submit" value="Concatenacion de los automatas">
                <input type="radio" name="tipo_conc" value="A->B" required>A->B
                <input type="radio" name="tipo_conc" value="B->B" required>B->A
                
              </form>
                  
                <form action="index.php?pagina=transformacion" method="POST">
                  <?php
                  echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">';

                  if($tipo_auto=="1afnd")
                  {

                    echo '<input type="hidden" name="cant_est" value="'.count($K2).'">
                          <input type="hidden" name="est_ini" value="'.$estad_inicial2.'">
                          <input type="hidden" name="cant_fin" value="'.count($Final2).'">
                          <input type="hidden" name="cant_leng" value="'.count($lenguaje_2).'">
                          
                          ';

                    for($a=0;$a<count($K2);$a++)
                    {               
                      echo '<input type="hidden" name="est_'.$a.'" value="'.$K2[$a].'">';
                    }

                    for($a=0;$a<count($Final2);$a++)
                    {               
                      echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final2[$a].'">';
                    }

                    for($a=0;$a<count($lenguaje_2);$a++)
                    {               
                      echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_2[$a].'">';
                    }
                  
                    $cont=0;
                    $aux=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++)
                      {
                        for($c=0;$c<$Num_trans;$c++){
                          if($t2[$cont]!='x')
                          {
                            echo'<input type=hidden name="trans_'.$aux.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$cont].'">';
                            $aux++;
                          }
                          $cont++;
                        }
                      }
                    
                    }
                    echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";
                    echo '<input class="btn btn-secondary btn-sm btninput active" type="submit" value="Transformar el AFND a AFD">';
                  }

                  if($tipo_auto=="2afnd")
                  {

                    echo '<input type="hidden" name="cant_est" value="'.count($K1).'">
                          <input type="hidden" name="est_ini" value="'.$estad_inicial.'">
                          <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                          <input type="hidden" name="cant_leng" value="'.count($lenguaje_1).'">
                          
                          ';

                    for($a=0;$a<count($K1);$a++)
                    {               
                      echo '<input type="hidden" name="est_'.$a.'" value="'.$K1[$a].'">';
                    }

                    for($a=0;$a<count($Final1);$a++)
                    {               
                      echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final1[$a].'">';
                    }

                    for($a=0;$a<count($lenguaje_1);$a++)
                    {               
                      echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_1[$a].'">';
                    }
                  
                    $cont=0;
                    $aux=0;
                    for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($lenguaje_1); $b++)
                      {
                        for($c=0;$c<$Num_trans;$c++){
                          if($t1[$cont]!='x')
                          {
                            echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$cont].'">';
                            $aux++;
                          }
                          $cont++;
                        }
                      }
                    
                    }
                    echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";



                    echo '<input type="hidden" name="cant_est2" value="'.count($K2).'">
                          <input type="hidden" name="est_ini2" value="'.$estad_inicial2.'">
                          <input type="hidden" name="cant_fin2" value="'.count($Final2).'">
                          <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">
                          
                          ';

                    for($a=0;$a<count($K2);$a++)
                    {               
                      echo '<input type="hidden" name="est2_'.$a.'" value="'.$K2[$a].'">';
                    }

                    for($a=0;$a<count($Final2);$a++)
                    {               
                      echo '<input type="hidden" name="estfinal2_'.$a.'" value="'.$Final2[$a].'">';
                    }

                    for($a=0;$a<count($lenguaje_2);$a++)
                    {               
                      echo '<input type="hidden" name="leng2_'.$a.'" value="'.$lenguaje_2[$a].'">';
                    }
                  
                    $cont2=0;
                    $aux2=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++)
                      {
                        for($c=0;$c<$Num_trans2;$c++){
                          if($t2[$cont2]!='x')
                          {
                            echo'<input type=hidden name="trans2_'.$aux2.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$cont2].'">';
                            $aux2++;
                          }
                          $cont2++;
                        }
                      }
                    
                    }
                    echo"<input type='hidden' name='cant_trans2' value='".$aux."'> ";
                    echo '<input class="btn btn-secondary btn-sm btninput active" type="submit" value="Transformar los AFNDs a AFDs">';
                  }

                  ?>

                  
                </form>

              <form action="index.php?pagina=simplificar" method="POST">
                <?php
                
                echo'<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">
                    <input type="hidden" name="est_ini" value="'.$estad_inicial.'">
                    <input type="hidden" name="est_ini2" value="'.$estad_inicial2.'">

                    <input type="hidden" name="cant_est" value="'.count($K1).'">
                    <input type="hidden" name="cant_est2" value="'.count($K2).'">

                    <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                    <input type="hidden" name="cant_fin2" value="'.count($Final2).'">

                    <input type="hidden" name="cant_leng" value="'.count($lenguaje_1).'">
                    <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">';

                  for($a=0;$a<count($K1);$a++)
                  {
                    echo '<input type="hidden" name="est_'.$a.'" value="'.$K1[$a].'">';
                  }
                  for($a=0;$a<count($K2);$a++)
                  {
                    echo '<input type="hidden" name="est2_'.$a.'" value="'.$K2[$a].'">';
                  }
                    
                  for($a=0;$a<count($Final1);$a++)
                  {
                    echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final1[$a].'">';

                  }
                  for($a=0;$a<count($Final2);$a++)
                  {
                    echo '<input type="hidden" name="estfinal2_'.$a.'" value="'.$Final2[$a].'">';

                  }

                  for($a=0;$a<count($lenguaje_1);$a++)
                  {
                    echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_1[$a].'">';
                  }

                  for($a=0;$a<count($lenguaje_2);$a++)
                  {
                    echo '<input type="hidden" name="leng2_'.$a.'" value="'.$lenguaje_2[$a].'">';
                  }

                  if($tipo_auto == "2afd")
                  {
                    echo '<input type="hidden" name="cant_trans" value="'.count($t1).'">';
                    $aux=0;
                    for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($lenguaje_1); $b++){
                        echo '<input type="hidden" name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$aux].'">';
                        $aux++;
                        }
                      }


                    echo '<input type="hidden" name="cant_trans2" value="'.count($t2).'">';
                    $aux2=0;
                    for($a=0; $a < $cant_array2; $a++){
                      for($b=0; $b <count($lenguaje_2); $b++){
                        echo '<input type="hidden" name="trans2_'.$aux2.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$aux2].'">';
                        $aux2++;
                        }
                      }

                  }


                  if($tipo_auto=="1afnd")
                  {
                    
                    echo '<input type="hidden" name="cant_trans" value="'.count($t1).'">';
                    $aux=0;
                    for($a=0; $a < $cant_array; $a++){
                      for($b=0; $b <count($lenguaje_1); $b++){
                        echo '<input type="hidden" name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$aux].'">';
                        $aux++;
                      }
                    }
                  }


                ?>
                <input class="btn btn-secondary btn-sm btninput active" type="submit" value="Simplificar AFD">
              </form>

              <form action="index.php?pagina=interseccion" method="POST">
                
                  <?php

                    echo '<input type="hidden" name="tipo_auto" value="'.$tipo_auto.'">';

                    if($tipo_auto=="2afd")
                    {
                      echo '<input type="hidden" name="cant_est" value="'.$cant_array.'">
                            <input type="hidden" name="cant_est2" value="'.$cant_array2.'">

                            <input type="hidden" name="cant_fin" value="'.count($Final1).'">
                            <input type="hidden" name="cant_fin2" value="'.count($Final2).'">

                            <input type="hidden" name="cant_leng" value="'.count($lenguaje_1).'">
                            <input type="hidden" name="cant_leng2" value="'.count($lenguaje_2).'">
                            
                      ';



                      for($a=0;$a<count($K1);$a++){
                        echo '<input type="hidden" name="est_'.$a.'" value="'.$K1[$a].'">
                        ';
                      }

                      echo '<input type="hidden" name="est_ini" value="'.$estad_inicial.'">';

                      for($a=0;$a<count($Final1);$a++){
                        echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$Final1[$a].'">
                        ';
                      }
                      
                      for($a=0;$a<count($lenguaje_1);$a++){
                        echo '<input type="hidden" name="leng_'.$a.'" value="'.$lenguaje_1[$a].'">
                        ';
                      }
                      
                      $aux=0;
                      for($a=0; $a < $cant_array; $a++){
                        for($b=0; $b <count($lenguaje_1); $b++){
                          
                          echo'<input type=hidden name="trans_'.$aux.'" value="'.$K1[$a].','.$lenguaje_1[$b].','.$t1[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input type='hidden' name='cant_trans' value='".$aux."'> ";

                      //////////////////////////////
                      //2do automata uwu

                      for($a=0;$a<count($K2);$a++){
                        echo '<input type="hidden" name="est2_'.$a.'" value="'.$K2[$a].'">
                        ';
                      }

                      echo '<input type="hidden" name="est_ini2" value="'.$estad_inicial2.'">';

                      for($a=0;$a<count($Final2);$a++){
                        echo '<input type="hidden" name="estfinal2_'.$a.'" value="'.$Final2[$a].'">
                        ';
                      }
                      
                      for($a=0;$a<count($lenguaje_2);$a++){
                        echo '<input type="hidden" name="leng2_'.$a.'" value="'.$lenguaje_2[$a].'">
                        ';
                      }

                      $aux=0;
                      for($a=0; $a < $cant_array2; $a++){
                        for($b=0; $b <count($lenguaje_2); $b++){
                          
                          echo'<input type=hidden name="trans2_'.$aux.'" value="'.$K2[$a].','.$lenguaje_2[$b].','.$t2[$aux].'">';
                          $aux++;
                        }
                      }
                      echo"<input class='btn btn-secondary btn-sm btninput active' type='hidden' name='cant_trans2' value='".$aux."'>
                          <input class='btn btn-secondary btn-sm btninput active' type='submit' value='Intersección de automatas'>";
                    }
                    

                  ?>
              
              </form>

              </div>
            </div>
          </div>
        </div>
        <div class="col-2"></div>
      </div>
    </div>

</body>

</html>