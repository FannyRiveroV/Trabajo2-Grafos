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

                function verAuto(){
                    echo "QUINTUPLA : <br><br>";
                    
                    echo "K = {";
                        for($a=0;$a<count($this->estados);$a++){
                            echo $this->estados[$a].",";
                        }
                    echo "}<br>";
                    echo "I1 = ".$this->est_ini."<br>";

                    echo "F = {";
                        for($b=0;$b<count($this->est_fin);$b++){
                            echo $this->est_fin[$b].",";
                        }
                    echo "}";
                    echo "<br>";
                        
                    echo "σ = {";
                        for($c=0;$c<count($this->leng);$c++)
                        {
                            if(isset($this->leng[$c])){
                                echo $this->leng[$c].",";
                            }
                        }
                    echo "}<br>";

                    echo 'δ = {';

                        for($d=0;$d<count($this->trans);$d++){
                            echo "(".$this->trans[$d]."), ";
                        }
                        
                    echo'}';
                }
            }   
            
            $A=new AFD();
            $B=new AFD();

            for($e=0;$e<$_POST['cant_est'];$e++)
            {
                array_push($A->estados,$_POST['est_'.$e]);
            }
            for($f=0;$f<$_POST['cant_est2'];$f++)
            {
                array_push($B->estados,$_POST['est2_'.$f]);
            }

            $A->est_ini=$_POST['est_ini'];
            $B->est_ini=$_POST['est_ini2'];

            for($g=0;$g<$_POST['cant_fin'];$g++)
            {
                array_push($A->est_fin,$_POST['estfinal_'.$g]);
            }
            for($h=0;$h<$_POST['cant_fin2'];$h++)
            {
                array_push($B->est_fin,$_POST['estfinal2_'.$h]);
            }

            for($i=0;$i<$_POST['cant_leng'];$i++)
            {
                array_push($A->leng,$_POST['leng_'.$i]);
            }
            for($j=0;$j<$_POST['cant_leng2'];$j++)
            {
                array_push($B->leng,$_POST['leng2_'.$j]);
            }
           for($l=0;$l<$_POST['cant_trans'];$l++)
            {
                array_push($A->trans,$_POST['trans_'.$l]);
            }
          
            for($k=0;$k<$_POST['cant_trans2'];$k++)
            {               
              array_push($B->trans,$_POST['trans2_'.$k]);
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

                    for($m=0;$m<count($A->estados);$m++)
                    {
                        array_push($C->estados,$A->estados[$m]);
                    }
                        
                    for($n=0;$n<count($B->estados);$n++)
                    {                            
                        array_push($C->estados,$B->estados[$n]);
                    }
                    
                    for($o=0;$o<count($A->leng);$o++)
                    {
                        array_push($C->leng,$A->leng[$o]);
                    }

                    for($p=0;$p<count($B->leng);$p++)
                    {
                        array_push($C->leng,$B->leng[$p]);
                    }

                    array_push($C->leng,'epsilon');

                    $C->leng=array_unique($C->leng);

                    //finales uwu
                    for($q=0;$q<count($B->est_fin);$q++)
                    {
                      array_push($C->est_fin,$B->est_fin[$q]);
                    }

                    for($r=0;$r<count($A->est_fin);$r++)
                     {
                        $C->trans[$r]=$A->est_fin[$r].',epsilon,'.$B->est_ini;
                     }

                    for($s=0;$s<count($A->trans);$s++)
                    {
                        array_push($C->trans,$A->trans[$s]);
                    }

                    for($t=0;$t<count($B->trans);$t++)
                    {
                        array_push($C->trans,$B->trans[$t]);
                    }

                    return $C;
                    
                }
                else
                {
                    $C->est_ini=$B->est_ini;
                    for($v=0;$v<count($A->estados);$v++){
                        array_push($C->estados,$A->estados[$v]);
                    }
                        
                    for($w=0;$w<count($B->estados);$w++)
                    {                            
                        array_push($C->estados,$B->estados[$w]);
                    }
                    
                    for($x=0;$x<count($B->leng);$x++)
                    {
                        array_push($C->leng,$B->leng[$x]);
                    }

                    

                    for($y=0;$y<count($A->leng);$y++)
                    {
                        array_push($C->leng,$A->leng[$y]);
                    }

                    array_push($C->leng,'epsilon');

                    //finales uwu
                    for($z=0;$z<count($A->est_fin);$z++)
                    {
                      array_push($C->est_fin,$A->est_fin[$z]);
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

                        $valor='" value="';
                        for($a=0;$a<count($C->estados);$a++)
                        {
                            echo'<input type="hidden" name="est_'.$a.$valor.$C->estados[$a].'">';
                        }
                        for($a=0;$a<count($C->est_fin);$a++)
                        {               
                        echo '<input type="hidden" name="estfinal_'.$a.$valor.$C->est_fin[$a].'">';
                        }

                        for($a=0;$a<count($C->leng);$a++)
                        {               
                        echo '<input type="hidden" name="leng_'.$a.$valor.$C->leng[$a].'">';
                        }

                        for($a=0;$a<count($C->trans);$a++)
                        {               
                        echo '<input type="hidden" name="trans_'.$a.$valor.$C->trans[$a].'">';
                        }

                    ?>
                    <input type="submit" value="Transformacion a AFD">
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