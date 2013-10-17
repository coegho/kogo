<?php
	session_start();
	if(isset($_POST["login"]) && isset($_POST["passwordlogin"]))
	{
		$usuario = $_POST["login"];
		$pass = sha1($_POST["passwordlogin"]);
		
		$conexion = mysql_connect("localhost","root");
		if(!$conexion)
		  die("No se ha podido conectar");
		
		$consulta = "SELECT nick FROM usuario WHERE nick = '".mysql_real_escape_string($usuario)."' AND pass = '".mysql_real_escape_string($pass)."'";
		
		mysql_select_db("gnomos",$conexion);
		$resultado = mysql_query($consulta) or die( "Error en $consulta: " . mysql_error() );
		mysql_close($conexion);
		
		
		if($fila = mysql_fetch_array($resultado))
		{
			session_start();
			$_SESSION["usuario"] = $fila["nick"];
			echo "correcto";
		}
		else
		{
			echo "* Login incorrecto";
			exit();
		}
	}
	else
	{
		header("location:index.php");
		exit();
	}
?>