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
       
            class AFD
            {
              public $estados = array();
              public $est_ini;
              public $est_fin = array();
              public $leng=array();
              public $trans=array();
            }   
            $A=new AFD();

            for($a=0;$a<$_POST['cant_est'];$a++)
            {
              $A->estados[$a]=$_POST['est_'.$a];
            }

            $A->est_ini=$_POST['est_ini'];

            for($a=0;$a<$_POST['cant_fin'];$a++)
            {
                array_push($A->est_fin,$_POST['estfinal_'.$a]);
            }

            for($a=0;$a<$_POST['cant_leng'];$a++)
            {
                array_push($A->leng,$_POST['leng_'.$a]);
            }

            for($a=0;$a<$_POST['cant_trans'];$a++)
            {
                array_push($A->trans,$_POST['trans_'.$a]);
            }



       /*   function transformacion($A)
          {*/
              $C = new AFD();

              $conj_ini=array();
              array_push($conj_ini,$A->est_ini);


              $MatrizConjunto = array();
              for($a=0;$a<count($A->estados);$a++)
              {
                $MatrizConjunto[$a][0]=$A->estados[$a];
              }

              $aux=1;
              for($a=0;$a<count($A->leng);$a++)
              {
                if($A->leng[$a]!='epsilon')
                  $MatrizConjunto[0][$aux]=$A->leng[$a];
                $aux++;
              }
             

              $tran_separadas=array();


              //conjunto de estados iniciales
              for($a=0;$a<count($A->trans);$a++)
              {
                echo 'trancision '.$a.': '.$A->trans[$a].'<br>';
                $tran_separadas=explode(',',$A->trans[$a]);

                if($tran_separadas[0]==$A->est_ini)
                {
                  if($tran_separadas[1]=='epsilon')
                  {
                    array_push($conj_ini,$tran_separadas[2]);
                    echo 'T:'.$tran_separadas[2].'<br>';
                    $A->est_ini=$tran_separadas[2];
                  }
                }
              }



              for($a=0;$a<count($conj_ini);$a++)
              { 
                echo 'CONJUNTO_EST_INI '.$a.' : '.$conj_ini[$a].'<br>';
              }

              echo '<br>';



              $cont=0;
              for($a=0;$a<count($A->estados)+1;$a++)
              {
                for($b=0;$b<count($A->leng);$b++)
                {
                  if ( isset($MatrizConjunto[$a][$b] ))
                  {
                    echo '['.$a.']['.$b.']: '.$MatrizConjunto[$a][$b].' ';
                  }
                  else{

                    if($a>0 and $b>0)
                    {
                      if($b!=2)
                      {
                        echo 'TA:'.$cont.' ['.$a.']['.$b.']'.": vacio xd ";
                        $cont++;
                      }
                      else
                      {
                        echo 'TB:'.$cont.' ['.$a.']['.$b.']'.": vacio xd ";
                        $cont++;
                      }
                  
                    }
                  }
                }
                echo '<br>';
              }

         // }


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