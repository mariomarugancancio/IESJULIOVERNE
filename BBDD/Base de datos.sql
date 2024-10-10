DROP DATABASE IF EXISTS IESJULIOVERNE;
CREATE DATABASE IESJULIOVERNE;
USE IESJULIOVERNE;

-- tabla departamento
CREATE TABLE Departamentos (
codigo SMALLINT PRIMARY KEY AUTO_INCREMENT,
referencia VARCHAR(5),
nombre VARCHAR(100)  NOT NULL,
jefe VARCHAR(50),
ubicacion VARCHAR(5)
);



-- valores de las tabla departamentos
INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion) VALUES
('fra', 'DPTO Francés', 'x', 'xxx'),
('ing', 'DPTO Inglés', 'x', 'xxx'),
('tec', 'DPTO Tecnología', 'x', 'xxx'),
('rel', 'DPTO Religión', 'x', 'xxx'),
('mat', 'DPTO Matemáticas', 'x', 'xxx'),
('ef', 'DPTO Educación física', 'x', 'xxx'),
('dib', 'DPTO Dibujo', 'x', 'xxx'),
('inf', 'DPTO Informática', 'x', 'xxx'),
('len', 'DPTO Lengua', 'x', 'xxx'),
('fil', 'DPTO Filosofía', 'x', 'xxx'),
('geh', 'DPTO Geografía e historia', 'x', 'xxx'),
('ori', 'DPTO Orientación', 'x', 'xxx'),
('fyq', 'DPTO Física y química', 'x', 'xxx'),
('mus', 'DPTO Música', 'x', 'xxx'),
('bio', 'DPTO Biología y geología', 'x', 'xxx'),
('gri', 'DPTO Griego', 'x', 'xxx'),
('eco', 'DPTO Economía', 'x', 'xxx'),
('iesjv', 'Centro', 'x', 'xxx');
('fol', 'DPTO FOL', 'x', 'xxx');

-- tabla usuarios
CREATE TABLE Usuarios (
cod_usuario INTEGER PRIMARY KEY AUTO_INCREMENT,
dni VARCHAR(9) UNIQUE NOT NULL,
nombre VARCHAR(50) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
clave VARCHAR(255) NOT NULL,
rol VARCHAR(2) NOT NULL,
cod_delphos INTEGER,
validar VARCHAR(2) NOT NULL,
departamento SMALLINT,
tutor_grupo varchar(20),
FOREIGN KEY (departamento) REFERENCES Departamentos(codigo) ON DELETE SET NULL
);

-- tabla tareas
CREATE TABLE Tareas (
cod_tarea INTEGER PRIMARY KEY AUTO_INCREMENT,
estado VARCHAR(50) NOT NULL,
nivel_tarea VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
comentario VARCHAR(255),
imagen LONGBLOB,
localizacion VARCHAR(60) NOT NULL,
fecha_inicio DATE NOT NULL,
fecha_fin DATE,
cod_usuario_gestion INTEGER,
cod_usuario_crea INTEGER,
tipo_incidencia VARCHAR(50),
FOREIGN KEY (cod_usuario_gestion) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (cod_usuario_crea) REFERENCES Usuarios(cod_usuario)
);

-- tabla tareas Finalizadas
CREATE TABLE TareasFinalizadas (
cod_tarea INTEGER PRIMARY KEY,
estado VARCHAR(50) NOT NULL,
nivel_tarea VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
comentario VARCHAR(255),
imagen LONGBLOB,
localizacion VARCHAR(60) NOT NULL,
fecha_inicio DATE NOT NULL,
fecha_fin DATE,
cod_usuario_gestion INTEGER,
cod_usuario_crea INTEGER,
tipo_incidencia VARCHAR(50),
FOREIGN KEY (cod_usuario_gestion) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (cod_usuario_crea) REFERENCES Usuarios(cod_usuario)
);
-- tabla articulo
CREATE TABLE Articulos (
codigo INTEGER PRIMARY KEY AUTO_INCREMENT,
fecha_alta DATE,
num_serie VARCHAR(20),
nombre VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
unidades INT(5) NOT NULL,
localizacion VARCHAR(50) NOT NULL,
procedencia_entrada VARCHAR(200),
motivo_baja VARCHAR(200),
fecha_baja DATE,
ruta_imagen LONGBLOB
);

-- tabla articulo
CREATE TABLE Fungibles (
codigo INTEGER PRIMARY KEY,
pedir VARCHAR(2),
FOREIGN KEY (codigo) REFERENCES Articulos(codigo)
);

-- tabla articulo
CREATE TABLE Nofungibles (
codigo INTEGER PRIMARY KEY,
fecha INT(4),
FOREIGN KEY (codigo) REFERENCES Articulos(codigo)
);

-- tabla tiene
CREATE TABLE Tiene (
cod_articulo INTEGER,
cod_departamento SMALLINT,
PRIMARY KEY (cod_articulo, cod_departamento),
FOREIGN KEY (cod_articulo) REFERENCES Articulos(codigo),
FOREIGN KEY (cod_departamento) REFERENCES Departamentos(codigo)
);

-- tabla periodos
CREATE TABLE Periodos (
cod_periodo INTEGER PRIMARY KEY,
inicio time NOT NULL,
fin time NOT NULL

);


-- valores de las tabla periodos
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(1, '8:30', '9:25');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(2, '9:25', '10:20');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(3, '10:20', '11:15');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(4, '11:45', '12:40');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(5, '12:40', '13:35');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(6, '13:35', '14:30');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(7, '15:15', '16:10');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(8, '16:10', '17:05');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(9, '17:05', '18:00');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(10, '18:30', '19:25');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(11, '19:25', '20:20');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(12, '20:20', '21:15');


-- tabla guardias
CREATE TABLE Guardias (
cod_guardias INTEGER PRIMARY KEY AUTO_INCREMENT,
fecha DATE NOT NULL,
observaciones VARCHAR(255),
periodo INTEGER(2) NOT NULL,
cod_usuario INTEGER NOT NULL,
FOREIGN KEY (cod_usuario) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (periodo) REFERENCES Periodos (cod_periodo),
UNIQUE(fecha, periodo, cod_usuario)
);

-- tabla horarios
CREATE TABLE Horarios(
cod_horario INTEGER PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50),
apellidos VARCHAR(50),
dia VARCHAR(15),
inicio time,
fin time,
clase VARCHAR(100),
cod_usuario INTEGER,
cod_delphos INTEGER,
FOREIGN KEY (cod_usuario) REFERENCES Usuarios(cod_usuario)
);




CREATE TABLE Reservas(
  id INT PRIMARY KEY AUTO_INCREMENT,
  autor INTEGER NOT NULL,
  aula VARCHAR(150) NOT NULL,
  fecha DATE NOT NULL, inicio TIME NOT NULL, fin TIME NOT NULL,
  comentario VARCHAR(255),
  FOREIGN KEY (autor) REFERENCES usuarios(cod_usuario),
  UNIQUE uniqueCombination (aula, fecha, inicio, fin)
);


CREATE TABLE Cursos (
  grupo varchar(20) NOT NULL PRIMARY KEY,
  aula varchar(20),
  curso VARCHAR(30) NOT NULL
);

INSERT INTO Cursos (grupo, aula, curso) VALUES
('B1A', NULL, '1BTOCIENCIAS'),
('B1B', NULL, '1BTOCIENCIAS'),
('B1C', NULL, '1BTOHUMCSO'),
('B1D', NULL, '1BTOHUMCSO'),
('B2A', NULL, '2BTOCIENCIAS'),
('B2B', NULL, '2BTOHUMCSO'),
('B2C', NULL, '2BTOHUMCSO'),
('B2D', NULL, '2BTOHUMCSO'),
('CFGB1', NULL, 'CFGB1'),
('CFGB2', NULL, 'CFGB1'),
('DAM1', NULL, 'DAM1'),
('DAM2', NULL, 'DAM2'),
('DAW1', NULL, 'DAW1'),
('DAW2', NULL, 'DAW2'),
('DIV3A', NULL, '3ESO'),
('DIV3B', NULL, '3ESO'),
('DIV4E', NULL, '4ESO'),
('DIV4F', NULL, '4ESO'),
('E1A', NULL, '1ESO'),
('E1B', NULL, '1ESO'),
('E1C', NULL, '1ESO'),
('E1D', NULL, '1ESO'),
('E1E', NULL, '1ESO'),
('E1F', NULL, '1ESO'),
('E1G', NULL, '1ESO'),
('E2A', NULL, '2ESO'),
('E2B', NULL, '2ESO'),
('E2C', NULL, '2ESO'),
('E2D', NULL, '2ESO'),
('E2E', NULL, '2ESO'),
('E2F', NULL, '2ESO'),
('E2G', NULL, '2ESO'),
('E3A', NULL, '3ESO'),
('E3B', NULL, '3ESO'),
('E3C', NULL, '3ESO'),
('E3D', NULL, '3ESO'),
('E3E', NULL, '3ESO'),
('E3F', NULL, '3ESO'),
('E3G', NULL, '3ESO'),
('E4A', NULL, '4ESO'),
('E4B', NULL, '4ESO'),
('E4C', NULL, '4ESO'),
('E4D', NULL, '4ESO'),
('E4E', NULL, '4ESO'),
('E4F', NULL, '4ESO'),
('PEFP1', NULL, 'PEFP1'),
('PEFP2', NULL, 'PEFP2'),
('SMR1', NULL, 'SMR1'),
('SMR2', NULL, 'SMR2');


