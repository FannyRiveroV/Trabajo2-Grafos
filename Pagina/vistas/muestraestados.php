<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grafos T2 </title>
</head>
<body>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Automatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

            <?php 
                   //recuperamos la cantidad de estados
                   $cant_array= $_POST['cantida_estados_1'];
                   $cant_array2= $_POST['cantida_estados_2'];
   
                   $estado_inicial=$_POST['inicial'];
                   $estado_inicial2=$_POST['inicial2'];
   
                   $K1= array();
                   $K2= array();
                   $F1=array();
                   $F2=array();
       
                   //pushean los nombres a los arrays del primer automata
                   for($a=0;$a<$cant_array;$a++){
                       array_push($K1,$_POST['estado'.$a]);
                       if($estado_inicial=$a)
                       {
                           $estado_inicial=$K1[$a];
                       }
                   }
                   
   
                   //pushean los nombres a los arrays del segundo automata
                   for($a=0;$a<$cant_array2;$a++){
                       array_push($K2,$_POST['estado_'.$a]);
                       if($estado_inicial2=$a)
                       {
                           $estado_inicial2=$K2[$a];
                       }
                   }
                   
   
                   // push para los arrays FINALES
                   for($a=0;$a<$cant_array;$a++)
                   {
                     if(isset($_POST['final_'.$a])){
                       if($_POST['final_'.$a]==$a)
                       {
                       array_push($F1,$K1[$a]);
                       }
                    }
                   }
                   for($a=0;$a<$cant_array2;$a++)
                   {
                     if(isset($_POST['final2_'.$a]) && $_POST['final2_'.$a]==$a)
                        {
                         array_push($F2,$K2[$a]);
                        }
                     }  
                   }
   
   
   
   
   
   
   
   
   
   
   
   
                   echo "PRIMERA QUINTUPLA <br><br>";
                   // imprime el automata 1
                   echo "K1 = {";
                       for($a=0;$a<count($K1);$a++){
                           echo $K1[$a].",";
                       }
                   echo "} <br>";
   
                   echo "I1 = ".$estado_inicial."<br>";
                   
                   echo "F1 = {";
                     for($a=0;$a<count($F1);$a++){
                         echo $F1[$a].",";
                     }
                   echo "}<br><br>";
   
   
                   echo "SEGUNDA QUINTUPLA <br><br>";
                   // imprime el automata 2
                   echo "K2 = {";
                       for($a=0;$a<count($K2);$a++){
                           echo $K2[$a].",";
                       }
                   echo "}<br>";
                   
                   echo "I2 = ".$estado_inicial2."<br>";
   
                   echo "F2 = {";
                     for($a=0;$a<count($F2);$a++){
                         echo $F2[$a].",";
                     }
                   echo "}";
                   echo "<br>";
   
   
   
   
   
               ?>
               
            
            </div>
          </div>
        </div>
        <div class="col-2"></div>

        
      </div>
    </div>

</body>

</html>