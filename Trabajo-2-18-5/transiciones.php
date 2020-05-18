<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Diego Velázquez">
  <meta name="description" content="Tablero con Bootstrap 4 - Webook">

  <title>Grafos T1</title>

  <!-- Bootstrap Css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Hoja de estilos -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Muli:400,700&display=swap" rel="stylesheet">

  <!-- Ionic icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>





<body>

  <div class="d-flex" id="content-wrapper">


    <!-- Sidebar -->
    <div id="sidebar-container" class="bg-light border-right">
      <div class="logo">
        <h2 class="font-weight-bold mb-0" style="text-align: center;">Grafos</h2>
      </div>
      <div class="menu list-group-flush">
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons"> account_circle </i> Nosotros </a>
        <a href="cantidadestados.html" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">add_circle</i>  Ingresar Automatas </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">adjust</i>  AFD Equivalente </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">blur_circular</i>  Union Automatas </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <i class="material-icons">border_style</i> Simplificación </a>


      </div>
    </div>
    <!-- Fin sidebar -->





    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Autómatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">
            
            <form action="muestraestados.php" method="POST">
            <?php

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
                    if(isset($_POST['final_'.$a])){
                      array_push($F1,$_POST['final_'.$a]);
                    }
               
                }
                
                //pushean los nombres a los arrays del segundo automata
                for($a=0;$a<$cant_array2;$a++){
                    array_push($K2,$_POST['estado_'.$a]);
                    if(isset($_POST['final2_'.$a])){
                      array_push($F2,$_POST['final2_'.$a]);
                    }
                    
                }
             
                
                

                $pal=$_POST['lenguaje_1'];
                $pal2=$_POST['lenguaje_2'];
                $Numero_transiciones_1=strlen($pal);
                $Numero_transiciones_2=strlen($pal2);


                echo 'Transiciones del 1° Autómata'.'<br>
                    Q-------------> σ ------>δ(Q,σ) ///// Ingrese "qX"; X:N° de estado al que se dirige<br><br>';
                $cont=0;
                for($a=0; $a < $cant_array; $a++){
                    for($b=0; $b <$Numero_transiciones_1; $b++){
        
                        echo $K1[$a].'  = q'.$a.'-----> '.$pal[$b].' '.'------> δ: '.'<input type="text" size="2" name="t_'.$cont.'" required><br>';
                        $cont++;
                    }
                    
                }

                echo 'Transiciones del 2° Autómata'.'<br>
                    Q-------------> σ ------>δ(Q,σ) <br><br>';
                $cont2=0;
                for($a=0; $a < $cant_array2; $a++){
                    for($b=0; $b <$Numero_transiciones_2; $b++){
        
                        echo $K2[$a].'  = q'.$a.'-----> '.$pal2[$b].' '.'------> δ: '.'<input type="text" size="2" name="t2_'.$cont2.'" required><br>';
                        $cont2++;
                    }
                    
                }
            

                //faltan los hidden de los elemtnos de la quintupla:V*****
              ?>
              <input type="submit" value="Next">
              
               <?php

                

                for($a=0;$a<$cant_array;$a++)
                {
                  echo '<input type="hidden" name="estado'.$a.'" value="'.$K1[$a].'" >';
                }
                for($a=0;$a<$cant_array2;$a++)
                {
                  echo '<input type="hidden" name="estado_'.$a.'" value="'.$K2[$a].'" >';
                }

                for($a=0;$a<count($F1);$a++)
                {
                  echo '<input type="hidden" name="fin_'.$a.'" value="'.$F1[$a].'" >';
                }

                for($a=0;$a<count($F2);$a++)
                {
                  echo '<input type="hidden" name="fin2_'.$a.'" value="'.$F2[$a].'" >';
                }
               


                

              ?> 


               <input type="hidden" name='cantida_estados_1' value="<?php echo $cant_array?>">
               <input type="hidden" name='cantida_estados_2' value="<?php echo $cant_array2?>">

               <input type="hidden" name='inicial_1' value="<?php echo $estado_inicial?>">
               <input type="hidden" name='inicial_2' value="<?php echo $estado_inicial2?>">

               <input type="hidden" name="cantf_1" value="<?php echo count($F1)?>">
               <input type="hidden" name="c" value="<?php echo count($F2)?>">
               <input type="hidden" name="lenguaj_1" value="<?php echo $pal ?>" >  
               <input type="hidden" name="lenguaj_2" value="<?php echo $pal2 ?>">


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