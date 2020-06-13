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
        <a href="index.php?pagina=inicio" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <em class="material-icons"> account_circle </em> Nosotros </a>
        <a href="index.php?pagina=automatas" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <em class="material-icons">add_circle</em>  Ingresar Automatas </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <em class="material-icons">adjust</em>  AFD Equivalente </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <em class="material-icons">blur_circular</em>  Union Automatas </a>
        <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0">
          <em class="material-icons">border_style</em> Simplificación </a>


      </div>
    </div>
     <?php 
     $pagina='pagina';
			if(isset($_GET[$pagina])){
				if( $_GET[$pagina] == "inicio" ||
          $_GET[$pagina] == "automatas" || $_GET[$pagina] == "estados" || $_GET[$pagina] == "muestraestados" 
          || $_GET[$pagina] == "transiciones" || $_GET[$pagina] == "complemento" || $_GET[$pagina] == "union"
          || $_GET[$pagina] == "concatenacion" || $_GET[$pagina] == "transformacion" || $_GET[$pagina] == "simplificar"){
					include "vistas/".$_GET[$pagina].".php";
				}else{
					include "vistas/inicio.php";
				}
			}else{
				include "vistas/inicio.php";
			}
		 ?>

	</div>
 </body>
 </html>