CREATE TABLE Alumnos (
  matricula varchar(20) PRIMARY KEY,
  nombre varchar(30) NOT NULL,
  apellidos varchar(50),
  grupo varchar(20),
  saldo DECIMAL(10,2) DEFAULT 0,
  FOREIGN KEY (grupo) REFERENCES Cursos(grupo)
);

CREATE TABLE Transacciones (
  matricula varchar(20),
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fotocopias INTEGER,
  saldoAntiguo  DECIMAL(10,2)  NOT NULL,
  saldoNuevo  DECIMAL(10,2)  NOT NULL,
  PRIMARY KEY (matricula, fecha),
  FOREIGN KEY (matricula) REFERENCES Alumnos(matricula)
);

CREATE TABLE Fotocopias (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tipo VARCHAR(2) NOT NULL,
  precio DECIMAL(10,2) NOT NULL
);

INSERT INTO Fotocopias(tipo, precio) VALUES ('BN', 0.1);

CREATE TABLE Asignaturas(
	cod_asignatura INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    horas INT NOT NULL,
    curso VARCHAR(30) NOT NULL,
    tipo VARCHAR(40)
);
INSERT INTO Asignaturas (nombre, horas, curso, tipo) VALUES
('Jefatura', 0, 'Jefatura', null),
('Lengua Castellana y Literatura', 5, '1ESO', 'comunes'),
('Matemáticas', 4, '1ESO', 'comunes'),
('Lengua Extranjera (Inglés)', 4, '1ESO', 'comunes'),
('Geografía e Historia', 4, '1ESO', 'comunes'),
('Biología y Geología', 3, '1ESO', 'comunes'),
('Educación Física', 2, '1ESO', 'comunes'),
('Música', 2, '1ESO', 'comunes'),
('Tecnología y Digitalización', 2, '1ESO', 'comunes'),
('Religión', 1, '1ESO', null),
('Francés (obligatoria para biligües)', 2, '1ESO', 'optativas'),
('Taller de emprendimiento y finanzas personales', 2, '1ESO', 'optativas'),
('Proyecto de Artes Plásticas y Visuales', 2, '1ESO', 'optativas'),
('Lengua Castellana y Literatura', 4, '2ESO', 'comunes'),
('Matemáticas', 4, '2ESO', 'comunes'),
('Lengua Extranjera (Inglés)', 4, '2ESO', 'comunes'),
('Geografía e Historia', 3, '2ESO', 'comunes'),
('Física y Química', 3, '2ESO', 'comunes'),
('Educación Física', 2, '2ESO', 'comunes'),
('Música', 2, '2ESO', 'comunes'),
('Educación Plástica y Audiovisual', 2, '2ESO', 'comunes'),
('Educación en Valores Cívicos y Éticos', 2, '2ESO', 'comunes'),
('Religión', 1, '2ESO', null),
('2 Lengua extranjera: Francés', 2, '2ESO', 'optativas'),
('Cultura Clásica', 2, '2ESO', 'optativas'),
('Desarrollo Digital', 2, '2ESO', 'optativas'),
('Lengua Castellana y Literatura', 4, '3ESO', 'comunes'),
('Matemáticas', 4, '3ESO', 'comunes'),
('Lengua Extranjera (Inglés)', 3, '3ESO', 'comunes'),
('Geografía e Historia', 3, '3ESO', 'comunes'),
('Biología y Geología', 3, '3ESO', 'comunes'),
('Educación Física', 2, '3ESO', 'comunes'),
('Física y Química', 3, '3ESO', 'comunes'),
('Educación Plástica y AudioVisual', 2, '3ESO', 'comunes'),
('Tecnología y Digitalización', 2, '3ESO', 'comunes'),
('Religión', 1, '3ESO', null),
('2 Lengua extranjera: Francés', 2, '3ESO', 'optativas'),
('Emprendimiento, sostenibilidad y consumo responsable', 2, '3ESO', 'optativas'),
('Música Activa, Movimiento y Folclore', 2, '3ESO', 'optativas'),
('Lengua Castellana y Literatura', 4, '4ESO', 'comunes'),
('Matemáticas A', 4, '4ESO', 'comunes'),
('Matemáticas B', 4, '4ESO', 'comunes'),
('Lengua Extranjera (Inglés)', 4, '4ESO', 'comunes'),
('Geografía e Historia', 3, '4ESO', 'comunes'),
('Educación Física', 2, '4ESO', 'comunes'),
('Biología y Geología', 3, '4ESO', 'opción'),
('Digitalización', 3, '4ESO', 'opción'),
('Economía y Emprendimiento', 3, '4ESO', 'opción'),
('Expresión Artística', 3, '4ESO', 'opción'),
('Física y Química', 3, '4ESO', 'opción'),
('Formación y Orient. Personal y Profes.', 3, '4ESO', 'opción'),
('Latín', 3, '4ESO', 'opción'),
('Música', 1, '4ESO', 'opción'),
('2 Lengua extranjera: Francés', 2, '4ESO', 'opción'),
('Tecnología', 2, '4ESO', 'opción'),
('Filosofía', 2, '4ESO', 'optativas'),
('Cultura Clásica', 2, '4ESO', 'optativas'),
('Cultura Científica', 2, '4ESO', 'optativas'),
('Proyectos de Robótica', 2, '4ESO', 'optativas'),
('Artes Escénicas, Danza y Folclore', 2, '4ESO', 'optativas'),
('Ciencias Aplicadas Básicas I', 3, 'PEFP1', 'Formátivos de Carácter General'),
('Comunicación y Sociedad Básica I', 3, 'PEFP1', 'Formátivos de Carácter General'),
('Autonomía y Desarrollo Personal', 4, 'PEFP1', 'Formátivos de Carácter General'),
('Atención Básica al Cliente', 2, 'PEFP1', 'Formátivos de Carácter General'),
('Iniciación a la Actividad Laboral y Emprendedora', 2, 'PEFP1', 'Formátivos de Carácter General'),
('Prevención de Riesgos Laborales', 1, 'PEFP1', 'Formátivos de Carácter General'),
('Tutoría', 1, 'PEFP1', 'Formátivos de Carácter General'),
('Tratamiento Informático de Datos', 5, 'PEFP1', 'Profesionales'),
('Aplicaciones Básicas de Ofimática', 5, 'PEFP1', 'Profesionales'),
('Archivo y Comunicación', 4, 'PEFP1', 'Profesionales'),
('Ciencias Aplicadas Básicas I', 3, 'PEFP2', 'Formátivos de Carácter General'),
('Comunicación y Sociedad Básica I', 3, 'PEFP2', 'Formátivos de Carácter General'),
('Autonomía y Desarrollo Personal', 4, 'PEFP2', 'Formátivos de Carácter General'),
('Atención Básica al Cliente', 2, 'PEFP2', 'Formátivos de Carácter General'),
('Iniciación a la Actividad Laboral y Emprendedora', 2, 'PEFP2', 'Formátivos de Carácter General'),
('Prevención de Riesgos Laborales', 1, 'PEFP2', 'Formátivos de Carácter General'),
('Tutoría', 1, 'PEFP2', 'Formátivos de Carácter General'),
('Tratamiento Informático de Datos', 5, 'PEFP2', 'Profesionales'),
('Aplicaciones Básicas de Ofimática', 5, 'PEFP2', 'Profesionales'),
('Archivo y Comunicación', 4, 'PEFP2', 'Profesionales'),
('Formación en Centros de Trabajo', 0, 'PEFP2', 'Profesionales'),
('Matemáticas I', 4, '1BTOCIENCIAS', 'obligatoria'),
('Educación Física', 2, '1BTOCIENCIAS', 'comunes'),
('Filosofía', 3, '1BTOCIENCIAS', 'comunes'),
('Lengua Castellana y Literatura I', 4, '1BTOCIENCIAS', 'comunes'),
('Lengua Extranjera (Inglés) I', 3, '1BTOCIENCIAS', 'comunes'),
('Religión', 2, '1BTOCIENCIAS', NULL),
('Biología, Geología y CC Ambiente', 4, '1BTOCIENCIAS', 'modalidad'),
('Tecnología e Ingeniería I', 4, '1BTOCIENCIAS', 'modalidad'),
('Dibujo Técnico I', 4, '1BTOCIENCIAS', 'modalidad'),
('Física y Química', 4, '1BTOCIENCIAS', 'modalidad'),
('Latín I', 4, '1BTOHUMCSO', 'obligatoria'),
('Matemáticas aplicadas a las CCSS I', 4, '1BTOHUMCSO', 'obligatoria'),
('Educación Física', 2, '1BTOHUMCSO', 'comunes'),
('Filosofía', 3, '1BTOHUMCSO', 'comunes'),
('Lengua Castellana y Literatura I', 4, '1BTOHUMCSO', 'comunes'),
('Lengua Extranjera (Inglés) I', 3, '1BTOHUMCSO', 'comunes'),
('Religión', 2, '1BTOHUMCSO', NULL),
('Griego I', 4, '1BTOHUMCSO', 'modalidad'),
('Economía', 4, '1BTOHUMCSO', 'modalidad'),
('H. Mundo Contemporáneo', 4, '1BTOHUMCSO', 'modalidad'),
('Literatura Universal', 4, '1BTOHUMCSO', 'modalidad'),
('Bilogía, Geología y CC Ambientales', 4, '1BTO', 'optativas'),
('Tecnología e Ingeniería I', 4, '1BTO', 'optativas'),
('Dibujo Técnico I', 4, '1BTO', 'optativas'),
('Física y Química', 4, '1BTO', 'optativas'),
('Griego I', 4, '1BTO', 'optativas'),
('Economía', 4, '1BTO', 'optativas'),
('H. Mundo Contemporáneo', 4, '1BTO', 'optativas'),
('Literatura Universal', 4, '1BTO', 'optativas'),
('Latín I', 4, '1BTO', 'optativas'),
('2ºLengua extranjera: Francés', 4, '1BTO', 'optativas'),
('Anatomía Aplicada', 4, '1BTO', 'optativas'),
('Desarrollo Digital', 4, '1BTO', 'optativas'),
('Psicología', 4, '1BTO', 'optativas'),
('Unión Europea', 4, '1BTO', 'optativas'),
('Lenguaje y Práctica Musical', 4, '1BTO', 'optativas'),
('Historia de España', 3, '2BTOCIENCIAS', 'comunes'),
('Historia de la Filosofía', 3, '2BTOCIENCIAS', 'comunes'),
('Lengua Castellana y Literatura II', 4, '2BTOCIENCIAS', 'comunes'),
('Lengua Extranjera (Inglés) II', 4, '2BTOCIENCIAS', 'comunes'),
('Matemáticas II', 4, '2BTOCIENCIAS', 'obligatoria'),
('Matemáticas Aplicadas a las Ciencias Sociales II', 4, '2BTOCIENCIAS', 'obligatoria'),
('Biología', 4, '2BTOCIENCIAS', 'modalidad'),
('Dibujo Técnico', 4, '2BTOCIENCIAS', 'modalidad'),
('Física', 4, '2BTOCIENCIAS', 'modalidad'),
('Geología y Ciencias Ambientales', 4, '2BTOCIENCIAS', 'modalidad'),
('Química', 4, '2BTOCIENCIAS', 'modalidad'),
('Tecnología e Ingeniería II', 4, '2BTOCIENCIAS', 'modalidad'),
('2ºLengua Extranjera (Francés) II', 4, 'BTO', 'optativas'),
( 'Investigación y Desarrollo Científico ', 4, 'BTO', 'optativas'),
('Creación de Contenidos Artísticos y Audiovisuales', 4, 'BTO', 'optativas'),
('Historia de España', 3, '2BTOHUMCSO', 'comunes'),
('Historia de la Filosofía', 3, '2BTOHUMCSO', 'comunes'),
('Lengua Castellana y Literatura II', 4, '2BTOHUMCSO', 'comunes'),
('Lengua Extrajera (Inglés) II', 4, '2BTOHUMCSO', 'comunes'),
('Latín II', 4, '2BTOHUMCSO', 'obligatoria'),
('Matemáticas Aplicadas a Ciencias Sociales', 4, '2BTOHUMCSO', 'obligatoria'),
('Empresa y Diseño de Modelos de Negocio', 4, '2BTOHUMCSO', 'modalidad'),
('Geografía', 4, '2BTOHUMCSO', 'modalidad'),
('Historia del Arte', 4, '2BTOHUMCSO', 'modalidad'),
('Griego II', 4, '2BTOHUMCSO', 'modalidad'),
('2ºLengua extranjera: Francés', 4, '2BTO', 'optativas'),
('Investigación y Desarrollo Científico', 4, '2BTO', 'optativas'),
('Creación de Contenidos Artísticos y Audiovisuales', 4, '2BTO', 'optativas'),
('Biología', 4, '2BTO', 'optativas'),
('Dibujo Técnico', 4, '2BTO', 'optativas'),
('Física', 4, '2BTO', 'optativas'),
('Geología y Ciencias Ambientales', 4, '2BTO', 'optativas'),
('Química', 4, '2BTO', 'optativas'),
('Tecnología e Ingeniería II', 4, '2BTO', 'optativas'),
('Historia de la Música y la Danza', 4, '2BTO', 'optativas'),
('Fundamentos de Administración y Gestión', 4, '2BTO', 'optativas'),
('Empresa y Diseño de Modelos de Negocio', 4, '2BTO', 'optativas'),
('Geografía', 4, '2BTO', 'optativas'),
('Historia del Arte', 4, '2BTO', 'optativas'),
('Equipos eléctricos y electrónicos', 8, 'CFGB1', 'Profesionales'),
('Montaje y mantenimiento de sistemas y componentes informáticos', 10, 'CFGB1', 'Profesionales'),
('Itirenario personal para la empleabilidad', 2, 'CFGB1', 'Formátivos de Carácter General'),
('Ciencias aplicadas I', 4, 'CFGB1', 'Formátivos de Carácter General'),
('Comunicación y Ciencias Sociales I', 4, 'CFGB1', 'Formátivos de Carácter General'),
('Proyecto intermodular de aprendizaje colaborativo', 1, 'CFGB1', 'Profesionales'),
('Tutoría', 1, 'CFGB1', 'Formátivos de Carácter General'),
('Instalación y mantenimiento de edes para transmisión de datos', 8, 'CFGB2', 'Profesionales'),
('Operaciones auxiliares para la configuración y la explotación', 8, 'CFGB2', 'Profesionales'),
('Ciencias aplicadas II', 6, 'CFGB2', 'Formátivos de Carácter General'),
('Comunicación y Ciencias Sociales II', 6, 'CFGB2', 'Formátivos de Carácter General'),
('Proyecto intermodular de aprendizaje colaborativo', 1, 'CFGB2', 'Profesionales'),
('Tutoría', 1, 'CFGB2', 'Formátivos de Carácter General'),
('Lenguajes de marcas y sistemas de información', 3, 'DAW1', 'Comunes'),
('Sistemas informáticos', 5, 'DAW1', 'Comunes'),
('Bases de datos', 5, 'DAW1', 'Comunes'),
('Programación', 6, 'DAW1', 'Comunes'),
('Entornos de desarrollo', 2, 'DAW1', 'Comunes'),
('Inglés técnico para los ciclos formativos de Grado Superior', 2, 'DAW1', 'Comunes'),
('Digitalización aplicada al sector productivo (GS)', 2, 'DAW1', 'Comunes'),
('Sostenibilidad aplicada al sector productivo', 1, 'DAW1', 'Comunes'),
('Itirenario personal para la empleabilidad I', 3, 'DAW1', 'Comunes'),
('Proyecto intermodular de desarrollo de aplicaciones web', 1, 'DAW1', 'Comunes'),
('Desarrollo web en entorno cliente', 6, 'DAW2', 'Comunes'),
('Desarrollo web en entorno servidor', 7, 'DAW2', 'Comunes'),
('Despliegue de aplicaciones web', 3, 'DAW2', 'Comunes'),
('Diseño de interfaces web', 5, 'DAW2', 'Comunes'),
('Itirenario personal para la empleabilidad II', 3, 'DAW2', 'Comunes'),
('Optatividad', 4, 'DAW2', 'Comunes'),
('Lenguajes de marcas y sistemas de información', 3, 'DAM1', 'Comunes'),
('Sistemas informáticos', 5, 'DAM1', 'Comunes'),
('Bases de datos', 5, 'DAM1', 'Comunes'),
('Programación', 6, 'DAM1', 'Comunes'),
('Entornos de desarrollo', 2, 'DAM1', 'Comunes'),
('Inglés técnico para los ciclos formativos de Grado Superior', 2, 'DAM1', 'Comunes'),
('Digitalización aplicada al sector productivo (GS)', 2, 'DAM1', 'Comunes'),
('Sostenibilidad aplicada al sector productivo', 1, 'DAM1', 'Comunes'),
('Itirenario personal para la empleabilidad I', 3, 'DAM1', 'Comunes'),
('Proyecto intermodular de desarrollo de aplicaciones web', 1, 'DAM1', 'Comunes'),
('Acceso a datos', 6, 'DAM2', 'Comunes'),
('Desarrollo de interfaces', 6, 'DAM2', 'Comunes'),
('Programación multimedia y dispositivos móviles', 4, 'DAM2', 'Comunes'),
('Programación de servicios y procesos', 5, 'DAM2', 'Comunes'),
('Sistemas de gestión empresarial', 2, 'DAM2', 'Comunes'),
('Itirenario personal para la empleabilidad II', 3, 'DAM2', 'Comunes'),
('Optatividad', 4, 'DAM2', 'Comunes'),
('Proyecto intermodular de desarrollo de aplicaciones multiplataforma', 1, 'DAM2', 'Comunes'),
('Proyecto intermodular de desarrollo de aplicaciones web', 1, 'DAW2', 'Comunes'),
('Montaje y mantenimiento de equipo', 6, 'SMR1', 'Comunes'),
('Sistemas operativos monopuesto', 5, 'SMR1', 'Comunes'),
('Redes locales', 5, 'SMR1', 'Comunes'),
('Aplicaciones Web', 6, 'SMR1', 'Comunes'),
('Inglés técnico para los ciclos formativos de Grado Superior', 2, 'SMR1', 'Comunes'),
('Digitalización aplicada al sector productivo (GM)', 2, 'SMR1', 'Comunes'),
('Sostenibilidad aplicada al sector productivo', 1, 'SMR1', 'Comunes'),
('Itirenario personal para la empleabilidad I', 3, 'SMR1', 'Comunes'),
('Proyecto intermodular de sistemas microinformáticos y redes', 1, 'SMR1', 'Comunes'),
('Aplicaciones ofimáticas', 7, 'SMR2', 'Comunes'),
('Sistemas operativos en red', 6, 'SMR2', 'Comunes'),
('Servicios en red', 5, 'SMR2', 'Comunes'),
('Seguridad informática', 4, 'SMR2', 'Comunes'),
('Itirenario personal para la empleabilidad II', 3, 'SMR2', 'Comunes'),
('Optatividad', 4, 'SMR', 'Comunes'),
('Proyecto intermodular de sistemas microinformáticos y redes', 1, 'SMR2', 'Comunes');

