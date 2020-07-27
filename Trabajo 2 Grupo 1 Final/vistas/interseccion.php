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
        <div class="col-4"></div>
        <div class="col-7"> <br> <br>
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded"> 
                <?php
                    $tipo_auto=$_POST['tipo_auto'];
                    class AFD{
                        public $estados = array();
                        public $est_ini;
                        public $est_fin = array();
                        public $leng=array();
                        public $trans=array();

                        function verAuto()
                        {
                            echo '<h4>QUINTUPLA </h4> <br>';
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
                            for($a=0;$a<count($this->trans);$a++){
                                echo '('.$this->trans[$a].'), ';
                        
                            }
                            echo "}<br><br>";

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
        
                        echo '<br><h4>QUINTUPLA TRANSFORMADA</h4> <br>';
                        echo "K = {";
                        for($a=0;$a<count($this->estados);$a++)
                        {
                          if(isset($this->estados[$a]))
                          {
                            echo $this->estados[$a].",";
                          }
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
                        $bri;
        
                        echo "σ = {";
                        for($a=0;$a<count($this->leng);$a++){
                          echo $this->leng[$a].",";
                        } 
                        $bri;
        
                        echo 'δ = {';
                        $array=array_unique($this->trans);
                        for($a=0; $a < count($this->trans); $a++){
                          if(isset($array[$a])){
                            echo '('.$array[$a].'), ';
                          }
                          
                        }
                        $bri;
                      }
                    }

                    $A=new AFD();
                    $B=new AFD();

                    
                    for($a=0;$a<$_POST['cant_est'];$a++)
                    {
                        array_push($A->estados,$_POST['est_'.$a]);
                    }

                    for($a=0;$a<$_POST['cant_est2'];$a++)
                    {
                        array_push($B->estados,$_POST['est2_'.$a]);
                    }

                    $A->est_ini=$_POST['est_ini'];
                    $B->est_ini=$_POST['est_ini2'];

                    for($a=0;$a<$_POST['cant_fin'];$a++)
                    {
                        array_push($A->est_fin,$_POST['estfinal_'.$a]);
                    }
                    for($a=0;$a<$_POST['cant_fin2'];$a++)
                    {
                        array_push($B->est_fin,$_POST['estfinal2_'.$a]);
                    }

                    for($a=0;$a<$_POST['cant_leng'];$a++)
                    {
                        array_push($A->leng,$_POST['leng_'.$a]);
                    }
                    for($a=0;$a<$_POST['cant_leng2'];$a++)
                    {
                        array_push($B->leng,$_POST['leng2_'.$a]);
                    }

                    for($a=0;$a<$_POST['cant_trans'];$a++)
                    {
                        array_push($A->trans,$_POST['trans_'.$a]);
                    }
                        
                    
                    for($a=0;$a<$_POST['cant_trans2'];$a++)
                    {               
                    array_push($B->trans,$_POST['trans2_'.$a]);
                    }
                
                    $D = new AFD();

                    $A->verAuto();
                    $B->verAuto();

                    complemento($A);
                    complemento($B);
                    echo '<hr><h4>COMPLEMENTOS</h4><br>';
                    $A->verAuto();
                    $B->verAuto();


                    $D = union($A,$B,$D);

                    echo '<hr><h4>UNION AUTOMATAS<><br>';

                    $D->verAuto();


                    $C = new AFDchoristico();
                    //conjunto estados iniciales
                        $epsilon='epsilon';
                        $conj_ini=array();
                        array_push($conj_ini,$D->est_ini);
                        for($a=0;$a<count($D->trans);$a++)
                        {
                        $arreglo=explode(',',$D->trans[$a]);
                        if($arreglo[0]==$D->est_ini && $arreglo[1]==$epsilon)
                        {
                            array_push($conj_ini,$arreglo[2]);
                            $A->est_ini=$arreglo[2];
                            
                        }
                    }
                        for($a=0;$a<count($conj_ini);$a++){
                        array_push($C->est_ini,$conj_ini[$a]);
                        }
                        echo'<br>';

                        array_push($C->estados,implode($conj_ini));

                        for($a=0;$a<cantLeng($D->leng);$a++)
                        {
                        array_push($C->leng,$D->leng[$a]);
                    }

                    //matriz de las transiciones
                        $matriztrans= array ();
                        for($a=0;$a<count($D->estados);$a++)
                        {
                        for($b=0;$b<cantLeng($D->leng);$b++)
                        {
                            $palabra2="";
                            $palabra3="";
                            $palabra=transde($D->estados[$a],$D->leng[$b],$D->trans);
                            $palabra2=transde($D->estados[$a],$epsilon,$D->trans);
                            $palabra3=transde($palabra2,$D->leng[$b],$D->trans);
                            $palabra=$palabra.$palabra3;
                            
                            if(booltrans($palabra,$D->trans)=='true'){
                            $palabra = $palabra.transde($palabra,$epsilon,$D->trans);
                            }
                            $matriztrans[$a][$b]= $palabra;
                            echo $matriztrans[$a][$b];
                            echo'_'.'_'.'_'.'_';
                        }
                        echo '<br>';
                    }


                    for($a=0;$a<count($C->estados);$a++)
                    {
                        if(isset($C->estados[$a]))
                        {
                        $xd=existetrans($C->estados[$a],$C->leng,$C->trans);
                        if($xd== 'no existen')
                        {
                            transformacion($D,$C,str_split($C->estados[$a],2),$matriztrans);
                        }
                        }
                    }

                    //finales

                    for($a=0;$a<count($C->estados);$a++)
                    {
                        if(isset($C->estados[$a])){
                        $string = str_split($C->estados[$a],1);
                        for($b=0;$b<count($string);$b++)
                        {
                            for($c=0;$c<count($D->est_fin);$c++){
                                if($string[$b] == $D->est_fin[$c])
                                {
                                    array_push($C->est_fin,$C->estados[$a]);
                                }
                            }   
                        }
                        }
                    }
                    

                    echo '<hr><h4>QUINTUPLA SIMPLIFICADA </h4><br>';
                    $C->verAuto();

                    complemento($C);
                    echo '<hr><h4>INTERSECCION DE LOS AUTOMATAS</h4><br>';
                    $C->verAuto();






                    function complemento($A)
                    {
                      $arrayaux=array();
                      $aux=0;
                      for($a=0;$a<count($A->estados);$a++){
                          if(isset($A->estados[$a])){
                            $arrayaux[$aux]=$A->estados[$a];
                            $aux++;
                          }
                      }
        
                      $b=0;
                      $aux=0;
                      while( $b < count($A->est_fin))
                      {
                        for($a=0;$a<count($A->estados);$a++)
                        {
                            if(isset($A->estados[$a]) && $A->est_fin[$b] == $A->estados[$a])
                            {
                                unset($arrayaux[$aux]);
                                $aux++;
                                
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

                    function union($A, $B, $C)
                    {
                        $epsilon='epsilon';
                        $C->est_ini="Q0";
                        $C->trans[0]="Q0,epsilon,".$A->est_ini;
                        $C->trans[1]="Q0,epsilon,".$B->est_ini;

                        array_push($C->estados,$C->est_ini);
                        //ESTADOSSSS
                        for($a=0;$a<count($A->estados);$a++)
                        {
                            array_push($C->estados,$A->estados[$a]);
                        }
                        for($a=0;$a<count($B->estados);$a++)
                        {
                            array_push($C->estados,$B->estados[$a]);
                        }

                        //ESTADOS FINALESS
                        for($a=0;$a<count($A->est_fin);$a++)
                        {
                            if(isset($A->est_fin[$a])){
                                array_push($C->est_fin,$A->est_fin[$a]);
                            }
                        }
                        for($a=0;$a<count($B->est_fin);$a++)
                        {
                            if(isset($B->est_fin[$a])){
                                array_push($C->est_fin,$B->est_fin[$a]);
                            }
                        }
                        
                        //LENGUAJE
                        for($a=0;$a<count($A->leng);$a++)
                        {
                            array_push($C->leng,$A->leng[$a]);
                        }
                        for($a=0;$a<count($B->leng);$a++)
                        {
                            array_push($C->leng,$B->leng[$a]);
                        }
                        array_push($C->leng,$epsilon);

                        $aux= array_unique($C->leng);
                        $aux2=array();

                        for($a=0;$a<count($C->leng);$a++)
                        {
                            if(isset($aux[$a])){
                                array_push($aux2,$aux[$a]);
                            }
                        }
                        $C->leng = $aux2;

                        //TRANSICIONES

                        for($a=0;$a<count($A->trans);$a++)
                        {
                            array_push($C->trans,$A->trans[$a]);
                        }
                        for($a=0;$a<count($B->trans);$a++)
                        {
                            if($B->trans[$a]!="x")
                            {
                                array_push($C->trans,$B->trans[$a]);
                            }
                        }



                        return $C;
            
                    }

                    function transformacion($A,$C,$estadoxd,$matriztrans)
                    {
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
                                array_push($estadito,$separadas[$c]);
                                }
                            }
                            else{
                                array_push($estadito,$flechitas[$a]);
                            } 
                            }
                            $estadito = array_unique($estadito);

                            if(implode($estadito)==''){
                            $estadito = array();
                            array_push($estadito,'S');
                            array_push($C->estados,implode($estadito));
                            for($t=0;$t<cantLeng($A->leng);$t++)
                            {
                                array_push($C->trans,implode($estadito).','.$A->leng[$t].','.implode($estadito));
                            }
                            }

                            else{

                            array_push($C->estados,implode($estadito));
                            }

                            array_push($C->trans,implode($estadoxd).','.$A->leng[$b].','.implode($estadito));
                            
                        }
                        $C->estados=array_unique($C->estados);
                        return $C;
                    }

                    function cantLeng($lenguaje)
                    {
                        $epsilon='epsilon';
                        $contador=0;

                        for($a=0;$a<count($lenguaje);$a++)
                        {
                            if($lenguaje[$a]!=$epsilon)
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
                            if($string[0]== $estado && $string[1]==$alf)
                            {
                                return $string[2];
                            }
                        }
                    }

                    function booltrans($estado,$transiciones)
                    {
                        for($a=0;$a<count($transiciones);$a++)
                        {
                            $array=explode(',',$transiciones[$a]);
                            if($array[0]==$estado && $array[1]=='epsilon')
                            {    
                                return 'true';
                            }
                        }
                    }
                    
                    function existetrans($estado, $lenguaje,$transiciones)
                    {
                        $cont=0;
                        for($a=0;$a<count($transiciones);$a++)
                        {
                            $string=explode(',',$transiciones[$a]);
                            if($string[0]==$estado){
                                $cont++;
                            }
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