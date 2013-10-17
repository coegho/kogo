CREATE TABLE usuario
(
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
mail varchar(50),
nick varchar(50),
es_mod tinyint(1),
ban tinyint(1)
);

CREATE TABLE bloquea
(
usuarioBase int unsigned,
usuarioBloqueado int unsigned,
CONSTRAINT pk_bloquea PRIMARY KEY (usuarioBase,usuarioBloqueado)
);

CREATE TABLE gnomo
(
usuario int unsigned,
nombre varchar(50),
sexo enum('H','M'),
edad tinyint unsigned,
descripcion varchar(500),
habLenhador tinyint unsigned,
habMinero tinyint unsigned,
habAgricultor tinyint unsigned,
habInvestigador tinyint unsigned,
habMilitar tinyint unsigned,
habConstructor tinyint unsigned,
nivelSeta tinyint unsigned,
nivelLab tinyint unsigned,
nivelDefensas tinyint unsigned,
madera int unsigned,
comida int unsigned,
agua int,
zonaX tinyint unsigned,
zonaY tinyint unsigned,
poblado int unsigned,
rango varchar(50),
CONSTRAINT pk_gnomo PRIMARY KEY (usuario)
);

CREATE TABLE amigo
(
gnomoBase int unsigned,
gnomoAmigo int unsigned,
CONSTRAINT pk_amigo PRIMARY KEY (gnomoBase,gnomoAmigo)
);

CREATE TABLE conoce_gnomo
(
gnomo int unsigned,
tecnologia int unsigned,
nivel tinyint unsigned,
CONSTRAINT pk_conoce_gnomo PRIMARY KEY (gnomo,tecnologia)
);

CREATE TABLE tecnologia
(
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
nombre varchar(50) UNIQUE,
descripcion varchar(500),
tiempoBase int unsigned
);

CREATE TABLE zona
(
x tinyint unsigned,
y tinyint unsigned,
tipo enum('bosque','llanura','montanha'),
CONSTRAINT pk_zona PRIMARY KEY (x,y)
);

CREATE TABLE poblado
(
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
fundador int unsigned,
nombre varchar(50) UNIQUE,
fechaFundacion date,
nivelAyuntamiento tinyint unsigned,
nivelLab tinyint unsigned,
nivelAserradero tinyint unsigned,
nivelMina tinyint unsigned,
nivelMuralla tinyint unsigned,
nivelHuerto tinyint unsigned
);

CREATE TABLE guerra
(
poblado1 int unsigned,
poblado2 int unsigned,
activa tinyint(1),
victorias1 tinyint unsigned,
victorias2 tinyint unsigned,
CONSTRAINT pk_guerra PRIMARY KEY (poblado1,poblado2)
);

CREATE TABLE conoce_poblado
(
poblado int unsigned,
granTecnologia int unsigned,
nivel tinyint unsigned,
CONSTRAINT pk_conoce_poblado PRIMARY KEY (poblado,granTecnologia)
);

CREATE TABLE rango
(
poblado int unsigned,
nombreRango varchar(50),
p_invitar tinyint(1),
p_expulsar tinyint(1),
p_proyecto tinyint(1),
p_diplomacia tinyint(1),
p_permisos tinyint(1),
p_comercio tinyint(1),
p_oficios tinyint(1),
CONSTRAINT pk_rango PRIMARY KEY (poblado,nombreRango)
);

CREATE TABLE gran_tecnologia
(
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
nombre varchar(50) UNIQUE,
descripcion varchar(500),
tiempoBase int unsigned
);

CREATE TABLE oferta
(
poblado int unsigned,
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
materialOfrece enum('piedra','madera','comida','oro','setas'),
cantOfrece int unsigned,
materialPide enum('piedra','madera','comida','oro','setas'),
cantPide int unsigned
);

CREATE TABLE tarea
(
gnomo int unsigned,
tipo enum('patrulla','hurto','investigacion','recoleccion','recursos','enProyecto'),
horaIni datetime,
horaFin datetime,
CONSTRAINT pk_tarea PRIMARY KEY (gnomo)
);

