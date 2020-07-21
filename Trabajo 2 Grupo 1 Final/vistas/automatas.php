<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grafos T1</title>
</head>
<body>
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8"> <br> <br>
          <h3  class="display-4  text-center">Ingreso de Automatas</h3> <hr>
          <div class="container mx-auto">
            <div class="form-group px-5 shadow p-3 mb-5 bg-white rounded">

              <form action="index.php?pagina=estados" method="POST">
                <?php
                  echo 'Ingrese tipo de autómata:<br>
                        <select name="tipo_auto">    
                        <option value="2afd">2 AFD </option>    
                        <option value="1afnd">1 AFD y 1 AFND</option>    
                        <option value="2afnd">2 AFND</option></select>
                        <br><br>';    
                        
                  echo '<input type="text" size="25" name="cantidad_estados_1" placeholder="N°estados del 1° Automatas" required pattern="[0-9]{1,2}">
                        <input type="text" size="25" name="cantidad_estados_2" placeholder="N°estados del 2° Automatas" required pattern="[0-9]{1,2}">
                        <br>
                        ';

                  ?>
                <input type="submit" value="Next">
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