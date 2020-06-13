<?php
    session_start();
    include("Automata.php");
    $_SESSION['ctemod']=$_POST["op"];
    $m=($_SESSION["automatas"])[$_SESSION['ctemod']];
    $m=unserialize($m);
    $m->dartipo($_POST["tipo"]);
    echo "Modificando Automata".($_SESSION['ctemod']+1)." de tipo ".$m->vertipo()."</br>";
    ($_SESSION["automatas"])[$_SESSION['ctemod']]=serialize($m);
    
?>

<html>
    <head>
        <title>Creando Automata</title>
    </head>
    
    <body>
        <form action="formulario.php" method="POST">
            <input type="text"  placeholder="Nombre Estados" name="Estados"><br>
            <input type="text"  placeholder="Alfabeto" name="Alfabeto"><br>
            <input type="text"  placeholder="Estado Inicial" name="Estadoincial"><br>
            <input type="text"  placeholder="Estados Finales" name="Estadofinal"><br></br>
            <?php
                if($_POST["tipo"]=="AFND"){
                    ?>
                    <p>¿Usa epsilon?</p>
                    <select name= "epsi">
                        <option value="si">si</option>
                        <option value="no">no</option>
                    </select>
                    <?php
                }
                
            ?>
            <input type="submit" value="enviar" name="enviar">
            
        </form>
        <form action="formulario0.php" method="POST">
            <input type="submit" value="volver atras" name="enviar">
        </form>
        
        
    </body>

    
</html>
