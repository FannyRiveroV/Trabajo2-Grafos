
<?php
    session_start();
    include_once("Automata.php");
    require("verautom.php"); 
    $m=($_SESSION["automatas"])[$_SESSION['ctemod']];
    $m=unserialize($m);
    $maux;
    $maux2;
    $c=0;
    $c2=0;
    $ala=$_POST["EstadosSig"];


    if(!comprobarvacio($_POST["EstadosSig"])){
        $sig=$_POST["EstadosSig"];
        foreach($m->verAlf() as $fila){
            foreach($m->verE() as $columna){
                $maux2=array($columna,$fila,$sig[$c2]);
                if(!empty($sig[$c2])){
                    $maux[$c]=$maux2;
                    $c+=1;
                }
                $c2+=1;
            }    
                
        }
        $m->darñe($maux);
    }

    else{
        $maux=$m->verñe();
        $c=count($maux);
    }
        

    $c2=0;
    if(!empty($_POST["est"])){
        $sig=$_POST["est"];
        foreach($m->verE() as $columna){
            $maux2=array($columna,"ε",$sig[$c2]);
            if(!empty($sig[$c2])){
                $maux[$c]=$maux2;
                $c+=1;
            }
            $c2+=1;
        }
        $m->darñe($maux);
    }
    ver($m);

    ($_SESSION["automatas"])[$_SESSION['ctemod']]=serialize($m);
?>
