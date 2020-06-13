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
            class AFD{
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
            


            function union($A, $B)
            {
                $tipo_auto=$_POST['tipo_auto'];

                $C=new AFD();
                $C->est_ini="Q0";
                $C->trans[0]="((Q0,Ɛ), ".$A->est_ini.")";
                $C->trans[1]="((Q0,Ɛ), ".$B->est_ini.")";
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
                    array_push($C->est_fin,$A->est_fin[$a]);
                }
                for($a=0;$a<count($B->est_fin);$a++)
                {
                    array_push($C->est_fin,$B->est_fin[$a]);
                }
                
                //LENGUAJE
                array_push($C->leng,"Ɛ");

                for($a=0;$a<count($A->leng);$a++)
                {
                    array_push($C->leng,$A->leng[$a]);
                }
                for($a=0;$a<count($B->leng);$a++)
                {
                    array_push($C->leng,$B->leng[$a]);
                }

                //$C->leng=array_unique($C->leng);

                //TRANSICIONES

                for($a=0;$a<count($A->trans);$a++)
                {
                    array_push($C->trans,$A->trans[$a]);
                }
                for($a=0;$a<count($B->trans);$a++)
                {
                    if($B->trans[$a]!="x")
                    array_push($C->trans,$B->trans[$a]);
                }



                // imprime el automata
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
                
                $aux=array ();
                $aux=array_unique($C->leng);
                
                echo "σ_1 = {";
                for($a=0;$a<count($C->leng);$a++)
                {
                    if(isset($aux[$a]))
                        echo $aux[$a].",";
                    
                }
                echo "}<br>";

                echo 'δ_1: {';
                for($a=0;$a<count($C->trans);$a++){
                    echo $C->trans[$a].", ";
                }
                echo'}';
                
    
            }

            
            union($A,$B);
                

            


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