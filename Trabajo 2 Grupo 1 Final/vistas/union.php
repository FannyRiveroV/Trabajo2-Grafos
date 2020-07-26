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
            <div class="form-group px-5 shadow p-3 mb-5 contenido rounded">            
                <?php


                $tipo_auto=$_POST['tipo_auto'];
                class AFD{
                    public $estados = array();
                    public $est_ini;
                    public $est_fin = array();
                    public $leng=array();
                    public $trans=array();

                    function verAuto()
                    {
                        echo 'QUINTUPLA  <br>';
                        echo "K = {";
                            for($a=0;$a<count($this->estados);$a++){
                                echo $this->estados[$a].",";
                            }
                        echo "} <br>";

                        echo "I = ".$this->est_ini."<br>";
                        
                        echo "F = {";
                        for($a=0;$a<count($this->est_fin);$a++){
                            echo $this->est_fin[$a].",";
                        }
                        echo "}<br>";

                        echo "σ = {";
                        for($a=0;$a<count($this->leng);$a++){
                            echo $this->leng[$a].",";
                        }
                        echo "}<br>";

                        echo 'δ = {';
                        for($a=0;$a<count($this->trans);$a++){
                            echo '('.$this->trans[$a].'), ';
                    
                        }
                        echo "}<br><br>";

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
                    $C = union($A,$B,$C);
                    echo 'Union de ambos automatas:<br><br>';
                    $C->verAuto();


                function union($A, $B, $C)
                {

                    $C->est_ini="Q0";
                    $C->trans[0]="Q0,epsilon,".$A->est_ini;
                    $C->trans[1]="Q0,epsilon,".$B->est_ini;

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
                    
                    for($a=0;$a<count($A->leng);$a++)
                    {
                        array_push($C->leng,$A->leng[$a]);
                    }
                    for($a=0;$a<count($B->leng);$a++)
                    {
                        array_push($C->leng,$B->leng[$a]);
                    }
                    array_push($C->leng,"epsilon");

                    $aux= array_unique($C->leng);
                        $aux2=array();

                        for($a=0;$a<count($C->leng);$a++)
                        {
                            if(isset($aux[$a])){
                                array_push($aux2,$aux[$a]);
                            }
                        }

                        $C->leng = $aux2;

                    //TRANSICIONES

                    for($a=0;$a<count($A->trans);$a++)
                    {
                        array_push($C->trans,$A->trans[$a]);
                    }
                    for($a=0;$a<count($B->trans);$a++)
                    {
                        if($B->trans[$a]!="x")
                        {
                            array_push($C->trans,$B->trans[$a]);
                        }
                    }



                    return $C;
        
                }

                ?>
                



                <form action="index.php?pagina=transformacion" method="POST">
                    <?php
                        $valor='" value="';
                        echo '<input type="hidden" name="tipo_auto" value="1afnd">
                            <input type="hidden" name="est_ini" value="'.$C->est_ini.'">
                            <input type="hidden" name="cant_est" value="'.count($C->estados).'">
                            <input type="hidden" name="cant_fin" value="'.count($C->est_fin).'">
                            <input type="hidden" name="cant_leng" value="'.count($C->leng).'">
                            <input type="hidden" name="cant_trans" value="'.count($C->trans).'">
                        ';


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