CREATE TABLE Incidencias (
  cod_incidencia INT PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(150) NOT NULL,
  puntos int(11) NOT NULL,
  descripcion text
  );


INSERT INTO Incidencias (nombre, puntos, descripcion) VALUES
('Desconsideración con otros miembros de la comunidad escolar.', 3, 'Desconsideración con otros miembros de la comunidad escolar.'),
('Faltas injustificadas de asistencia a clase o de puntualidad.', 3, 'Faltas injustificadas de asistencia a clase o de puntualidad. '),
('Interrupción del normal desarrollo de las clases.', 3, 'Interrupción del normal desarrollo de las clases.'),
('Actos de indisciplina contra miembros de la comunidad escolar.', 5, 'Actos de indisciplina contra miembros de la comunidad escolar.'),
('Alteración del desarrollo normal de las actividades del centro.', 5, 'Alteración del desarrollo normal de las actividades del centro.'),
('Deterioro intencionado de material del centro o de otros miembros de la CE.', 5, 'Deterioro, causado intencionadamente, de las dependencias del centro, de su material, o materiales de otros miembros de la comunidad educativa.'),
('Acoso o la violencia contra las personas.', 10, 'Acoso o la violencia contra las personas, y las actuaciones perjudiciales para la salud y la integridad personal.'),
('Acoso o violencia contra el profesorado y las actuaciones perjudiciales para su salud e IP.', 10, 'Acoso o violencia contra el profesorado y las actuaciones perjudiciales para su salud y su integridad personal.'),
('Actos de indisciplina perjudiciales para el profesorado o el funcionamiento de la clase.', 10, 'Actos de indisciplina perjudiciales para el profesorado o el funcionamiento de la clase.'),
('Actos de indisciplina que alteren gravemente el desarrollo normal de las actividades del centro.', 10, 'Actos de indisciplina que alteren gravemente el desarrollo normal de las actividades del centro.'),
('Actos que menoscaben la autoridad del profesorado y perturban el desarrollo de las clases.', 10, 'Actos que menoscaben la autoridad del profesorado y perturban el desarrollo de las clases.'),
('Desconsideración hacia el profesorado.', 10, 'Desconsideración hacia el profesorado.'),
('Deterioro grave e intencionado de las dependencias del centro u otros miembros de la CE.', 10, 'Deterioro grave e intencionado de las dependencias del centro, de su material, o pertenencias de otros miembros de la comunidad educativa.'),
('Deterioro grave, causado intencionalmente, de propiedades y material del profesorado', 10, 'Deterioro grave, causado intencionalmente, de propiedades y material del profesorado'),
('Deterioro intencionado del material que utiliza el profesor en sus clases.', 10, 'Deterioro intencionado del material que utiliza el profesor en sus clases.'),
('Exhibir símbolos racistas, emblemas de ideologías que preconicen violencia, xenofobia o terrorismo.', 10, 'Exhibir símbolos racistas, emblemas o manifestación de ideologías que preconicen violencia, xenofobia o terrorismo.'),
('Incumplimiento de las medidas correctoras impuestas con anterioridad.', 10, 'Incumplimiento de las medidas correctoras impuestas con anterioridad.'),
('Incumplimiento reiterado de los alumnos de trasladar información a los tutores.', 10, 'Incumplimiento reiterado de los alumnos de trasladar información a los tutores.'),
('Injurias u ofensas graves contra otros miembros de la comunidad escolar.', 10, 'Injurias u ofensas graves contra otros miembros de la comunidad escolar.'),
('Injurias, ofensas graves, vejaciones o humillaciones hacia el profesorado.', 10, 'Injurias, ofensas graves, vejaciones o humillaciones hacia el profesorado.'),
('Interrupción reiterada de las clases y actividades educativas.', 10, 'Interrupción reiterada de las clases y actividades educativas.'),
('Introducción de objetos o sustancias peligrosas para la salud y la IP del profesorado.', 10, 'Introducción de objetos o sustancias peligrosas para la salud y la integridad personal del profesorado.'),
('Reiteración de conductas contrarias a las normas de convivencia en el centro.', 10, 'Reiteración de conductas contrarias a las normas de convivencia en el centro.'),
('Suplantación de identidad, falsificación de documentos que estén bajo responsabilidad del prof.', 10, 'Suplantación de identidad, falsificación o sustitución de documentos que estén bajo responsabilidad del profesorado.'),
('Suplantación de personalidad, la falsificación o sustracción de documentos y material académico.', 10, 'Suplantación de personalidad, la falsificación o sustracción de documentos y material académico.'),
('Utilizar símbolos e ideologías que menoscaben de la autoridad y dignidad del prof.', 10, 'Utilizar y exhibir símbolos o manifestar ideologías que supongan un menoscabo de la autoridad y dignidad del profesorado.'),
('Vejaciones o humillaciones a miembros de la C.E', 10, 'Vejaciones o humillaciones a miembros de la C.E, particularmente las de género, sexual o racial, o contra alumnado vulnerable.'),
('Uso no autorizado de teléfono móvil (art. 7 de la Orden 140/2024, de 28 de agosto, de la Consejería de Educación, Cultura y Deportes)',10.'Uso no autorizado de teléfono móvil (art. 7 de la Orden 140/2024, de 28 de agosto, de la Consejería de Educación, Cultura y Deportes)');
-- --------------------------------------------------------

