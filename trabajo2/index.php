
<?php
    include("verautom.php");
    include("transformar.php");
    session_start();
    include("Automata.php");
    $_SESSION['ctemod'] = 0;
    $arrai3=array(["1","a","2"],["2","a","2"],["3","a","2"],["4","a","2"],["1","b","3"],["2","b","4"],["3","b","3"],["4","b","5"],["5","a","2"],["5","b","1"]);
    $arrai=array(["A","0","B"],["B","0","B"],["C","0","B"],["D","0","B"],["E","0","E"],["A","1","C"],["B","1","D"],["C","1","E"],["D","1","E"],["E","1","E"]);
    $arrai2=array(["q0","0","q0,q1"],["q0","1","q0"],["q1","1","q2"]);
    $a1=new automata("A,B,C,D,E","A","A,B,C,D","0,1",$arrai,"AFD");
    $a2=new automata("q0,q1,q2","q0","q2","0,1",$arrai2,"AFND");
    $a3=new automata("1,2,3,4,5","1","5","a,b",$arrai3,"AFD");
    $_SESSION["automata1"] = serialize($a1);
    $_SESSION["automata2"] = serialize($a2);
    $_SESSION["automatas"] = array ($_SESSION["automata1"],$_SESSION["automata2"]);
    //header("Location:formulario0.php");
    ver($a3);  
    simplificar($a1);
    ?>