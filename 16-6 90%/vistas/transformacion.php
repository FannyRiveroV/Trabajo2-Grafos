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
       
            class AFD
            {
              public $estados = array();
              public $est_ini;
              public $est_fin = array();
              public $leng=array();
              public $trans=array();

              function verAuto(){

                echo 'QUINTUPLA 1 <br>';
                echo "K1 = {";
                for($a=0;$a<count($this->estados);$a++){
                    echo $this->estados[$a].",";
                }
                echo "} <br>";

                echo "I1 = ".$this->est_ini."<br>";
            
                echo "F1 = {";
                for($a=0;$a<count($this->est_fin);$a++){
                  echo $this->est_fin[$a].",";
                }
                echo "}<br>";

                echo "σ_1 = {";
                for($a=0;$a<count($this->leng);$a++){
                  echo $this->leng[$a].",";
                } 
                echo "}<br>";

                echo 'δ_1: {';
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

                echo '<br>QUINTUPLA 1 <br>';
                echo "K1 = {";
                for($a=0;$a<count($this->estados);$a++)
                {
                  echo $this->estados[$a].",";
                }
                echo "} <br>";

                echo "I1 = ";
                for($a=0;$a<count($this->est_ini);$a++)
                {
                 echo $this->est_ini[$a];
                }
                echo " <br>";

                echo "F1 = {";
                for($a=0;$a<count($this->est_fin);$a++){
                  echo $this->est_fin[$a].",";
                }
                echo "}<br>";

                echo "σ_1 = {";
                for($a=0;$a<count($this->leng);$a++){
                  echo $this->leng[$a].",";
                } 
                echo "}<br>";

                echo 'δ_1: {';
                $array=array_unique($this->trans);
                
                for($a=0; $a < count($this->trans); $a++){
                  if(isset($array[$a])){
                    echo '('.$array[$a].'), ';
                  }
                  
                }
                echo "}<br>";
              }
            }


            $A=new AFD();
            function recuperarafnd($A)
            {
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
            }
            recuperarafnd($A);
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
            
            echo '<br>conjunto inicial: ';
            for($a=0;$a<count($conj_ini);$a++){
              echo $conj_ini[$a];
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

            $C->verAuto();
            for($a=0;$a<count($C->estados);$a++)
            {
              $xd=existetrans($C->estados[$a],$C->leng,$C->trans);
              
              if($xd== 'no existen')
              {
                transformacion($A,$C,str_split($C->estados[$a],2),$matriztrans);
              }
            }
            
            //$C->trans = array_unique($C->trans);
            $C->verAuto();

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