<?php
	session_start();
	if(!isset($_SESSION["usuario"]))
        {
		header("location:index.php");
        }
        $num_imagenes=2; //Sustituir el numero de imagenes por una comprobación en la base de datos (COUNT DE LA FUTURA TABLA "IMAGENES_GNOMOS")!
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
                        var nombre = document.getElementById("nombre").value;
                        var sexo = document.getElementById("sexo").value;
                        var imagen = document.getElementById("imagenGnomo").src;
                        imagen = imagen.substring((imagen.length)-((sexo.length)+5),imagen.length);
                        var agricultor = document.getElementById("agricultor").value;
                        var minero = document.getElementById("minero").value;
                        var lenhador = document.getElementById("lenhador").value;
                        var investigador = document.getElementById("investigador").value;
                        var militar = document.getElementById("militar").value;
                        var construccion = document.getElementById("construccion").value;
                        var puntos = document.getElementById("puntosRestantes").value;
                        
                        $("#error").html("");
                        if(puntos > 0)
                        {
                            $("#error").append("*Todavía no ha usado el total de sus puntos");
                        }
                        var xmlhttp;
                        xmlhttp=new XMLHttpRequest();
                        xmlhttp.onreadystatechange=function()
                        {
                                if(xmlhttp.readyState == 4)
                                {
                                        //COMPROBAR SI EL RESULTADO ES "CORRECTO" Y SI LO ES MANDAR AL USUARIO A PRINCIPAL (FIN DE REGISTRO DE GNOMO)
                                        $("#error").append(xmlhttp.responseText);
                                }
                        };
                        xmlhttp.open("POST","guardarGnomo.php",true);
                        xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                        xmlhttp.send("&nombre="+nombre+"&sexo="+sexo+"&lenhador="+lenhador);
                    }
                    function restar(input)
                    {
                        var puntos = document.getElementById("puntosRestantes");
                        var puntosOcultos = document.getElementById("puntosOcultos");
                        
                        if(input.value > 1)
                        {
                            input.value = parseFloat(input.value) - 1;
                            puntos.value = parseFloat(puntos.value) + 1;
                            puntosOcultos.value = parseFloat(puntosOcultos.value) + 1;
                        }
                    }
                    function sumar(input)
                    {
                        var puntos = document.getElementById("puntosRestantes");
                        var puntosOcultos = document.getElementById("puntosOcultos");
                        
                        if(puntosOcultos.value > 0)
                        {
                            input.value = parseFloat(input.value) + 1;
                            puntos.value = parseFloat(puntos.value) - 1;
                            puntosOcultos.value = parseFloat(puntosOcultos.value) - 1;
                        }
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
                                                                Habilidad de leñador:
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
                                                        <!-- ¿¿AGREGAR UNAS PEQUEÑAS IMAGENES CON EL SPAN EXPLICATIVO DE CADA HABILIDAD?? -->
                                                        <div class="formulario-inputs">
                                                            <div class="derecha">
                                                                <span title="La habilidad de leñador realza la eficacia y la rapidez con la que tu gnomo podrá recoger madera en el bosque">
                                                                    <a href="#" onClick="restar(document.getElementById('lenhador'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="lenhador" /> 
                                                                    <a href="#" onClick="sumar(document.getElementById('lenhador'))">+</a>
                                                                </span>
                                                            </div>
                                                            <div class="derecha">
                                                                <span title="Tu habilidad de minero determinará la eficacia a la hora de recoger minerales o piedras de alguna excavación">
                                                                    <a href="#" onClick="restar(document.getElementById('minero'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="minero"/>
                                                                    <a href="#" onClick="sumar(document.getElementById('minero'))">+</a>
                                                                </span>
                                                            </div>
                                                            <div class="derecha">
                                                                <span title="La habilidad de agricultor proporciona una mayor destreza a la hora de realizar tareas en el huerto de seta">
                                                                    <a href="#" onClick="restar(document.getElementById('agricultor'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="agricultor"/>
                                                                    <a href="#" onClick="sumar(document.getElementById('agricultor'))">+</a>
                                                                </span>
                                                            </div>
                                                            <div class="derecha">
                                                                <span title="Un buen investigador podrá realizar descubrimientos en menos tiempo y con una mayor eficacia de lo habitual">
                                                                    <a href="#" onClick="restar(document.getElementById('investigador'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="investigador"/>
                                                                    <a href="#" onClick="sumar(document.getElementById('investigador'))">+</a>
                                                                </span>
                                                            </div>
                                                            <div class="derecha">
                                                                <span title="Aquellos gnomos con una superior habilidad militar podrán vencer todo lo que se les oponga">
                                                                    <a href="#" onClick="restar(document.getElementById('militar'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="militar"/>
                                                                    <a href="#" onClick="sumar(document.getElementById('militar'))">+</a>
                                                                </span>
                                                            </div>
                                                            <div class="derecha">
                                                                <span title="La habilidad de construcción determina la rapidez y eficiencia de un gnomo a la hora de realizar una tarea de construcción de un edificio">
                                                                    <a href="#" onClick="restar(document.getElementById('construccion'))">-</a>
                                                                    <input type="text" value="1" disabled="" id="construccion"/>
                                                                    <a href="#" onClick="sumar(document.getElementById('construccion'))">+</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div id="puntos">
                                                            Puntos restantes: <input name="puntosRestantes" id="puntosRestantes" value="5" disabled=""/>
                                                        </div>
                                                        <input type="hidden" value="5" id="puntosOcultos" />
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
                                            <div id="error">
                                                
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
