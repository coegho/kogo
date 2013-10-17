<?php
	$conexion = mysql_connect("localhost","root","");
        mysql_select_db("gnomos", $conexion);
	$consulta = "SELECT nick FROM usuario WHERE nick='" . mysql_real_escape_string($_POST["nombre"]) . "';";
	if($resultado = mysql_query($consulta,$conexion) or die(mysql_error()))
	{
		if ($fila = mysql_fetch_array($resultado))
		{
			echo "*El nombre de usuario ya se encuentra registrado <br/><br/>";
			return;
		}
		
		$consulta = "SELECT mail FROM usuario WHERE mail='" . mysql_real_escape_string($_POST["email"]) . "';";
		if($resultado = mysql_query($consulta,$conexion) or die(mysql_error()))
		{
			if ($fila = mysql_fetch_array($resultado))
			{
				echo "*El email proporcionado ya se encuentra registrado <br/><br/>";
				return;
			}
			else
			{
                                $consulta = "INSERT INTO usuario (mail,nick,pass) VALUES ('". mysql_real_escape_string($_POST["email"]) ."','" . mysql_real_escape_string($_POST["nombre"]) . "','" . sha1(mysql_real_escape_string($_POST["password"])) . "');";
				if($resultado = mysql_query($consulta,$conexion) or die(mysql_error()))
				{
					session_start();
					$_SESSION["usuario"] = $_POST["nombre"];
                                        $consulta = "SELECT cod FROM usuario WHERE nick='". mysql_real_escape_string($_POST["nombre"]) ."'" ;
                                        if($resultado = mysql_query($consulta,$conexion) or die(mysql_error()))
                                        {
                                            $_SESSION["codUsuario"] = $fila["cod"];
                                            echo "correcto";
                                        }
				}
			}
		}
	}