CREATE TABLE Partes (
    cod_parte INTEGER NOT NULL AUTO_INCREMENT,
    cod_usuario INTEGER NOT NULL,
    matricula_Alumno VARCHAR(20) NOT NULL,
    incidencia INT NOT NULL,
    materia INT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    descripcion TEXT,
    fecha_Comunicacion DATE NOT NULL,
    via_Comunicacion VARCHAR(25) NOT NULL,
    caducado TINYINT(1) NOT NULL,
    PRIMARY KEY (cod_parte),
    FOREIGN KEY (cod_usuario)
        REFERENCES Usuarios (cod_usuario),
    FOREIGN KEY (materia)
        REFERENCES Asignaturas (cod_asignatura),
    FOREIGN KEY (incidencia)
        REFERENCES Incidencias (cod_incidencia)
);

CREATE TABLE Expulsiones (
  cod_expulsion  INTEGER NOT NULL auto_increment,
  cod_usuario  INTEGER NOT NULL,
  matricula_del_Alumno varchar(20) NOT NULL,
  fecha_Inicio date DEFAULT NULL,
  Fecha_Fin date DEFAULT NULL,
  tipo_expulsion  varchar(40),
  fecha_Insercion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (cod_expulsion),
  FOREIGN KEY (cod_usuario) REFERENCES Usuarios(cod_usuario),
  FOREIGN KEY (matricula_del_Alumno) REFERENCES Alumnos(matricula)
);

CREATE TABLE PartesExpulsiones (
  cod_parte  INTEGER NOT NULL,
  cod_expulsion  INTEGER NOT NULL,
  PRIMARY KEY (cod_parte, cod_expulsion),
  FOREIGN KEY (cod_parte) REFERENCES Partes(cod_parte),
  FOREIGN KEY (cod_expulsion) REFERENCES Expulsiones(cod_expulsion)
);




