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
            
        

            function concatenacion($A,$B)
            {
                $C=new AFD();
                $tipo_conca=$_POST["tipo_conc"];

                if($tipo_conca=="A->B")
                {
                    $C->est_ini=$A->est_ini;

                    for($a=0;$a<count($A->estados);$a++){
                        array_push($C->estados,$A->estados[$a]);
                    }
                        
                    for($a=0;$a<count($B->estados);$a++)
                    {                            
                        array_push($C->estados,$B->estados[$a]);
                    }
                    
                    for($a=0;$a<count($A->leng);$a++)
                    {
                        array_push($C->leng,$A->leng[$a]);
                    }

                    array_push($C->leng,'Ɛ');

                    for($a=0;$a<count($B->leng);$a++)
                    {
                        array_push($C->leng,$B->leng[$a]);
                    }

                    $C->leng=array_unique($C->leng);

                    //finales uwu
                    for($a=0;$a<count($B->est_fin);$a++)
                    {
                      array_push($C->est_fin,$B->est_fin[$a]);
                    }

                    for($a=0;$a<count($A->est_fin);$a++)
                     {
                        $C->trans[$a]='(('.$A->est_fin[$a].', Ɛ), '.$B->est_ini.')';
                     }

                    for($a=0;$a<count($A->trans);$a++)
                    {
                        array_push($C->trans,$A->trans[$a]);
                    }

                    for($a=0;$a<count($B->trans);$a++)
                    {
                        array_push($C->trans,$B->trans[$a]);
                    }



                    echo "QUINTUPLA UNION: <br><br>";
                    
                     echo "K1 = {";
                        for($a=0;$a<count($C->estados);$a++){
                             echo $C->estados[$a].",";
                        }
                    echo "}<br>";
                    echo "I1 = ".$C->est_ini."<br>";

                    echo "F1 = {";
                    for($a=0;$a<count($C->est_fin);$a++){
                        echo $C->est_fin[$a].",";
                    }
                    echo "}";
                    echo "<br>";
                        
                    echo "σ_1 = {";
                    for($a=0;$a<count($C->leng);$a++)
                    {
                        if(isset($C->leng[$a]))
                            echo $C->leng[$a].",";
                    }
                    echo "}<br>";

                    echo 'δ_1: {';

                    for($a=0;$a<count($C->trans);$a++){
                        echo $C->trans[$a].", ";
                    }
                        
                    echo'}';
                    
                }
                else
                {
                    $C->est_ini=$B->est_ini;
                    for($a=0;$a<count($A->estados);$a++){
                        array_push($C->estados,$A->estados[$a]);
                    }
                        
                    for($a=0;$a<count($B->estados);$a++)
                    {                            
                        array_push($C->estados,$B->estados[$a]);
                    }
                    
                    for($a=0;$a<count($B->leng);$a++)
                    {
                        array_push($C->leng,$B->leng[$a]);
                    }

                    array_push($C->leng,'Ɛ');

                    for($a=0;$a<count($A->leng);$a++)
                    {
                        array_push($C->leng,$A->leng[$a]);
                    }


                    //finales uwu
                    for($a=0;$a<count($A->est_fin);$a++)
                    {
                      array_push($C->est_fin,$A->est_fin[$a]);
                    }

                    for($a=0;$a<count($B->est_fin);$a++)
                     {
                        $C->trans[$a]='(('.$B->est_fin[$a].', Ɛ), '.$A->est_ini.')';
                     }

                    for($a=0;$a<count($A->trans);$a++)
                    {
                        array_push($C->trans,$A->trans[$a]);
                    }

                    for($a=0;$a<count($B->trans);$a++)
                    {
                        array_push($C->trans,$B->trans[$a]);
                    }
                    echo "QUINTUPLA UNION: <br><br>";
                    
                     echo "K1 = {";
                        for($a=0;$a<count($C->estados);$a++){
                             echo $C->estados[$a].",";
                        }
                    echo "}<br>";
                    echo "I1 = ".$C->est_ini."<br>";

                    echo "F1 = {";
                    for($a=0;$a<count($C->est_fin);$a++){
                        echo $C->est_fin[$a].",";
                    }
                    echo "}";
                    echo "<br>";
                        
                    echo "σ_1 = {";
                    for($a=0;$a<count($C->leng);$a++)
                    {
                        echo $C->leng[$a].",";
                    }
                    echo "}<br>";

                    echo 'δ_1: {';

                    for($a=0;$a<count($C->trans);$a++){
                        echo $C->trans[$a].", ";
                    }
                        
                    echo'}';
                    
                  }
                }
                concatenacion($A,$B);

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