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
            class AFD
            {
                public $estados = array();
                public $est_ini;
                public $est_fin = array();
                public $leng=array();
                public $trans=array();
            }   
            
            $A=new AFD();
            $B=new AFD();

            $A->est_ini=$_POST['est_ini'];



            
            for($a=0;$a<$_POST['cant_est'];$a++)
            {
                array_push($A->estados,$_POST['est_'.$a]);
            }
            for($a=0;$a<$_POST['cant_est2'];$a++)
            {
                array_push($B->estados,$_POST['est2_'.$a]);
            }

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

            echo 'QUINTUPLA 1 <br>';
            echo "K1 = {";
                for($a=0;$a<count($A->estados);$a++){
                    echo $A->estados[$a].",";
                }
            echo "} <br>";

            echo "I1 = ".$A->est_ini."<br>";
            
            echo "F1 = {";
              for($a=0;$a<count($A->est_fin);$a++){
                  echo $A->est_fin[$a].",";
              }
            echo "}<br>";

            echo "σ_1 = {";
              for($a=0;$a<count($A->leng);$a++){
                  echo $A->leng[$a].",";
              }
            echo "}<br>";

            echo 'δ_1: {';
              $aux=0;
              for($a=0; $a < count($A->estados); $a++){
                for($b=0; $b <count($A->leng); $b++){
                  echo '(('.$A->estados[$a].', '.$A->leng[$b].'), '.$A->trans[$aux].'), ';
                  $aux++;
                }
              }
              echo "}<br><br>";


            simplificar($A);






            $matriz=array();
            for($a=0;$a<count($A->trans);$a++)
            {
                array_push($matriz,explode(',',$A->trans[$a]));
                
            }



        
            function nofinales($automata)
            {
                $nofinales=array();
                $c=0;
                foreach($automata->estados as $estado){
                    if(!in_array($estado,$automata->est_fin)){
                        $nofinales[$c]=$estado;
                        $c+=1;
                    }
                }
                return $nofinales;
            }



            function simplificar($automata)
        {  
            
            $final=$automata->est_fin;
            $matriz=array();
            for($a=0;$a<count($automata->trans);$a++)
            {
                array_push($matriz,explode(',',$automata->trans[$a]));
                
            }
            $sig=$matriz;
            $alf=$automata->leng;
            $estad=$automata->estados;
            $nofinal=nofinales($automata);

        
            $subconjuntos=array();
            foreach($estad as $e){
                $fila=array($e);
                foreach($alf as $letra){
                    array_push($fila,buscarsig($e,$letra,$sig));
                }
                array_push($subconjuntos,$fila);
            }
            //vertabla($subconjuntos);
            
            $tabla=creartabla($final,$subconjuntos);
            $tabla2=creartabla($nofinal,$subconjuntos);

            $lamatrih=array($tabla,$tabla2);
           /* foreach($lamatrih as $ma){
                vertabla($ma);
            }*/
            while(comprobartermino($lamatrih)){
                $lamatrih=recursiva($lamatrih);
            }

            foreach($lamatrih as $ma)
            {
                vertabla($ma);
            }

        }


        function buscarsig($estado,$letra,$directorio)
        {
            foreach($directorio as $tupla){
                if ($tupla[0]==$estado && $tupla[1]==$letra){
                    return $tupla[2];
                }
            }
            return "";
        }

        function vertabla($tabla){
            foreach($tabla as $fila){
                echo "</br>";
                foreach($fila as $columna){
                    echo $columna. "------------";
                }
            }
            echo "</br>";
        }

        function creartabla($leng,$subconjuntos)
        {
            $c1=0;
            $tabla= array();
            foreach($leng as $f){
                for($j=0;$j<count($subconjuntos);$j++){
                    if($f==$subconjuntos[$j][0]){
                        for($i=0;$i<count($subconjuntos[0]);$i++){
                            $tabla[$c1][$i]=$subconjuntos[$j][$i];                
                        }
                        $c1+=1;
                    }
                }
            }
            return $tabla;
        }

        function filasiguales($tab){
            for($a=0;$a<count($tab);$a++){
                for($b=0;$b<count($tab);$b++){
                    if(($tab[$a][0]!=$tab[$b][0])){
                        $dif=0;
                        for($c=1;$c<count($tab[0]);$c++){
                            if($tab[$a][$c]!=$tab[$b][$c]){
                                $dif+=1;
                            }
                        }
                        if($dif==0){
                            $abc=array($tab[$a][0],$tab[$b][0]);
                            return $abc;
                        }       
                    }
                }
            }
            return FALSE;    
        }


        function recursiva($lamatrih){
            $cont=0;
            $lamatrih2=$lamatrih;
            foreach($lamatrih as $tab){
                $abc1=filasiguales($tab);
                if($abc1!=FALSE){
                    $abc2=array();
                    foreach($tab as $estado){
                        if(!in_array($estado[0],$abc1)){
                            array_push($abc2,$estado[0]);
                        }
                    }
                    $t1=crearfila($abc1,$tab);
                    $t2=creartabla($abc2,$tab);
                    $lamatrih2[$cont]=$t2;
                    array_push($lamatrih2,$t1);
                    $lamatrih2=cambiarestados($lamatrih2,$abc1);
                }
                else{
                    $cont+=1;
                }            
            }
            return $lamatrih2;
            
        }

        function crearfila($abc1,$tab){
            $fila[0][0]=$abc1[0].$abc1[1];
            for($j=0;$j<count($tab);$j++){
                if($tab[$j][0]==$abc1[0]){
                    for($i=1;$i<count($tab[$j]);$i++){
                        $fila[0][$i]=$tab[$j][$i];
                    }
                    return $fila;
                }
            }
        }

        function comprobartermino($lamatrih){
            foreach($lamatrih as $tab){
                if(filasiguales($tab)!=FALSE){
                    return TRUE;
                }
            }
            return FALSE;
        }

        function cambiarestados($lamatri,$abc1){
            $lamatrih=$lamatri;
            $c=0;
            foreach($lamatri as $tab){
                for($i=0;$i<count($tab);$i++){
                    for($j=1;$j<count($tab[$i]);$j++){
                        if($abc1[0]==$tab[$i][$j] or $abc1[1]==$tab[$i][$j]){
                            $lamatrih[$c][$i][$j]=$abc1[0].$abc1[1];
                        } 
                        else{
                            $lamatrih[$c][$i][$j]=$tab[$i][$j];
                        }          
                    }
                }
                $c+=1;
            }
            return $lamatrih;
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