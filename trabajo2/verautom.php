<?php
    
    function ver($autom){
        echo "El automata es: ";
        echo $autom->vertipo();
        echo "</br>";

        echo "</br>"."Los estados son: ";
        foreach ($autom->verE() as $estado) {
            echo $estado.",";
        }
        echo "</br>";

        echo "</br>"."Los estados finales son: ";
        foreach ($autom->verEF() as $estado) {
            echo $estado.",";
        }
        echo "</br>";
        echo "</br>"."Los estados Iniciales son: ";
        foreach ($autom->verEI() as $estado) {
            echo $estado.",";
        }
        echo "</br>";
        echo "</br>"."El alfabeto es: ";
        foreach ($autom->verAlf() as $estado) {
            echo $estado.",";
        }
        echo "</br>";
        $c=0;
        echo "</br>"."Los estados & son: ";
        
        foreach($autom->verñe() as $tupla){
            echo "</br>&(".$tupla[0].",".$tupla[1].")=".$tupla[2]."; ";
            $c+=1;
        }
        echo "</br>"."=======================================================";
    }

    function comprobarvacio($arreglo){
        foreach($arreglo as $valor){
            if(!empty($valor)){
                return FALSE;
            }
        }
        return TRUE;
    }
?>