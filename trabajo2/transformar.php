<?php
    function complemento($automata){
        $automata->darEF(nofinales($automata));
    }

    function nofinales($automata){
        $nofinales;
        $c=0;
        foreach($automata->verE() as $estado){
            if(!in_array($estado,$automata->verEF())){
                $nofinales[$c]=$estado;
                $c+=1;
            }
        }
        return $nofinales;
    }

    function simplificar($automata){
        $final=$automata->verEF();
        $sig=$automata->verñe();
        $alf=$automata->veralf();
        $estad=$automata->verE();
        $nofinal=nofinales($automata);
        $subconjuntos=array();
        foreach($estad as $e){
            $fila=array($e);
            foreach($alf as $letra){
                array_push($fila,buscarsig($e,$letra,$sig));
            }
            array_push($subconjuntos,$fila);
        }
        vertabla($subconjuntos);
        
        $tabla=creartabla($final,$subconjuntos);
        $tabla2=creartabla($nofinal,$subconjuntos);
        $lamatrih=array($tabla,$tabla2);
        foreach($lamatrih as $ma){
            vertabla($ma);
        }
        while(comprobartermino($lamatrih)){
            $lamatrih=recursiva($lamatrih);
        }
        foreach($lamatrih as $ma){
            vertabla($ma);
        }
    }

    function buscarsig($estado,$letra,$directorio){
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