CREATE TABLE tarea_patrulla
(
tarea int unsigned,
objetivo int unsigned,
CONSTRAINT pk_patrulla PRIMARY KEY (tarea)
);

CREATE TABLE tarea_hurto
(
tarea int unsigned,
objetivo int unsigned,
CONSTRAINT pk_hurto PRIMARY KEY (tarea)
);

CREATE TABLE tarea_investigacion
(
tarea int unsigned,
tecnologia int unsigned,
CONSTRAINT pk_investigacion PRIMARY KEY (tarea)
);

CREATE TABLE tarea_recoleccion
(
tarea int unsigned,
zonaX tinyint unsigned,
zonaY tinyint unsigned,
recurso enum('piedra','madera','comida','oro','setas'),
CONSTRAINT pk_recoleccion PRIMARY KEY (tarea)
);

CREATE TABLE tarea_recursos
(
tarea int unsigned,
recurso enum('piedra','madera','comida','oro','setas'),
CONSTRAINT pk_recursos PRIMARY KEY (tarea)
);

CREATE TABLE en_proyecto
(
tarea int unsigned,
proyecto int unsigned,
CONSTRAINT pk_proyecto PRIMARY KEY (tarea)
);

CREATE TABLE proyecto
(
poblado int unsigned,
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
tipo enum('construccion','fortificacion','investigacion'),
fechaIni datetime,
tiempoInv int unsigned,
tiempoNes int unsigned
);

CREATE TABLE proy_construccion
(
codProyecto int unsigned,
edificio int unsigned,
CONSTRAINT pk_construccion PRIMARY KEY (codProyecto)
);

CREATE TABLE proy_fortificacion
(
codProyecto int unsigned,
defensa int unsigned,
CONSTRAINT pk_fortificacion PRIMARY KEY (codProyecto)
);

CREATE TABLE proy_investigacion
(
codProyecto int unsigned,
granTecnologia int unsigned,
CONSTRAINT pk_fortificacion PRIMARY KEY (codProyecto)
);

CREATE TABLE llamada_a_las_armas
(
poblado int unsigned,
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
fechaIni datetime,
fechaLimite datetime,
pobladoEnemigo int unsigned
);

CREATE TABLE accion_comercial
(
poblado int unsigned,
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
fechaLimite datetime,
pobladoDestino int unsigned
);

CREATE TABLE tipo_defensa
(
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
nombre varchar(50),
objetivo int unsigned,
costeMadera int unsigned,
costePiedra int unsigned,
tiempo datetime
);

CREATE TABLE defensa
(
poblado int unsigned,
tipoDefensa int unsigned,
cod int unsigned PRIMARY KEY AUTO_INCREMENT,
nivel int unsigned
);

ALTER TABLE bloquea
ADD CONSTRAINT fk_bloquea_usuario_usuarioBase FOREIGN KEY (usuarioBase) REFERENCES usuario(cod),
ADD CONSTRAINT fk_bloquea_usuario_usuarioBloqueado FOREIGN KEY (usuarioBloqueado) REFERENCES usuario(cod);

ALTER TABLE gnomo
ADD CONSTRAINT fk_gnomo_usuario_usuario FOREIGN KEY (usuario) REFERENCES usuario(cod),
ADD CONSTRAINT fk_gnomo_zona_X_Y FOREIGN KEY (zonaX,zonaY) REFERENCES zona(x,y),
ADD CONSTRAINT fk_gnomo_rango_rango FOREIGN KEY (poblado,rango) REFERENCES rango(poblado,nombreRango);


ALTER TABLE amigo
add constraint fk_amigo_gnomo1 FOREIGN KEY (gnomoBase) REFERENCES gnomo(usuario),
add constraint fk_amigo_gnomo2 FOREIGN KEY (gnomoAmigo) REFERENCES gnomo(usuario);

