<?php
	session_start();
	if(isset($_SESSION["usuario"]))
        {
		session_destroy();
        }
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css"  href="css/basico.css" />
		<link rel="stylesheet" type="text/css"  href="css/style.css" />
		<script src="jQuery/development-bundle/jquery-1.7.2.js"></script>
		<script src="jQuery/jQuery.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.core.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.fold.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.slide.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.bounce.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.highlight.js"></script>
	</head>
	<body>
		<script>
			function loguear()
			{
				var login = document.getElementById("login").value;
				var passwordlogin = document.getElementById("passwordlogin").value;
				var errores = "";
				
				errores="";
				
				if( login != "" || passwordlogin != "")
				{
					if ( login == "" )
					{
						errores += "* Introduzca su nombre de usuario si desea entrar <br/><br/>";
					}
					if ( passwordlogin == "" )
					{
						errores += "* Introduzca su contrase�a si desea entrar <br/><br/>";
					}
					$("#erroreslogin").html(errores);
					$("#erroreslogin").show("slide");
				}
				if( errores == "" )
				{	
					var xmlhttp;
						xmlhttp=new XMLHttpRequest();
						xmlhttp.onreadystatechange=function()
						{
							if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
							{
								if(xmlhttp.responseText=="correcto")
									window.location.assign("principal.php");
								
																
								$("#erroreslogin").html(xmlhttp.responseText);
								$("#erroreslogin").show("slide");
							}
							
						}
						xmlhttp.open("POST","login.php",true);
						xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
						xmlhttp.send("&login="+login+"&passwordlogin="+passwordlogin);
						
						/*ERRORES DE LOGIN EN AJAX!! PARA QUE NO RECARGUE TODA LA P�GINA*/
				}
			}
			
			function aparecerLogin()
			{
				$("#botonaparecerlogin").hide("fold");
				$("#menulogin").show("slide");
			}
			
			function validar()
			{
				var nombre = document.getElementById("nombre").value;
				var password = document.getElementById("password").value;
				var repeatpassword = document.getElementById("repeat-password").value;
				var email = document.getElementById("email").value;
				var errores = "";
				var erEmail = /[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|es|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)\b/;
				
				errores = "";
				$(".errores *").html("");
				
				if( nombre != "" || password != "" || repeatpassword != "" || email != "" )
				{
					//Comprobaci�n nombre
					//TODO: Mejores comprobaciones de nombre (caracteres especiales)
					
					if( nombre == "" )
					{
						errores += "* Debe proporcionar un nombre de usuario <br/><br/>";
						$("#error-nombre").html("*");
					}
					else
					{
						if( nombre != "" && nombre.length < 6)
						{
							errores += "* El nombre de usuario debe tener como m�nimo 6 caracteres <br/><br/>";
							$("#error-nombre").html("*");
						}
					}
					
					//Comprobaci�n contrase�a
					
					if( password == "")
					{
						errores += "* Debe proporcionar una contrase�a <br/><br/>";
						$("#error-password").html("*");
					}
					else
					{
						if( repeatpassword == "")
						{
							errores += "* Debe repetir la contrase�a <br/><br/>";
							$("#error-repeat-password").html("*");
						}
						else
						{
							if( repeatpassword != password )
							{
								errores += "* Las contrase�as deben coincidir <br/><br/>";
							}
							if( password != "" && password.length < 8 )
							{
								errores += "* La contrase�a debe tener como m�nimo 8 caracteres <br/><br/>";
								$("#error-password").html("*");
							}
						}
					}
					
					//Comprobaci�n email
					
					if( email == "")
					{
						errores += "* Debe proporcionar un email <br/><br/>";
						$("#error-email").html("*");
					}
					else
					{
						if(!erEmail.test(email))
						{
							errores += "* El email proporcionado no es un email v�lido <br/><br/>";
							$("#error-email").html("*");
						}
					}
					
					//Comprobaci�n de si el nombre y el mail ya est�n registrados
					
					if(errores=="")
					{
						var xmlhttp;
						xmlhttp=new XMLHttpRequest();
						xmlhttp.onreadystatechange=function()
						{
							if(xmlhttp.readyState == 4)
							{
								if(xmlhttp.responseText=="correcto")
									window.location.assign("principal.php");
								
								$("#errores").html(xmlhttp.responseText);
							}
						}
						xmlhttp.open("POST","comprobarNombre.php",true);
						xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
						xmlhttp.send("&nombre="+nombre+"&password="+password+"&email="+email);
					}
					$("#errores").html(errores);
					$("#errores").show("slide");
				}
				
			}
			$("#errores").hide("slide");
		</script>
		<div id="page-wrapper">
			<div id="page">
				<div id="header-wrapper">
					<div class="header-left titulo">
						KOGOMELO TEAM
					</div>
					<a href="#" onClick="aparecerLogin()">
						<div class="header-right menu-header" id="botonaparecerlogin">
								Login
						</div>
					</a>
					<form name="formLogin" action="login.php" method="post">
						<div class="header-right" id="menulogin" onkeypress="if ( event.keyCode == 13 ) loguear();">
							<div class="formulario-texto">
								<div class="izquierda">
									Login:
								</div>
								<div class="izquierda">
									Password:
								</div>
							</div>
							<div class="formulario-inputs">
								<div class="derecha">
									<input type="text" name="login" id="login" />
								</div>
								<div class="derecha">
									<input type="password" name="passwordlogin" id="passwordlogin" />
								</div>
							</div>
							<a href="#" onClick="loguear()">
								<div class="header-right menu-header" id="botonlogin">
										<text>Login</text>
								</div>
							</a>
							<div class="mensaje-error" id="erroreslogin">
							</div>
						</div>
					</form>
				</div>
				<div id="main-wrapper">
					<div id="main">
						<div id="titulo">
							Registro en Kogomelo
						</div>

						<div id="registro">
							<div class="formulario-texto">
								<div class="izquierda">
									Nombre de usuario:
								</div>
								<div class="izquierda">
									Contraseña:
								</div>
								<div class="izquierda">
									Repita contraseña:
								</div>
								<div class="izquierda">
									Email:
								</div>
							</div>
							<div class="formulario-inputs" onkeypress="if (event.keyCode == 13) validar();">
								<div class="derecha">
									<input type="text"  name="nombre" id="nombre"/>
								</div>
								
								<div class="derecha">
									<input type="password"  name="password" id="password"/>
								</div>
								
								<div class="derecha">
									<input type="password" name="repeat-password" id="repeat-password"/>
								</div>
								
								<div class="derecha">
									<input type="text" name="email" id="email"/>
								</div>
							</div>
							<div class="errores">
								<div class="error" id="error-nombre">
									
								</div>
								<div class="error" id="error-password">
									
								</div>
								<div class="error" id="error-repeat-password">
									
								</div>
								<div class="error" id="error-email">
									
								</div>
							</div>
							<div class="mensaje-error" id="errores">
							</div>
							<div class="submit">
								<a href="#" onClick="validar()">
									<div id="boton-submit">
											<text>Enviar</text>
									</div>
								</a>
							</div>
						</div>
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