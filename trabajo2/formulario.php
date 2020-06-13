<?php
    session_start();
    include_once("Automata.php");
    $m=($_SESSION["automatas"])[$_SESSION['ctemod']];
    $m=unserialize($m);

    if(!empty($_POST["Estados"])){
        $m->darE(llenararreglos($_POST["Estados"]));
    }
    if(!empty($_POST["Estadoincial"])){
        $m->darEI($_POST["Estadoincial"]);
    }
    if(!empty($_POST["Estadofinal"])){
        $m->darEF(llenararreglos($_POST["Estadofinal"]));
    }
    if(!empty($_POST["Alfabeto"])){
        $m->darAlf(llenararreglos($_POST["Alfabeto"]));
    }
    
?>


<html>
    <body>
        <form action="formulario2.php" method="POST">
            <?php
            echo "<table border=6>";
            foreach($m->verAlf() as $fila){
                echo "<tr>";
                foreach($m->verE() as $columna){
                    echo "<td>&($columna,$fila)= ";
                    ?>
                    <input type="text"  placeholder="Estados siguientes" name="EstadosSig[]"><br>
                <?php
                    echo"</td>";
                }  
            }
            echo "</tr>";
            if(!empty($_POST["epsi"]) && $_POST["epsi"]=="si"){
                echo "<table border=6>";
                foreach($m->verE() as $columna){
                    echo "<td>&($columna,ε)= " ;
                    ?>
                    <input type="text"  placeholder="Estados siguientes" name="est[]"><br>
                <?php
                    echo"</td>";
                }

            }         
            ($_SESSION["automatas"])[$_SESSION['ctemod']]=serialize($m);
            ?>
            <input type="submit" value="enviar">
        </form>
        <form action="formulario0.php" method="POST">
            <input type="submit" value="volver al inicio">
        </form>
    </body>
</html>



