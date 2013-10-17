<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
        {
		header("location:index.php");
        }
        $num_imagenes=2; //Sustituir el numero de imagenes por una comprobación en la base de datos!
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css"  href="css/basico.css" />
                <link rel="stylesheet" type="text/css"  href="css/style.css" />
                <link rel="stylesheet" type="text/css"  href="css/registroGnomo.css" />
		<script src="jQuery/development-bundle/jquery-1.7.2.js"></script>
		<script src="jQuery/jQuery.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.core.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.fold.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.slide.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.bounce.js"></script>
		<script src="jQuery/development-bundle/ui/jquery.effects.highlight.js"></script>
                <script>
                    function validar()
                    {
                        var sexo = document.getElementById("sexo").value;
                        //Dividirlo en imagen y sexo
                        var nombre = document.getElementById("nombre").value;
                        var descripcion = document.getElementById("descripcion").value;
                        
                    }
                    function cambiarSexo()
                    {
                        var imagen = document.getElementById("imagenGnomo");
                        var sexo = document.getElementById("sexo").value;
                        
                        if (sexo == "hombre")
                            sexo = "hombre";
                        else
                            sexo = "mujer"
                        
                        imagen.src = "images/gnomos/"+sexo+"1.png";
                        
                        //Dividir la variable en sexo y numero, poner el nombre al contrario y el número a 1, luego
                        //asignarle el css a la imagen.
                        
                    }
                    function derecha()
                    {
                        var imagen = document.getElementById("imagenGnomo").src;
                        
                        var numero = imagen.substring((imagen.length)-5,(imagen.length)-4)
                        numero = parseFloat(numero) + 1;
                        if(numero <= <?php echo $num_imagenes; ?>)
                        {
                            var direccion = imagen.substring(0,(imagen.length)-5);

                            document.getElementById("imagenGnomo").src = direccion+numero+".png";
                        }
                        
                        //Dividir la variable sexo en numero y sexo para cambiar correctamente el css con el número sumado en uno,
                        //antes de asignar el css comprobar que existe la imagen, si no existe, no cambiar la imagen.
                        
                    }
                    function izquierda()
                    {
                       
                        var imagen = document.getElementById("imagenGnomo").src;
                        
                        var numero = imagen.substring((imagen.length)-5,(imagen.length)-4)
                        numero = parseFloat(numero) -1;
                        if(numero > 0)
                        {
                            var direccion = imagen.substring(0,(imagen.length)-5);

                            document.getElementById("imagenGnomo").src = direccion+numero+".png";
                        }
                    }
                </script>
                    
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
                                            <div id="titulo">
                                                BIENVENIDO A BONETE
                                            </div>
                                            <div id="texto">
                                                Ahora es el momento de comenzar a elegir las características y apariencia de tu gnomo.
                                                ¡Elije bien, ya que durante la duración del juego no podrás cambiar de aspecto! Vas a sumergirte
                                                en un mundo lleno de vida, de sufrimiento, alegrías, setas y como no, muchos gnomos, por ello te
                                                pedimos que como buen jugador te metas en el papel de tu persognomo :)
                                            </div>
                                                <div id="habilidades">
                                                    <div class="tituloRegistro">
                                                        3. Elije bien las habilidades de tu gnomo
                                                    </div>
                                                    <div id="cajaHabilidades">
                                                        <div class="formulario-texto">
                                                            <div class="izquierda">
                                                                    Habilidad de lenhador:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Habilidad de minero:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Habilidad de agricultor:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Habilidad de investigador:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Habilidad militar:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Habilidad de construcción:
                                                            </div>
                                                        </div>
                                                        <div class="formulario-inputs">
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                            <div class="derecha">
                                                                <a href="#">-</a> <input type="text" value="1" disabled=""/> <a href="#">+</a>
                                                            </div>
                                                        </div>
                                                        <div id="puntos">
                                                            Puntos restantes: 5
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="informacion">
                                                    <div class="tituloRegistro">
                                                        1. Completa la información de tu gnomo
                                                    </div>
                                                    <div id="cajaInformacion">
                                                        <div class="formulario-texto">
                                                            <div class="izquierda">
                                                                    Nombre:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Sexo:
                                                            </div>
                                                            <div class="izquierda">
                                                                    Descripción:
                                                            </div>
                                                        </div>
                                                        <div class="formulario-inputs">
                                                            <div class="derecha">
                                                                    <input type="text" id="nombre" name="nombre" disabled="" value="<?php echo $_SESSION["usuario"];?>" />
                                                            </div>
                                                            <div class="derecha">
                                                                <select name="sexo" id="sexo" onChange="cambiarSexo()">
                                                                    <option value="hombre">Gnomo</option>
                                                                    <option value="mujer">Gnoma</option>
                                                                </select>
                                                            </div>
                                                            <div class="derecha">
                                                                    <textarea id="descripcion" name="descripcion">
                                                                    </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="imagen">
                                                    <div class="tituloRegistro">
                                                        2. Elije el aspecto de tu gnomo
                                                    </div>
                                                    <div id="cajaImagen">
                                                        <img src="images/gnomos/hombre1.png" id="imagenGnomo" />
                                                     
                                                        <div id="botonesSeleccion">
                                                            <a href="#" onclick="izquierda()">
                                                                <div id="izquierda">
                                                                </div>
                                                            </a>
                                                            <a href="#" onclick="derecha()">
                                                                <div id="derecha">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div id="validar">
                                                <a href="#" onClick="validar()">
                                                    <div>
                                                        Enviar
                                                    </div>
                                                </a>
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
