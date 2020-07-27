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
        <div class="col-4"></div>
        <div class="col-7"> <br> <br>
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded">            
            <?php
            $tipo_auto=$_POST['tipo_auto'];
            class AFD
            {
                public $estados = array();
                public $est_ini;
                public $est_fin = array();
                public $leng=array();
                public $trans=array();

                function verAuto(){
                    echo "<h4>QUINTUPLA  </h4><br>";
                    
                     echo "K = {";
                        for($a=0;$a<count($this->estados);$a++){
                             echo $this->estados[$a].",";
                        }
                    echo "}<br>";
                    echo "I1 = ".$this->est_ini."<br>";

                    echo "F = {";
                    for($a=0;$a<count($this->est_fin);$a++){
                        echo $this->est_fin[$a].",";
                    }
                    echo "}";
                    echo "<br>";
                        
                    echo "σ = {";
                    $aux=array_unique($this->leng);
                    for($a=0;$a<count($this->leng);$a++)
                    {
                        if(isset($aux[$a]))
                            echo $aux[$a].",";
                    }
                    echo "}<br>";

                    echo 'δ = {';

                    for($a=0;$a<count($this->trans);$a++){
                        echo "(".$this->trans[$a]."), ";
                    }
                        
                    echo'}';
                }
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
            




            $C=new AFD();
            concatenacion($A,$B,$C);
            $C->verAuto();
            

            function concatenacion($A,$B,$C)
            {
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

                    for($a=0;$a<count($B->leng);$a++)
                    {
                        array_push($C->leng,$B->leng[$a]);
                    }

                    array_push($C->leng,'epsilon');

                
                    //finales uwu
                    for($a=0;$a<count($B->est_fin);$a++)
                    {
                      array_push($C->est_fin,$B->est_fin[$a]);
                    }

                    for($a=0;$a<count($A->est_fin);$a++)
                     {
                        $C->trans[$a]=$A->est_fin[$a].',epsilon,'.$B->est_ini;
                     }

                    for($a=0;$a<count($A->trans);$a++)
                    {
                        array_push($C->trans,$A->trans[$a]);
                    }

                    for($a=0;$a<count($B->trans);$a++)
                    {
                        array_push($C->trans,$B->trans[$a]);
                    }

                    return $C;
                    
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

                    

                    for($a=0;$a<count($A->leng);$a++)
                    {
                        array_push($C->leng,$A->leng[$a]);
                    }

                    array_push($C->leng,'epsilon');

                    //finales uwu
                    for($a=0;$a<count($A->est_fin);$a++)
                    {
                      array_push($C->est_fin,$A->est_fin[$a]);
                    }

                    for($a=0;$a<count($B->est_fin);$a++)
                     {
                        $C->trans[$a]=$B->est_fin[$a].',epsilon,'.$A->est_ini;
                     }

                    for($a=0;$a<count($A->trans);$a++)
                    {
                        array_push($C->trans,$A->trans[$a]);
                    }

                    for($a=0;$a<count($B->trans);$a++)
                    {
                        array_push($C->trans,$B->trans[$a]);
                    }
                    
                }
            }
                
                
            ?>


                <form action="index.php?pagina=transformacion" method="POST">
                <?php
                        echo '<input type="hidden" name="tipo_auto" value="1afnd">
                            <input type="hidden" name="est_ini" value="'.$C->est_ini.'">
                            <input type="hidden" name="cant_est" value="'.count($C->estados).'">
                            <input type="hidden" name="cant_fin" value="'.count($C->est_fin).'">
                            <input type="hidden" name="cant_leng" value="'.count($C->leng).'">
                            <input type="hidden" name="cant_trans" value="'.count($C->trans).'">
                        ';


                        for($a=0;$a<count($C->estados);$a++)
                        {
                            echo'<input type="hidden" name="est_'.$a.'" value="'.$C->estados[$a].'">';
                        }
                        for($a=0;$a<count($C->est_fin);$a++)
                        {               
                        echo '<input type="hidden" name="estfinal_'.$a.'" value="'.$C->est_fin[$a].'">';
                        }

                        $aux=array_unique($C->leng);
                        $aux2=0;
                        for($a=0;$a<count($C->leng);$a++)
                        {
                            if(isset($aux[$a])){
                                echo '<input type="hidden" name="leng_'.$aux2.'" value="'.$aux[$a].'">';
                                $aux2++;
                            }
                        }

                        for($a=0;$a<count($C->trans);$a++)
                        {               
                        echo '<input type="hidden" name="trans_'.$a.'" value="'.$C->trans[$a].'">';
                        }

                    ?>
                    <input class="btn btn-secondary btn-sm btninput active" type="submit" value="Transformacion a AFD">
                </form>

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