INSERT INTO Usuarios (cod_usuario, dni, nombre, apellidos, email, clave, rol, cod_delphos, validar, tutor_grupo, departamento) VALUES(1, '11111111a', 'administrador', 'IES Bargas', 'incidenciasiesbargas@gmail.com', '$2y$10$q.b1SyM1jZkK5x1iGIyb9eBmBh7AxiHgIgFmoYfPBUjCkUfhtfsSy', '0', 0, 'si', 'E1B', 8),
(2, '03936143S', 'Mario', 'Marugán Cancio', 'mariomarugan10@hotmail.com', '$2y$10$2zYin4X9BKZyE3svNvBAge8zd4fxZEhWUD7DtrQicDGRiUvk5qLwW', '0', 139686, 'si', 'DAW2', 8),
(6, '03923127V', 'Jorge', 'Carmena Plaza', 'jjcp66@educastillalamancha.es', '$2y$10$pqHE5u5o4s0bMy8bIPlkw.5MzJEzdxmVWRJ3emsJQ/4c0eMeOFOZm', '1', 163566, 'si', 'No.', 8),
(5, '70241742H', 'Martín', 'Gómez Alonso', 'martingomezalonso@gmail.com', '$2y$10$jNe/0q5Ld/NqqqPpgaTAMuPn4Nc1Cna4zeN9BeGN6xiqYnUtJbrYm', '0', 48237, 'si', 'No.', 8),
(19, '47067163', 'Antonio', 'Heras Villanueva', 'profesor.antoniohv@gmail.com', '$2y$10$oC2OLl7p0HysW3rKYI.2HOI7Y0q7lkfOGLXhCWkovXezKFmox/hda', '1', 103142, 'si', 'SMR1', 8),
(34, '6', 'Mario 2', 'Marugán Cancio', 'mariomarugan10@gmail.com', '$2y$10$HCPf9hxzfnjbsrHCPtom.OUavRb2njCy1FnqUzldnDJtYohphZpay', '1', 139686, 'si', 'No.', 8),
(33, '03913441Z', 'Rafael', 'Quilón Sánchez', 'rafaelquilon.iesjulioverne@gmail.com', '$2y$10$vfcd1uPZt/enBRYwXISSSeLRBSYYJk2J9gf6DgcINxEUopU5P75wi', '1', 107584, 'si', 'E2D', 8),
(39, '70245456Y', 'Alicia', 'De Álvaro Martín', 'aliciadealvaromartin@gmail.com', '$2y$10$h3TzbaQnp.RHx9pnzqlqb.wqSEZEnN.QbUpMdxhXU7BmNHo00.uBW', '0', 45549, 'si', 'No.', 8),
(40, '03877577F', 'RUBÉN', 'RUIZ MARTÍN-ARAGÓN', 'ruben.ies.informatica@gmail.com', '$2y$10$iCMuh/3YrYB21MvUaGtghOatGcbkqMmSdjtmCkUyvw5R8EWul0AyS', '0', 48054, 'si', 'No.', 8),
(41, '03876998A', 'María', 'Villacañas Guardia', 'maria.azarquiel.ingles@gmail.com', '$2y$10$bfZ9AMaD4iG/KST.1nlkK.bAX7u9x8j0WxGoDeIX2P1f6qevwXq/a', '1', 25571, 'si', 'No.', 2),
(42, '03884133P', 'Mar', 'Rodriguez Rodriguez', 'mar_rodrirodri@hotmail.com', '$2y$10$67o4SmWxv3KJiZqLudbjauLG0wcRJBfqzqHg/RHJmU5xsNG5/AUNK', '1', 142236, 'si', 'No.', 13),
(43, '44882702L', 'Miguel', 'Pérez', 'mperezprof@gmail.com', '$2y$10$.vfIvhlUg.GVq0N1QvsTOeto2Nd7/ssJ5.7seJFFg8qY72wJYFC2K', '1', 134923, 'si', 'CFGB1', 8),
(44, '03894915A', 'Maleni', 'Triviño Toledo', 'bioygeo.bargas@gmail.com', '$2y$10$quosNpTUyz.9gdDURlYhm.2ANMoDrg5L1pbjgfh4A7XuGky1SpBUe', '1', 65783, 'si', 'No.', 15),
(45, '05717778R', 'Estefania', 'Hernandez Guillen ', 'Estefania.Hdez9331@gmail.com', '$2y$10$./HC5yxrKQVuds9pPRW9yOcjoIY4UnsF5p4bVETiBVielwJp7Fr/y', '1', 152115, 'si', 'No.', 5),
(46, '74522997F', 'Tomás', 'Domínguez Ponce de León', 'tomas.dominguez93@gmail.com', '$2y$10$T2HocZ1.jmzoACHNvAJC9OJYNoE.OmBRbB2z6RCVthsB3TIoPY1Eu', '1', 156316, 'si', 'No.', 15),
(47, '44715614A', 'Armando Jesús', 'Galante Ramos', 'armandogalante@hotmail.com', '$2y$10$QcTMAAUh58sNGH./zqnWk.yN6NG0Pvg64owhHpgeTI3h7iIamjEtu', '0', 56841, 'si', 'No.', 11),
(48, '03880923H', 'Gema', 'Bargueño Alonso', 'gemabarguenoalonso@gmail.com', '$2y$10$4oPVDrvBaZqCJLjRsxpP3OWLBOg9a354d/yWBo5zph0qRLw854Ou2', '1', 66352, 'si', 'No.', 2),
(49, '03874697G', 'Elena', 'De las Hazas Corrales', 'elenadelashazas@yahoo.es', '$2y$10$VXQuS3vrbM7dqiR8u9kRnuJFiyOhKmALCRzKyTJq4cUO1Z38EgLmu', '1', 25536, 'si', 'No.', 14),
(50, '05715303X', 'María', 'Rodríguez Sánchez', 'mariaros1804@gmail.com', '$2y$10$/Wq2o/p85JGTpEIByHTNrOMUpBjiAGFqWA36/hr5vpi1WcbVvZXJe', '1', 157714, 'si', 'No.', 5),
(51, '71215701L', 'Esther', 'Cañadas Belmar', 'ecbelmar@gmail.com', '$2y$10$rLpuM4BmpQS5y1HKC.21/OahqyWQmCzgPZ9pKIdgJycduYksYJyRC', '1', 64583, 'si', 'E2E', 11),
(52, '04213569S', 'Sandra', 'Jimenez Martin', 'sandrajm.ingles@gmail.com', '$2y$10$gFOW3hSyEk1ymkrpzv7TtezAvxfpF9mX5rpnlG1zayb29ccyv2gEu', '1', 47839, 'si', 'No.', 2),
(53, '03863221A', 'TEODORO', 'CASTAÑO ALVAREZ', 'teodorocastano@gmail.com', '$2y$10$egEKSzwKydm8lyqtL8H0ROGjSChN/7L8PajQjZtaMAgf4Q9aHWs8C', '1', 156277, 'si', 'E1D', 5),
(54, '03824588X', 'María Teresa', 'Rosell Casarrubios', 'trcpaeg@gmail.com', '$2y$10$KGnzaR9cr8C4wYucZ7JWUONdr70Dd42NQvQh3ZqIinUyqPv55rdAW', '1', 26417, 'si', 'No.', 9),
(55, '06252593c', 'AMPARO', 'CÁMARA GALLEGO', 'amparocamara@gmail.com', '$2y$10$8LjSIwFGIj5h5c8j03WTNeiMkkQVvh6LV8wFq8xLOxKFDsh5hiULq', '1', 45321, 'si', 'E3D', 7),
(87, '52559358B', 'IÑIGO', 'INCHAUSTI LOPEZ', 'iiil06@educastillalamancha.es', '$2y$10$NR59nApf6ijAmUE6Vc9IlOgpOmlQ5nfwSXk717HvarpFMNyYxq/4S', '1', 139638, 'si', 'E1A', 3),
(113, '03883091R', 'Sara', 'Merino Lopez', 'samerilo17@gmail.com', '$2y$10$Bub.RkWEHiO6xhwzDtTax.rJ71qefKbEl.WrzVvoRX26Ep6dLMou2', '1', 25443, 'si', 'E2F', 14),
(58, '03822890Z', 'Pilar', 'Sánchez-Horneros Muñoz', 'pilarhorneros@hotmail.com', '$2y$10$ht75p6bcPz8XnFVZEABUTOlrWzS0SWtniXr3EnAKOzHG./pw7SjJW', '1', 26473, 'si', 'E4A', 13),
(59, '48744215Q', 'Ana María', 'Ware Paredes', 'anamaria.wareparedes@gmail.com', '$2y$10$jVgD0LrP82d/nJWGMJ4Tr.XHehg.j7kF2u1Cbb2FUb/ZJL9Or0xWm', '1', 63360, 'si', 'E4F', 2),
(62, '30572055H', 'Emilio', 'Tamayo Izquierdo', 'emilbilbo@gmail.com', '$2y$10$u5eGeeEM/xsIF2iz07sim.2jiOmnYnDxRi4b4ZADdEPj08NTVjTWC', '1', 53908, 'si', 'No.', 6),
(61, '03910025W', 'EVA MARIA', 'ROJO GAMARRA', 'emrojogamarra@gmail.com', '$2y$10$r//CSq15pi7iHd.tkrhNnuVdHc/WBKXKv2SxAWy.uUd22Wy2XEbXK', '1', 165109, 'si', 'No.', 7),
(63, '03927617E', 'JAVIER', 'GARCIA UBEDA', 'julioverne22.23@gmail.com', '$2y$10$pZ09LUbUKuiy.lJS5Q2tuOqSnNxtfQhoBDamR7fExLkM3dB/OgnVm', '1', 164034, 'si', 'DAM2', 8),
(64, '03897741T', 'ANA BELEN', 'RUIZ SANCHEZ', 'lovelystudents18@gmail.com', '$2y$10$YVOsUW6oSwrE0z0HCmArTe25Bgs2sC0wc3itjg8o9Dr1ZOloLG3sC', '1', 66197, 'si', 'B1B', 2),
(65, '03868150x', 'Marta', 'Pérez Doallo', 'martadoa@gmail.com', '$2y$10$qeUjDGYIt8QyBe8vbn8S/u/l9M6PG.F91o9l6mBfBtn2rVKnSRvTK', '1', 60216, 'si', 'No.', 2),
(66, '05684526F', 'Angélica', 'Navarro Lanchas', 'lanchas1980@hotmail.com', '$2y$10$ExHaZOaFm9/3ulcOF3NcteD7RSApXFNqt4DTrMMmW62ueWeSwvrCK', '1', 54944, 'si', 'E4C', 9),
(67, '05934457C', 'Laura', 'Ramos Ruiz', 'llrr59@educastillalamancha.es', '$2y$10$YGmYYC8eVhGQvHps0Yrx..WK93aa4MvoQGC4EhjI3cZlpSPgZUGoa', '1', 156086, 'si', 'E2C', 2),
(68, '05662310D', 'Francisco Segundo', 'Márquez Rubio', 'paco_ii@hotmail.com', '$2y$10$SoFRWPohAUdX8m5QkWvQ0ucocVmYW2Ip.F3jhItpP9PDwlaDwz36O', '1', 18573, 'si', 'E1E', 9),
(69, '03865818R', 'Teresa', 'Alvarez Martín-Nieto', 'sieteseptiembre@hotmail.com', '$2y$10$r..N97PYdh6C9n5tUTHEXulKYeVEBV7EN.jAo9wb8m174lbsRHiSe', '1', 168736, 'si', 'B2B', 9),
(70, '04855198J', 'Marta', 'Manzanilla Nevado', 'manzanilla.nevado@gmail.com', '$2y$10$Za8KAauBjKBVUSA8uJDS/.s2EyE3yHlTlgrSlK78ROXqv0sndgulC', '1', 120123, 'si', 'B1A', 9),
(71, '03918450D', 'Soledad', 'García Fernández', 'solehistoriada@gmail.com', '$2y$10$f6vxhTXbq1ln.4OWEpKJmuk5PK7px0MzGMZJfOEA1gGuhOfr7j1Tq', '1', 108035, 'si', 'E4D', 11),
(72, 'X5772892F', 'Edith', 'Sandor', 'eesn05@educastillalamancha.es', '$2y$10$WFUlSK3JaRZaLq.ORNd50uH9BhktLES1SAjvuYNvluGe1dP4SaO.6', '1', 156091, 'si', 'No.', 9),
(73, '03879978Q', 'Juan- José ', 'Moya García', 'juanjoelcantor@hotmail.com', '$2y$10$wLcD0fj6ijFRkvqFlEuHTOEpJDQHWV6cqmmkktwt4BwdHHZu1oHmC', '1', 149043, 'si', 'DIV3B', 12),
(74, '53345721G', 'Beatriz', 'Sánchez Fernández', 'bbsf2409@gmail.com', '$2y$10$uPojRRsFkQRaNqBeyjopG.w4oOk.QeyAyk7NaqvIy3sEVhsu0Quv.', '1', 151088, 'si', 'E3A', 13),
(75, '05930040L', 'MARÍA', 'LÓPEZ ANÉS', 'anesmaria@hotmail.com', '$2y$10$pq3LEQo0sklVDVT427wDq.3AqMkKJKoHWyL2JcY0gjFNSqyEBmg4i', '1', 82257, 'si', 'E3B', 5),
(76, '44375411Q', 'MARI ANGELES', 'SEGOVIA ANDRES', 'mariangelessa@hotmail.com', '$2y$10$PZmdJh8artxu0OduM697Be49rS5RZphsYx6npzCjGtp5NrrEAkMCy', '1', 35625, 'si', 'No.', 12),
(77, '48652563L', 'Carmen', 'Nicolás', 'carmen-19nn@hotmail.com', '$2y$10$vf3h/2glHbYegjMM9iTeAO0jNL4KfmAFaigGbna21K.H63MkbHwXK', '1', 128012, 'si', 'No.', 15),
(78, '43774911T', 'Alejandro', 'Bravo Castillero', 'bracasal@telefonica.net', '$2y$10$jRKZpNI/chxeVtva5fnxXu3Cuxcp6/B3TUlrBRjkClNo.tLHWlbI6', '0', 12241, 'si', 'No.', 5),
(79, '03895862F', 'LAURA EUGENIA', 'Fernández López', 'lefl01@educastillalamancha.es', '$2y$10$2i.PUcZgzmJAQLer4MlbkOZC0PN5j5FKRGnu1GNQeW3x5UqL4n3su', '1', 65152, 'si', 'E1C', 11),
(80, 'X9636146c', 'CRISTINA GABRIELA', 'DOBRIN', 'cgdn01@educastillalamancha.es', '$2y$10$Ev1HoK9fgk/05rNyO/dAqOp6N0nVKWYc33LvF8waKKr0coIF17.AS', '1', 45256, 'si', 'No.', 2),
(81, '03822674m', 'Ana Clara', 'Ruiz Díaz', 'clareta.r@gmail.com', '$2y$10$UnLjmBrlBkHfGdBbL8LgLeDBYh8oxGfkyUmK.818tTIsoafJZFAyy', '1', 26464, 'si', 'E1F', 6),
(82, '05708848H', 'CARMEN', 'LÓPEZ MENCHÉN', 'carmenlopezmenchen.eco@gmail.com', '$2y$10$tZrpvFOvCMyvYSrzVm/YyeYlS5eQL8ByjJX58FfZSW8ePOxon2NO6', '1', 157095, 'si', 'No.', 17),
(83, '03876434Z', 'Olga', 'García Fernández', 'olgafilosofia@gmail.com', '$2y$10$2mvqEJYyrD71jTe7mPdXPOiBXvZipr7nVrHFnvHv6GsPr0qKSbXeG', '0', 45258, 'si', 'B2C', 10),
(84, '44428384C', 'Armonía', 'Aguilera Rodríguez', 'armonia.ar@gmail.com', '$2y$10$/Kgga01SpZmMEER2PJ1T.eay5UuUjr.JKycrQs2HhGMwNOOspuwRW', '1', 135704, 'si', 'No.', 1),
(85, '47077269H', 'CLARA', 'FRAILE MORAGA', 'frailemoraga@gmail.com', '$2y$10$ZiSey4fADluMQsEqiR3RvOPuRCRVcv0zndgq9U05tG79ujwB8OH8.', '1', 156913, 'si', 'B1D', 17),
(90, '03869966D', 'JESUS', 'MENDEZ DIAZ-ROPERO', 'barboljm@hotmail.com', '$2y$10$eR2iMbmUFboPF0WYpEU7zuBkqCJ8x6pgS0QRzhX/lzySd.cHQpZWa', '1', 25652, 'si', 'No.', 3),
(89, '43787214K', 'Nacho ', 'Bravo Castillero', 'eneko_3@hotmail.com', '$2y$10$1XA6m9TS1cWrBR0NbQkxiOWCBXUPxeJNZDigsc7EYFS5pwUS1N3U6', '1', 39649, 'si', 'E2G', 10),
(91, '21494557e', 'María Pilar', 'perez cremades', 'pilaraspe@yahoo.es', '$2y$10$F0wQ3MkoEUJaL4j009BHC.odP.jDf5kR8TYIt9aqVQ46AWuq6i/SK', '1', 89567, 'si', 'PEFP1', 12),
(92, '06247825J', 'María Gemma', 'Lozano Cepeda', 'jemolloz@hotmail.com', '$2y$10$vkXVE..zl7rkJQKrkawJAuQk9I8aAax81.YW42KDy4GDAoENHE/2a', '1', 150913, 'si', 'No.', 12),
(93, '06261771K', 'Francisco ', 'Aparicio Mínguez ', 'soy_aparicio@hotmail.com', '$2y$10$acLwj9Q94ib3qziKFLyX4u8SuyukXDBYL.070XFi7snAyiffly7JW', '1', 34529, 'si', 'No.', 4),
(94, '03924375T', 'Pablo', 'Iglesias', 'piig01@educastillalamancha.es', '$2y$10$29jv/Cph8APKhQ9NNhN85.HNGyL6.cDbWTRccKrwaSxqMgXBlPFXW', '1', 167721, 'si', 'No.', 18),
(95, '02916998t', 'SARA', 'MATAMALA SALINERO', 'sarasalinero@hotmail.com', '$2y$10$kVQiwTDRP/XghNPpaKbXs.9dEdR3pdgWsANp31B8iOD1GhSw9HAHy', '1', 110730, 'si', 'No.', 12),
(98, '80136876T', 'Rosa', 'Jurado', 'sitarosa4@gmail.com', '$2y$10$A4OfxrrU5.6VNk3PbuuuB.09QGcOMNT0KJZudfNDZlIqWEY4PmzVa', '1', 7530, 'si', 'No.', 16),
(97, '03907673L', 'MARIA', 'DE LEON HERNANDEZ', 'mdlh09@educastillalamancha.es', '$2y$10$Vn.IayTcyB5S6IU.DPGnt.7as7ZnIt8iwiU6.YydXqpI.GySKHn1W', '1', 166935, 'si', 'No.', 18),
(99, '03922827Q', 'Silvia', 'Medina Payo', 'smpayo@hotmail.es', '$2y$10$qqv0BluSdsYSZuDIoxdnqeIsKJvA0WXaqRnfrQRYCcndl4BZzeJT.', '1', 169435, 'si', 'B2A', 5),
(100, '03934166Q', 'Héctor', 'Suárez Manzano', 'hector.suarezm12@gmail.com', '$2y$10$37cDTX1e74b21HNwFVeWfeTpbrC37sI7ZhnOUSkTucBRAk4vT0QNS', '1', 163492, 'si', 'DAM1', 8),
(101, '45923626D', 'Laura', 'Lozano Larín', 'lauralozanolarin@gmail.com', '$2y$10$bIE/k8v.STJCU40dO194jueRWVaq7stKd0smFbTeImrBLrcfeFEQC', '1', 158624, 'si', 'DAW1', 8),
(102, '03868667k', 'Ander', 'Rodríguez Parrón', 'anderparron@gmail.com', '$2y$10$/Ul0fovlnPNofDFz.KVhXecx3yict3frvFNsAz2OYA.66SbcT71QO', '1', 3180, 'si', 'No.', 11),
(116, '12375045x', 'beatriz', 'cendrero querol', 'bcendrero@hotmail.com', '$2y$10$DqjC.n2/7wZnQ6jugVM3vOi.sxGVvKmxSIQHTKWRwKMS5hdtTZobm', '1', 14392, 'si', 'No.', 1),
(104, '03894139D', 'MARIA', 'SERRANO GALAN', 'mariasg3@gmail.com', '$2y$10$cecSHrtcaUNaNTYEEHCijuY534gozfiaSC4fepQVvThbC2oxkHN/u', '1', 43440, 'si', 'E3C', 11),
(117, '03884992Q', 'ALVARO', 'MEDINA', 'simplementech@gmail.com', '$2y$10$G9IquGzqPVLBltpNEWTTiOH5A6awvaTBO2ulpfv7E1KPIGaW.OLL2', '1', 66566, 'si', 'E4E', 14),
(112, '51420942A', 'MariLuz', 'García Escamilla', 'mlge05@educastillalamancha.es', '$2y$10$6ZZH2WkmXjA9gZpsvYa4WeyraKwuYSDTd0QXIxCc31J.ViRjC/VvC', '1', 157012, 'si', 'No.', 5),
(105, '03865208n', 'Eduardo ', 'González Gandarillas ', 'yayogonga@gmail.com', '$2y$10$hKZc5ztO9unfKzO9AEpzH.AkzXUMrsT0tTIA15hdE7jiswRX.2hja', '1', 25727, 'si', 'No.', 7),
(106, '18987102G', 'Enrique', 'Sabater Pitarch', 'teachersabater@gmail.com', '$2y$10$s1Z1C4KZjIgf5Qahx6XZru.bys.xgtV1kLXcH9f9ITd7aw9OvBZoC', '1', 102857, 'si', 'E2B', 11),
(107, '03899336P', 'Olga', 'Galán Arriero', 'olgarriero@hotmail.com', '$2y$10$4i8437cHAEUh.W3dqTD55utyeH2suBhPX40vqvVGyynTOL9MUvjBu', '1', 129321, 'si', 'No.', 12),
(108, '01915493F', 'Gonzalo', 'Enguita González', 'genguitagonzalez@gmail.com', '$2y$10$yjhpjzw0f53a55wepVJotOsf67rJZwORiuq/MJG/y9Knm5lPSkAtK', '1', 34542, 'si', 'E3E', 9),
(109, '03809732 ', 'ISABEL ', 'SERRANO BRAVO ', 'isbtoledo4@gmail.com', '$2y$10$7isPIkJnQeZ2nOmBPUBAsedKbs6X8XHuv5H7DDRZXknGsnEGVvY6K', '1', 2644, 'si', 'No.', 12),
(115, '70573502A', 'Marina', 'Sánchez Gutiérrez ', 'marina.sanchez.julioverne@gmail.com', '$2y$10$C0fwdSS6joC7wzpYbcNIfuonQzvLtOF2qT3rBUsLIvXUBMjh/tes6', '1', 9103, 'si', 'E4B', 3),
(111, '53231699q', 'TAMAR', 'LOPEZ ARIAS', 'tamarlopezarias01@gmail.com', '$2y$10$dmn6oNeQGy4/ypxOZ9oTWOzJAtVe9qQWt3DwUjPTzeUTygJFCYCc.', '1', 48551, 'si', 'DIV4F', 13),
(118, '00000000X', 'Consejería', 'IES Bargas', 'conserjeria@iesbargas.com', '$2y$10$mLwbXcuml5UgZ8kr8TFz.e/a2O5qU2sSl7xjUl0gibjM.D/oW.qWm', '3', NULL, 'si', NULL, NULL),
(120, '06579628H', 'Julia María', 'Sanchez Rodríguez', 'julietta_sanchez@hotmail.es', '$2y$10$DLrtQ.nNXf0yEgMQy4kZmu99BK6dh1pY0dJxWB4GYnFfHBF.zRZCG', '1', 135026, 'si', 'No.', 5),
(121, '03907688B', 'María Isabel', 'Gonzalez Diaz', 'isabeltecnologia@hotmail.com', '$2y$10$L8ic0pb2ujedltr9nLNJDO95bHlV83uBuzV/.2YZtAZcqHWDmQykm', '1', 68455, 'si', 'No.', 5),
(122, '03896693X', 'Lucía', 'Crespo Jiménez', 'luciacj81@gmail.com', '$2y$10$fHbi8Jef2Iv.cYdD5FvqTOypU.a6cBuWfcJtzM7Gu.86El1s5pSsm', '1', 132901, 'si', 'E1B', 11),
(123, '05913864N', 'Teresa', 'Sánchez Toledano', 'teresancheztoledano@hotmail.com', '$2y$10$uNJu0LoF5pFskQPXOsf7O.J5gXDKv8ZEm/7fRZLgIVIj5.n6eP8jW', '1', 17454, 'si', 'DIV3A', 3),
(124, 'B67913012', 'Florín y Andreas', 'RUME', 'rume@iesbargas.com', '$2y$10$JE1s/Q0eEFxYklDX7g7kh.4Xy.qj7oivUaI1A7jn7u6z4bfEUDYI2', '2', NULL, 'si', NULL, NULL),
(157, '50060558T', 'Eduardo Félix', 'Rodríguez Juncá', 'orientadoriesbargas@gmail.com', '$2y$10$jTwSie9XyHdwWwMJS/8v7uxuT5l4jddjXudIkrTFLRgE9uM29UMTy', '1', 2779, 'si', 'No.', 12),
(129, '03834723W', 'Fernando', 'Ruiz de los Paños Romero', 'feruizpanos@gmail.com', '$2y$10$uY/vNkvnWRgh1Y/d9murz.yLan46Hc.8wvATL1byY..89qkA3AfQC', '1', 26293, 'si', 'No.', 6),
(130, '03895202Z', 'María Elena', 'Pérez Villaluenga', 'marihelen23_6@hotmail.com', '$2y$10$V1RFqrinAm12hTiwcfpcke7U3PdwaYZsh7E975MFwS4rktiBxfq06', '1', 65009, 'si', 'No.', 9),
(132, '03869538H', 'Alejandro', 'Antolínez Cuesta', 'aaac38@educastillalamancha.es', '$2y$10$EUFARIZtPhdmS0lKh4vpcuYeOwFsO2nG6r2zg23xStmZyjOLIZg7S', '1', 38574, 'si', 'SMR2', 8),
(149, '03860237D', 'ROBERTO', 'MARTÍN RIVERA', 'rrmr67@educastillalamancha.es', '$2y$10$QS0OorKfINaZSVCw3WF7auJZqZu0.nPPn8y6.B8.p.bILOtnaH/Ay', '1', 63597, 'si', 'B1C', 10),
(138, '12345678Z', 'Sala', 'De Profesores', 'sala@gmail.com', '$2y$10$d/.kPuTsl8e2.Od8g/vF.eaHw.bBP7P2dred0rg/tiGI8RavDe/ai', '1', 11111, 'si', 'No.', 18),
(146, '87654321X', 'Esperanza y Rocío', 'Secretaría', 'secretaria@iesbargas.com', '$2y$10$KMJUeTz2a5TWaY6rS8xQTOTb3emYkRhFd6PM6hpA9Q0dkmSBSMEoe', '3', NULL, 'si', NULL, NULL),
(147, '03843530T', 'Pilar', 'Lozano García', 'pilarlozanas@gmail.com', '$2y$10$TTlx492cQeSrL/89VkQ4j.9Fn5SPOuGEpLfMapxMOeJtk7EzO0nHe', '1', 6221, 'si', 'No.', 15),
(150, '11223344Z', 'Limpieza', 'Personal Laboral', 'limpieza@iesbargas.com', '$2y$10$1LyNea2BF07zDM0b0FhTEOb9FMESEtRE3Qr6pLJwCMmMKmW4qTwP6', '1', NULL, 'si', NULL, NULL),
(151, '03861025S', 'ROBERTO', 'DE LA CRUZ DE LA ENCINA', 'indisposicion@gmail.com', '$2y$10$2sCF/nrBTDdZ9NO3Pew8vecuSbPXwjcj4UQFj9ONm2m.9RxyseifS', '0', 25888, 'si', 'No.', 7),
(152, '48935729d', 'Nuria ', 'Planes Castilla', 'nplanes.ies@gmail.com', '$2y$10$jU84ILTyQBbJV2ByVGBNw.Ed3zJinzQFuqFMQU8PCZcKOkDdNTJtS', '1', 88684, 'si', 'CFGB2', 8),
(155, '08110112J', 'Satur', 'Sánchez Sánchez', 'satursanchez1@yahoo.es', '$2y$10$38IzEfr7U4tR1AfM6ngMGOqD2HB2tJ5PVdKnXQVus5XO5RdwYxYzC', '1', 15066, 'si', 'DIV4E', 12),
(156, '03923137G', 'Irene', 'Patiño López', 'irenepl93@gmail.com', '$2y$10$NMOxxOqJH.KlMptZ5IYxgOO6Vf6hABKb0KjSKkjpAlZoauDHqWe1q', '1', 155963, 'si', 'No.', 12),
(160, '15501356T', 'María del Mar ', 'García Ruiz ', 'm.margarcia665@gmail.com', '$2y$10$BAZwVPPK17dyTgZGHIoqVO2pW9d5GjGoYHc10sBDgNsljbQRcB3dC', '1', 26464, 'si', 'E1F', 6),
(161, '02913400J', 'M Eugenia', 'Prieto Ruiz', 'eugenia.laprofe@gmail.com', '$2y$10$sdSnJOYWXkn3jjEiUMLLFewNw2hErSLukou7wQ8fp8OqhYZPhi0ie', '1', 65152, 'si', 'E1C', 11),
(162, '05925006E', 'ANA MARÍA', 'RUIZ RODRÍGUEZ', 'anamariaruiz_1981@hotmail.com', '$2y$10$sz2a2MBreznN7J9TW30PDuzQIALUzTiWxP3RVbg4pBerkiB6QnW9W', '1', 25571, 'si', 'No.', 2),
(163, '26221816E', 'José María ', 'Ramírez Moreno ', 'josemariaramirezmoreno@gmail.com', '$2y$10$BZtCdUXnSNir6FNVb4FwbOBLcvlR2TV6T07AQ3.PCLW6Tq1jCFsMC', '1', 88684, 'si', 'CFGB2', 8),
(164, '77226247k', 'Maria', 'Ruiz ', 'maaruga16@gmail.com', '$2y$10$kUDYxZ/c2csbBtxMtA9eyu.sbHG6mHnBNJlyBqZ8Z06i1AlUrmWdq', '1', 45258, 'si', 'B2C', 10),
(165, '30239653N', 'Patricia', 'Del Valle Encuentra', 'patriciadelvalleencuentra@gmail.com', '$2y$10$XjPZOGynv212IxzZ1m6mqOEhgnABEBl7KtoSK48R9.ObepnkuEnGm', '1', 53908, 'si', 'No.', 6),
(166, '05936976D', 'Daniel', 'Rodriguez Paredes', 'danirodparedes@gmail.com', '$2y$10$lseoNpt84K2TH4ugmwxg4.6huhQkOUwWjllgBBL6wXMJm6i3dLOm.', '1', 63360, 'si', 'E4F', 2),
(167, '80152105A', 'Marcelino', 'Dueñas Olmo', 'marcelino.olmo@gmail.com', '$2y$10$w4kVwUC4w8KTTQp3b8aTvelhu2Qd3G.BoLEKUM9kOZ9qeYFMuVFOW', '1', 2644, 'si', 'No.', 12),
(168, '03926802N', 'TANIA', 'DEL CERRO SÁNCHEZ', 'ttdcs01@educastillalamancha.es', '$2y$10$gqLP2zAmXVc3XT.wEgxpUuE/VQ/UrRaMXKLFHZ.avjWkY.JgRvmJG', '1', 157714, 'si', 'No.', 5),
(169, '53842226P', 'Mohamed', 'Al Nabolsy', '59gaiz@gmail.com', '$2y$10$RGVS0bg7meUtRRcwvjq2IuRcUoi9pMn7Dsj2anHa.8MMvdhQY3im6', '1', 139638, 'si', 'E1A', 3),
(170, '03875260J', 'Carolina', 'Sanchez Rosell', 'guasasa77@hotmail.com', '$2y$10$HX88Y88.//VBV5iaSn5z7eSyF4l2XOFIK8VvMnbfqaLtjxaXAxSt2', '1', 45256, 'si', 'No.', 2),
(171, '06264797B', 'ANDRES', 'BELDAD TALAVERA', 'andresbeldad@gmail.com', '$2y$10$7vtdFVUbu8wRB.gEs2XJ4e2B7O/AXNQ4MrogATdkvZmfYeoeBEafa', '1', 139638, 'si', 'E1A', 3),
(172, '03904895R', 'Esther', 'Rozas Aragón', 'esther.rozas@gmail.com', '$2y$10$62.4lEIEUEAhhSXb5P5IZerRo/4XdVxBIqPHXheLCvVrncX5aNOs2', '1', 25536, 'si', 'No.', 14),
(173, '03902905N', 'Lucía', 'Sánchez Sánchez', 's.sanchezlucia@gmail.com', '$2y$10$T4EYAS.C52J20V8WBgUSMumekccZBx/yRmrcx49nugQmJYDELPBX.', '1', 156086, 'si', 'E2C', 2);