ALTER TABLE conoce_gnomo
add constraint fk_conoce_gnomo_gnomo FOREIGN KEY (gnomo) REFERENCES gnomo(usuario),
add constraint fk_conoce_gnomo_tecnologia FOREIGN KEY (tecnologia) REFERENCES tecnologia(cod);

ALTER TABLE poblado
add constraint fk_poblado_fundador FOREIGN KEY (fundador) REFERENCES gnomo(usuario);

ALTER TABLE guerra
add constraint fk_guerra_poblado1 FOREIGN KEY (poblado1) REFERENCES poblado(cod),
add constraint fk_guerra_poblado2 FOREIGN KEY (poblado2) REFERENCES poblado(cod);

ALTER TABLE conoce_poblado
add constraint fk_conoce_poblado_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod),
add constraint fk_conoce_poblado_gran_tecnologia FOREIGN KEY (granTecnologia) REFERENCES gran_tecnologia(cod);

ALTER TABLE rango
add constraint fk_rango_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod);

ALTER TABLE oferta
add constraint fk_oferta_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod);

ALTER TABLE tarea
add constraint fk_tarea_gnomo FOREIGN KEY (gnomo) REFERENCES gnomo(usuario);

ALTER TABLE tarea_patrulla
add constraint fk_patrulla_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo),
add constraint fk_patrulla_objetivo FOREIGN KEY (objetivo) REFERENCES gnomo(usuario);

ALTER TABLE tarea_hurto
add constraint fk_hurto_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo),
add constraint fk_hurto_objetivo FOREIGN KEY (objetivo) REFERENCES gnomo(usuario);

ALTER TABLE tarea_investigacion
add constraint fk_investigacion_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo),
add constraint fk_investigacion_tecnologia FOREIGN KEY (tecnologia) REFERENCES tecnologia(cod);

ALTER TABLE tarea_recoleccion
add constraint fk_recoleccion_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo),
add constraint fk_recoleccion_zona FOREIGN KEY (zonaX,zonaY) REFERENCES zona(X,Y);

ALTER TABLE tarea_recursos
add constraint fk_recursos_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo);

ALTER TABLE en_proyecto
add constraint fk_en_proyecto_tarea FOREIGN KEY (tarea) REFERENCES tarea(gnomo),
add constraint fk_en_proyecto_proyecto FOREIGN KEY (proyecto) REFERENCES proyecto(cod);

ALTER TABLE proyecto
add constraint fk_proyecto_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod);

ALTER TABLE proy_construccion
add constraint fk_construccion_proyecto FOREIGN KEY (codProyecto) REFERENCES proyecto(cod);

ALTER TABLE proy_fortificacion
add constraint fk_fortificacion_proyecto FOREIGN KEY (codProyecto) REFERENCES proyecto(cod),
add constraint fk_fortificacion_defensa FOREIGN KEY (codProyecto) REFERENCES proyecto(cod);

ALTER TABLE proy_investigacion
add constraint fk_investigacion_proyecto FOREIGN KEY (codProyecto) REFERENCES proyecto(cod),
add constraint fk_investigacion_gran_tecnologia FOREIGN KEY (granTecnologia) REFERENCES gran_tecnologia(cod);

ALTER TABLE llamada_a_las_armas
add constraint fk_llamada_a_las_armas_poblado_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod),
add constraint fk_llamada_a_las_armas_poblado_pobladoEnemigo FOREIGN KEY (pobladoEnemigo) REFERENCES poblado(cod);

ALTER TABLE accion_comercial
add constraint fk_accion_comercial_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod),
add constraint fk_accion_comercial_pobladoDestino FOREIGN KEY (pobladoDestino) REFERENCES poblado(cod);

ALTER TABLE defensa
add constraint fk_defensa_poblado FOREIGN KEY (poblado) REFERENCES poblado(cod),
add constraint fk_defensa_tipo_defensa FOREIGN KEY (tipoDefensa) REFERENCES tipo_defensa(cod);