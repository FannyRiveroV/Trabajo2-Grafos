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

            $tipo_auto = $_POST['tipo_auto'];
            echo 'tipo auto :'.$tipo_auto.'<br>';
            class AFD
            {
              public $estados = array();
              public $est_ini;
              public $est_fin = array();
              public $leng=array();
              public $trans=array();

              function verAuto(){

                echo 'QUINTUPLA  <br>';
                echo "K = {";
                for($a=0;$a<count($this->estados);$a++){
                    echo $this->estados[$a].",";
                }
                echo "} <br>";

                echo "I = ".$this->est_ini."<br>";
            
                echo "F = {";
                for($a=0;$a<count($this->est_fin);$a++){
                  echo $this->est_fin[$a].",";
                }
                echo "}<br>";

                echo "σ = {";
                for($a=0;$a<count($this->leng);$a++){
                  echo $this->leng[$a].",";
                } 
                echo "}<br>";

                echo 'δ = {';
                $aux=0;
                for($a=0; $a < count($this->trans); $a++){
                  echo '('.$this->trans[$a].'), ';
                }
                echo "}<br>";


              }
            }   

            class AFDchoristico
            {
              public $estados = array();
              public $est_ini = array();
              public $est_fin = array();
              public $leng=array();
              public $trans=array();

              function verAuto(){

                echo '<br>QUINTUPLA Transformada <br>';
                echo "K = {";
                for($a=0;$a<count($this->estados);$a++)
                {
                  if(isset($this->estados[$a]))
                    echo $this->estados[$a].",";
                }
                echo "} <br>";

                echo "I = ";
                for($a=0;$a<count($this->est_ini);$a++)
                {
                 echo $this->est_ini[$a];
                }
                echo " <br>";

                echo "F = {";
                  $array2=array_unique($this->est_fin);
                  for($a=0;$a<count($this->est_fin);$a++)
                  {
                    if(isset($array2[$a]))
                    {
                      echo $array2[$a].",";
                    }
                  }
                echo "}<br>";

                echo "σ = {";
                for($a=0;$a<count($this->leng);$a++){
                  echo $this->leng[$a].",";
                } 
                echo "}<br>";

                echo 'δ = {';
                $array=array_unique($this->trans);
                for($a=0; $a < count($this->trans); $a++){
                  if(isset($array[$a])){
                    echo '('.$array[$a].'), ';
                  }
                  
                }
                echo "}<br>";
              }
            }

            if($tipo_auto=='1afnd')
            {
              $A=new AFD();
             //recuperar las transiciiones
              for($a=0;$a<$_POST['cant_est'];$a++)
              {
                $A->estados[$a]=$_POST['est_'.$a];
              }

              $A->est_ini=$_POST['est_ini'];

              for($a=0;$a<$_POST['cant_fin'];$a++)
              {
                array_push($A->est_fin,$_POST['estfinal_'.$a]);
              }

              for($a=0;$a<$_POST['cant_leng'];$a++)
              {
                array_push($A->leng,$_POST['leng_'.$a]);
              }

              for($a=0;$a<$_POST['cant_trans'];$a++)
              {
                array_push($A->trans,$_POST['trans_'.$a]);
             }
              
              $A->verAuto();

              //echo '<br>cantidad de lenguaje: '.cantLeng($A->leng);
              //echo '<br>cantidad de estados: '.count($A->estados);


              $C = new AFDchoristico();
              //conjunto estados iniciales
                $conj_ini=array();
                array_push($conj_ini,$A->est_ini);
                for($a=0;$a<count($A->trans);$a++)
                {
                  $arreglo=explode(',',$A->trans[$a]);
                  if($arreglo[0]==$A->est_ini){
                    if($arreglo[1]=='epsilon'){
                      array_push($conj_ini,$arreglo[2]);
                      $A->est_ini=$arreglo[2];
                    }
                  }
              }
              
              //echo '<br>conjunto inicial: ';
                for($a=0;$a<count($conj_ini);$a++){
                  //echo $conj_ini[$a];
                  array_push($C->est_ini,$conj_ini[$a]);
                }
                echo'<br>';

                array_push($C->estados,implode($conj_ini));

                for($a=0;$a<cantLeng($A->leng);$a++)
                {
                  array_push($C->leng,$A->leng[$a]);
              }

              //matriz de las transiciones
                $matriztrans= array ();
                for($a=0;$a<count($A->estados);$a++)
                {
                  for($b=0;$b<cantLeng($A->leng);$b++)
                  {
                    $palabra2="";
                    $palabra3="";
                    $palabra=transde($A->estados[$a],$A->leng[$b],$A->trans);
                    $palabra2=transde($A->estados[$a],'epsilon',$A->trans);
                    $palabra3=transde($palabra2,$A->leng[$b],$A->trans);
                    $palabra=$palabra.$palabra3;
                    
                    if(booltrans($palabra,$A->trans)=='true'){
                      $palabra = $palabra.transde($palabra,'epsilon',$A->trans);
                    }
                    $matriztrans[$a][$b]= $palabra;
                    echo $matriztrans[$a][$b];
                    echo'_'.'_'.'_'.'_';
                  }
                  echo '<br>';
              }



              //$C->verAuto();
              for($a=0;$a<count($C->estados);$a++)
              {
                if(isset($C->estados[$a]))
                {
                  $xd=existetrans($C->estados[$a],$C->leng,$C->trans);
                  if($xd== 'no existen')
                  {
                    transformacion($A,$C,str_split($C->estados[$a],2),$matriztrans);
                  }
                }
              }

              //finales

              for($a=0;$a<count($C->estados);$a++)
              {
                if(isset($C->estados[$a])){
                  //echo '<br> estado '.$a.': '.$C->estados[$a];
                  $string = str_split($C->estados[$a],2);
                  for($b=0;$b<count($string);$b++)
                  {
                    for($c=0;$c<count($A->est_fin);$c++)
                    if($string[$b] == $A->est_fin[$c])
                    {
                      array_push($C->est_fin,$C->estados[$a]);
                    }   
                  }
                }
              }
              
              $C->verAuto();

            }
            
            if($tipo_auto=='2afnd')
            {
              $A=new AFD();
             //recuperar el automata uwu
              for($a=0;$a<$_POST['cant_est'];$a++)
              {
                $A->estados[$a]=$_POST['est_'.$a];
              }

              $A->est_ini=$_POST['est_ini'];

              for($a=0;$a<$_POST['cant_fin'];$a++)
              {
                array_push($A->est_fin,$_POST['estfinal_'.$a]);
              }

              for($a=0;$a<$_POST['cant_leng'];$a++)
              {
                array_push($A->leng,$_POST['leng_'.$a]);
              }

              for($a=0;$a<$_POST['cant_trans'];$a++)
              {
                array_push($A->trans,$_POST['trans_'.$a]);
             }
              
              $A->verAuto();

              //echo '<br>cantidad de lenguaje: '.cantLeng($A->leng);
              //echo '<br>cantidad de estados: '.count($A->estados);

              //conjunto estados iniciales
                $conj_ini=array();
                array_push($conj_ini,$A->est_ini);
                for($a=0;$a<count($A->trans);$a++)
                {
                  $arreglo=explode(',',$A->trans[$a]);
                  if($arreglo[0]==$A->est_ini){
                    if($arreglo[1]=='epsilon'){
                      array_push($conj_ini,$arreglo[2]);
                      $A->est_ini=$arreglo[2];
                    }
                  }
              }

              $C = new AFDchoristico();
              //echo '<br>conjunto inicial: ';
                for($a=0;$a<count($conj_ini);$a++){
                  //echo $conj_ini[$a];
                  array_push($C->est_ini,$conj_ini[$a]);
                }
                echo'<br>';

                array_push($C->estados,implode($conj_ini));

                for($a=0;$a<cantLeng($A->leng);$a++)
                {
                  array_push($C->leng,$A->leng[$a]);
              }

              //matriz de las transiciones
                $matriztrans= array ();
                for($a=0;$a<count($A->estados);$a++)
                {
                  for($b=0;$b<cantLeng($A->leng);$b++)
                  {
                    $palabra2="";
                    $palabra3="";
                    $palabra=transde($A->estados[$a],$A->leng[$b],$A->trans);
                    $palabra2=transde($A->estados[$a],'epsilon',$A->trans);
                    $palabra3=transde($palabra2,$A->leng[$b],$A->trans);
                    $palabra=$palabra.$palabra3;

                    if(booltrans($palabra,$A->trans)=='true'){
                      $palabra = $palabra.transde($palabra,'epsilon',$A->trans);
                    }
                    $matriztrans[$a][$b]= $palabra;
                    echo $matriztrans[$a][$b];
                    echo'_'.'_'.'_'.'_';
                  }
                  echo '<br>';
              }




              //$C->verAuto();
              for($a=0;$a<count($C->estados);$a++)
              {
                $xd=existetrans($C->estados[$a],$C->leng,$C->trans);
                if($xd== 'no existen')
                {
                  transformacion($A,$C,str_split($C->estados[$a],2),$matriztrans);
                }
              }
              $C->verAuto();

              echo '<br>';

              $B = new AFD();
              //recuperar el automata uwu
                for($a=0;$a<$_POST['cant_est2'];$a++)
                {
                  $B->estados[$a]=$_POST['est2_'.$a];
                }

                $B->est_ini=$_POST['est_ini2'];

                for($a=0;$a<$_POST['cant_fin2'];$a++)
                {
                  array_push($B->est_fin,$_POST['estfinal2_'.$a]);
                }

                for($a=0;$a<$_POST['cant_leng2'];$a++)
                {
                  array_push($B->leng,$_POST['leng2_'.$a]);
                }

                for($a=0;$a<$_POST['cant_trans2'];$a++)
                {
                  array_push($B->trans,$_POST['trans2_'.$a]);
              }  
              $B->verAuto();
              //conjunto estados iniciales
                $conj_ini=array();
                array_push($conj_ini,$B->est_ini);
                for($a=0;$a<count($A->trans);$a++)
                {
                  $arreglo=explode(',',$B->trans[$a]);
                  if($arreglo[0]==$B->est_ini){
                    if($arreglo[1]=='epsilon'){
                      array_push($conj_ini,$arreglo[2]);
                      $B->est_ini=$arreglo[2];
                    }
                  }
              }
              $D = new AFDchoristico();

              //echo '<br>conjunto inicial: ';
                for($a=0;$a<count($conj_ini);$a++){
                  //echo $conj_ini[$a];
                  array_push($D->est_ini,$conj_ini[$a]);
                }
                echo'<br>';

                array_push($D->estados,implode($conj_ini));

                for($a=0;$a<cantLeng($B->leng);$a++)
                {
                  array_push($D->leng,$B->leng[$a]);
              }

              //matriz de las transiciones
                $matriztrans= array ();
                for($a=0;$a<count($B->estados);$a++)
                {
                  for($b=0;$b<cantLeng($B->leng);$b++)
                  {
                    $palabra2="";
                    $palabra3="";
                    $palabra=transde($B->estados[$a],$B->leng[$b],$B->trans);
                    $palabra2=transde($B->estados[$a],'epsilon',$B->trans);
                    $palabra3=transde($palabra2,$B->leng[$b],$B->trans);
                    $palabra=$palabra.$palabra3;

                    if(booltrans($palabra,$B->trans)=='true'){
                      $palabra = $palabra.transde($palabra,'epsilon',$B->trans);
                    }
                    $matriztrans[$a][$b]= $palabra;
                    echo $matriztrans[$a][$b];
                    echo'_'.'_'.'_'.'_';
                  }
                  echo '<br>';
              }

              //$D->verAuto();
              for($a=0;$a<count($D->estados);$a++)
              {
                $xd=existetrans($D->estados[$a],$D->leng,$D->trans);
                if($xd== 'no existen')
                {
                  transformacion($B,$D,str_split($D->estados[$a],2),$matriztrans);
                }
              }
              $D->verAuto();


            }


            function transformacion($A,$C,$estadoxd,$matriztrans)
            {
              
              //echo "<br>num de estados en este conjunto: ".count($estadoxd);
              //echo '<br>';

              //algoritmo principal?
              for($b=0;$b<cantLeng($A->leng);$b++)
              {

                $flechitas=array();
                for($a=0;$a<count($A->estados);$a++)
                {
                  for($c=0;$c<count($estadoxd);$c++)
                  {
                    if($estadoxd[$c]==$A->estados[$a])
                    {
                      array_push($flechitas,$matriztrans[$a][$b]);
                    }
                  }
                }


                $estadito=array();
                for($a=0;$a<count($flechitas);$a++)
                {
                  if(strlen($flechitas[$a])>2)
                  {
                    $separadas=str_split($flechitas[$a],2);
                    for($c=0;$c<count($separadas);$c++)
                    {
                      //echo '<br>conj de estados: '.$separadas[$c];
                      array_push($estadito,$separadas[$c]);
                    }
                  }
                  else{
                    //echo '<br>transicion'.' de '.$A->leng[$b].': '.$flechitas[$a];
                    array_push($estadito,$flechitas[$a]);
                  } 
                }
                /*echo "<br>estado cuando se lee ".$A->leng[$b].': ';
                for($a=0;$a<count($estadito);$a++)
                {
                  echo $estadito[$a];
                }*/

                //estadito finalsito uwu
                //echo "<br>estado final cuando se lee ".$A->leng[$b].': ';
                $estadito = array_unique($estadito);

                if(implode($estadito)==''){
                  //echo 'SUMIDERO' ;
                  $estadito = array();
                  array_push($estadito,'S');
                  array_push($C->estados,implode($estadito));
                  for($t=0;$t<cantLeng($A->leng);$t++)
                  {
                    array_push($C->trans,implode($estadito).','.$A->leng[$t].','.implode($estadito));
                  }
                }

                else{

                  /*for($a=0;$a<count($estadito);$a++)
                  {
                    echo $estadito[$a];
                  }*/
                  array_push($C->estados,implode($estadito));
                }

                array_push($C->trans,implode($estadoxd).','.$A->leng[$b].','.implode($estadito));
                
              }
              $C->estados=array_unique($C->estados);
              return $C;
            }

            function cantLeng($lenguaje)
            {
              $contador=0;

              for($a=0;$a<count($lenguaje);$a++)
              {
                if($lenguaje[$a]!='epsilon')
                {
                  $contador++;
                }

              }

              return $contador;
            }

            function transde($estado,$alf,$transxd)
            {
              
              for($a=0;$a<count($transxd);$a++)
              {
                $string = explode(',',$transxd[$a]);
                if($string[0]== $estado and $string[1]==$alf)
                  return $string[2];
              }
            }

            function booltrans($estado,$transiciones)
            {
              for($a=0;$a<count($transiciones);$a++)
              {
                $array=explode(',',$transiciones[$a]);
                if($array[0]==$estado and $array[1]=='epsilon')
                  return 'true';
              }
            }
            
            function existetrans($estado, $lenguaje,$transiciones)
            {
              $cont=0;
              for($a=0;$a<count($transiciones);$a++)
              {
                $string=explode(',',$transiciones[$a]);
                if($string[0]==$estado)
                  $cont++;
              }

              if($cont==cantLeng($lenguaje)){
                return 'existen';
              }
              else{
                return 'no existen'; 
              }
            }

            ?>

            
            
            <form action="index.php?pagina=simplificar" method="POST">
              <?php
                 echo'<input type="hidden" name="tipo_auto" value="1afnd">
                 <input type="hidden" name="est_ini" value="'.implode($C->est_ini).'">
                 <input type="hidden" name="cant_est" value="'.count($C->estados).'">
                 <input type="hidden" name="cant_fin" value="'.count($C->est_fin).'">
                 <input type="hidden" name="cant_leng" value="'.count($C->leng).'">';

                 $aux2=0;
                 for($a=0;$a<count($C->estados);$a++)
                 { 
                   if(isset($C->estados[$a])){
                    echo '<input type="hidden" name="est_'.$aux2.'" value="'.$C->estados[$a].'">';
                    $aux2++;
                   }
                 }
                 
                 for($a=0;$a<count($C->est_fin);$a++)
                 {
                   echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$C->est_fin[$a].'">';

                 }
                 for($a=0;$a<count($C->leng);$a++)
                 {
                   echo '<input type="hidden" name="leng_'.$a.'" value="'.$C->leng[$a].'">';
                 }

                 $aux=0;
                 $array=array_unique($C->trans);
                  for($a=0; $a < count($C->trans); $a++){
                    if(isset($array[$a])){
                      echo '<input type="hidden" name = "trans_'.$aux.'" value="'.$array[$a].'">';
                      $aux++;
                    }
                  }
                 echo '<input type="hidden" name="cant_trans" value="'.$aux.'">';
            
              ?>



            <input type="submit" value="Simplificar AFD transformado">
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