--
-- Estructura de tabla para la tabla `alumnosmatriculados`
--
CREATE TABLE AlumnosMatriculados (
  cod_alumnosMatriculados int(11) PRIMARY KEY AUTO_INCREMENT,
  primer_apellido_alumno varchar(25) NOT NULL,
  segundo_apellido_alumno varchar(25) NOT NULL,
  nombre_alumno varchar(25) NOT NULL,
  dni_alumno varchar(9) NOT NULL,
  sexo_alumno varchar(1) NOT NULL,
  email_alumno varchar(50) DEFAULT NULL,
  telefono_alumno varchar(15) DEFAULT NULL,
  fecha_nacimiento DATE NOT NULL,
  municipio_nacimiento varchar(120) NOT NULL,
  provincia_nacimiento varchar(120) NOT NULL,
  pais_nacimiento varchar(120),
  familia_numerosa varchar(2) NOT NULL,
  nombre_apellidos_progenitor1 varchar(120) NOT NULL,
  dni_progenitor1 varchar(9)  NOT NULL,
  telefono_progenitor1 varchar(15)  NOT NULL,
  email_progenitor1 varchar(120)  NOT NULL,
  nombre_apellidos_progenitor2 varchar(120) DEFAULT NULL,
  dni_progenitor2 varchar(9) DEFAULT NULL,
  telefono_progenitor2 varchar(15) DEFAULT NULL,
  email_progenitor2 varchar(120) DEFAULT NULL,
  calle varchar(120) DEFAULT NULL,
  numero varchar(120) DEFAULT NULL,
  portal varchar(120) DEFAULT NULL,
  piso varchar(120) DEFAULT NULL,
  puerta varchar(120) DEFAULT NULL,
  codigoPostal varchar(120) DEFAULT NULL,
  municipio varchar(120) DEFAULT NULL,
  provincia varchar(120) DEFAULT NULL,
  telefonoUrgencia varchar(120) DEFAULT NULL,
  centro varchar(120) DEFAULT NULL,
  localidad_centro varchar(120) DEFAULT NULL,
  provincia_centro varchar(120) DEFAULT NULL,
  curso_antiguo varchar(120) DEFAULT NULL,
  cambio varchar(120) DEFAULT NULL,
  trabaja varchar(120) DEFAULT NULL,
  religion varchar(2) DEFAULT NULL,
  bilingue varchar(2) DEFAULT NULL,
  ampa varchar(2) NOT NULL,
  pueblo_transporte varchar(120) DEFAULT NULL,
  urbanizacion_transporte varchar(120) DEFAULT NULL,
  fecha DATE NOT NULL
);
CREATE TABLE Matriculas (
  cod_matricula int(11) PRIMARY KEY AUTO_INCREMENT,
  curso varchar(20) NOT NULL,
  anio varchar(12) NOT NULL,
  usuario int(11),
  FOREIGN KEY (cod_matricula) REFERENCES AlumnosMatriculados(cod_alumnosMatriculados)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunes`
--
CREATE TABLE Comunes (
  matricula int(11),
  asignatura int(11) NOT NULL,
  PRIMARY KEY (matricula, asignatura),
  FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)

);

--
-- Estructura de tabla para la tabla `opcion`
--

CREATE TABLE Opciones (
  matricula int(11),
  asignatura int(11) NOT NULL,
  preferencia int(11) NOT NULL,
  PRIMARY KEY(asignatura, preferencia),
  FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)
);
--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE Modalidad (
  matricula int(11),
  asignatura int(11) NOT NULL,
  preferencia int(11) NOT NULL,
   PRIMARY KEY(matricula, asignatura),
  FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obligatorias`
--

CREATE TABLE Obligatorias (
  matricula int(11),
  asignatura int(11) NOT NULL,
  PRIMARY KEY (matricula, asignatura),
  FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)

);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optativas`
--
CREATE TABLE Optativas (
  matricula int(11) ,
  asignatura int(11),
  preferencia int(11) NOT NULL,
PRIMARY KEY(matricula, asignatura),
 FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)

);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optativas`
--
CREATE TABLE FormativosCaracterGeneral (
  matricula int(11) ,
  asignatura int(11),
PRIMARY KEY(matricula, asignatura),
 FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)

);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `optativas`
--

CREATE TABLE Profesionales (
  matricula int(11) ,
  asignatura int(11),
PRIMARY KEY(matricula, asignatura),
 FOREIGN KEY (matricula) REFERENCES Matriculas(cod_matricula),
 FOREIGN KEY (asignatura) REFERENCES Asignaturas(cod_asignatura)

);



