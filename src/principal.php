<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
        {
		header("location:index.php");
        }
        
        //Compruebo si el usuario ha hecho ya el formulario de su gnomo
        
        $conexion = mysql_connect("localhost","root","");
        mysql_select_db("gnomos", $conexion);
	$consulta = "SELECT usuario FROM gnomo WHERE usuario='" . $_SESSION["codUsuario"] . "';";
	if($resultado = mysql_query($consulta,$conexion) or die(mysql_error()))
	{
		if (!$fila = mysql_fetch_array($resultado))
		{
                    header("location:registroGnomo.php");
                }
        }
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css"  href="css/basico.css" />
		<script src="jQuery/development-bundle/jquery-1.7.2.js"></script>
		<script src="jQuery/jQuery.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.core.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.fold.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.slide.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.bounce.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.highlight.js"></script>
	</head>
	<body>
		<div id="page-wrapper">
			<div id="page">
				<div id="header-wrapper">
					<div class="header-left titulo">
						KOGOMELO TEAM
					</div>
				</div>
				<div id="main-wrapper">
					<div id="main">	
					</div>
				</div>
				<div id="footer-wrapper">
					<div id="footer">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>