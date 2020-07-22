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

                function verAuto()
                {
                    echo 'QUINTUPLA  <br>';
                    echo "K = {";
                        for($a=0;$a<count($this->estados);$a++){
                            echo $this->estados[$a].",";
                        }
                    echo "} <br>";

                    echo "I = ".$this->est_ini."<br>";
                    
                    echo "F = {";
                    for($a=0;$a<count($this->est_fin);$a++){
                        if(isset($this->est_fin[$a]))
                        {
                            echo $this->est_fin[$a].",";
                        }
                         
                    }
                    echo "}<br>";

                    echo "σ = {";
                    for($a=0;$a<count($this->leng);$a++){
                        echo $this->leng[$a].",";
                    }
                    echo "}<br>";

                    echo 'δ = {';
                    
                    for($a=0; $a < count($this->trans); $a++)
                    {
                        echo '('.$this->trans[$a].'), ';
                    
                    }
                    echo "}<br><br>";

                }
            }   
            
            if($tipo_auto=="2afd"){

                $A=new AFD();
                $B=new AFD();

                $A->est_ini=$_POST['est_ini'];
                $B->est_ini=$_POST['est_ini2'];

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
                for($a=0;$a<$_POST['cant_trans2'];$a++)
                {
                    array_push($B->trans,$_POST['trans2_'.$a]);
                }
         
                simplificar($A);
                simplificar($B);

                $A->verAuto();
                $B->verAuto();
                
            }

            if($tipo_auto=="1afnd"){
                $A=new AFD();

                $A->est_ini=$_POST['est_ini'];
                
                for($a=0;$a<$_POST['cant_est'];$a++)
                {
                    if(isset($_POST['est_'.$a]))
                        array_push($A->estados,$_POST['est_'.$a]);
                }
                
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
                echo 'SIMPLIFICACION: <br><br>';
                simplificar($A);
                $A->verAuto();
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

            function simplificar($automata){
                $final=$automata->est_fin;
                $sig=array();
                for($a=0;$a<count($automata->trans);$a++)
                {
                    array_push($sig,explode(',',$automata->trans[$a]));
                    
                }
                $subconjuntos=array();
                foreach($automata->estados as $e){
                    $fila=array($e);
                    foreach($automata->leng as $letra){
                        array_push($fila,buscarsig($e,$letra,$sig));
                    }
                    array_push($subconjuntos,$fila);
                }
                $tabla=creartabla($final,$subconjuntos);
                $tabla2=creartabla(nofinales($automata),$subconjuntos);
                $lamatrih=array($tabla,$tabla2);
                while(comprobartermino($lamatrih)){
                    $lamatrih=recursiva($lamatrih,$automata);
                }
                detablaadatos($lamatrih,$automata);
            }

            function buscarsig($estado,$letra,$directorio){
                foreach($directorio as $tupla){
                    if ($tupla[0]==$estado && $tupla[1]==$letra){
                        return $tupla[2];
                    }
                }
                return "";
            }

            
            function creartabla($leng,$subconjuntos){
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
                                return array $tab[$a][0],$tab[$b][0];
                            }       
                        }
                    }
                }
                return FALSE;    
            }


            function recursiva($lamatrih,$automata){
                for($t=0;$t<count($lamatrih);$t++){
                    $abc1=filasiguales($lamatrih[$t]);
                    if(!$abc1){
                        $abc2=array();
                        foreach($lamatrih[$t] as $estado){
                            if(!in_array($estado[0],$abc1)){
                                array_push($abc2,$estado[0]);
                            }
                        }
                        $t1=crearfila($abc1,$lamatrih[$t]);
                        $t2=creartabla($abc2,$lamatrih[$t]);
                        array_unshift($t2,$t1);
                        $lamatrih[$t]=$t2;
                        if($abc1[0]==$automata->est_ini || $abc1[1]==$automata->est_ini){
                            $automata->est_ini=$abc1[0].$abc1[1];
                        }
                        $lamatrih=cambiarestados($lamatrih,$abc1);
                    }
                }
                return $lamatrih;
            }

            function crearfila($abc1,$tab){
                $fila[0]=$abc1[0].$abc1[1];
                for($j=0;$j<count($tab);$j++){
                    if($tab[$j][0]==$abc1[0]){
                        for($i=1;$i<count($tab[$j]);$i++){
                            $fila[$i]=$tab[$j][$i];
                        }
                        return $fila;
                    }
                }
            }

            function comprobartermino($lamatrih){
                foreach($lamatrih as $tab){
                    if(!filasiguales($tab)){
                        return TRUE;
                    }
                }
                return FALSE;
            }

            function cambiarestados($lamatri,$abc1){
                for($c=0;$c<count($lamatri);$c++){
                    for($i=0;$i<count($lamatri[$c]);$i++){
                        for($j=0;$j<count($lamatri[$c][$i]);$j++){
                            if($abc1[0]==$lamatri[$c][$i][$j]  || $abc1[1]==$lamatri[$c][$i][$j]){
                                $lamatri[$c][$i][$j]=$abc1[0].$abc1[1];
                            }       
                        }
                    }
                }
                return $lamatri;
            }

            function detablaadatos($lamatrih,$automata){
                $estados=array();
                $transiciones=array();
                $estadofinal=array();

                for($t=0;$t<count($lamatrih);$t++){
                    for($j=0;$j<count($lamatrih[$t]);$j++){
                        array_push($estados,$lamatrih[$t][$j][0]);
                        if($t==0){
                            array_push($estadofinal,$lamatrih[$t][$j][0]);
                        }
                        for($i=1;$i<count($lamatrih[$t][$j]);$i++){
                            $tupla=$lamatrih[$t][$j][0].','.$automata->leng[$i-1].','.$lamatrih[$t][$j][$i];
                            array_push($transiciones,$tupla);
                        }
                    }
                }
                $automata->estados=$estados;
                $automata->est_fin=$estadofinal;
                $automata->trans=$transiciones;
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