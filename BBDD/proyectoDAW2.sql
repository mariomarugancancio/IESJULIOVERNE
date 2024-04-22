DROP DATABASE IF EXISTS Proyectodaw;
CREATE DATABASE Proyectodaw;
USE Proyectodaw;

-- tabla cursos

CREATE TABLE Cursos (
  grupo varchar(20) NOT NULL PRIMARY KEY,
  aula varchar(20)
);
-- tabla departamento
CREATE TABLE Departamentos (
codigo SMALLINT PRIMARY KEY AUTO_INCREMENT,
referencia VARCHAR(5),
nombre VARCHAR(100)  NOT NULL,
jefe VARCHAR(50),
ubicacion VARCHAR(5)
);

-- tabla usuarios
CREATE TABLE Usuarios (
cod_usuario INT PRIMARY KEY AUTO_INCREMENT,
dni VARCHAR(9) UNIQUE NOT NULL,
nombre VARCHAR(50) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
clave VARCHAR(255) NOT NULL,
rol VARCHAR(2) NOT NULL,
cod_delphos INT,
validar VARCHAR(2) NOT NULL,
departamento SMALLINT,
tutor_grupo varchar(20),
FOREIGN KEY (departamento) REFERENCES Departamentos(codigo) ON DELETE SET NULL
);

-- tabla tareas
CREATE TABLE Tareas (
cod_tarea INT PRIMARY KEY AUTO_INCREMENT,
estado VARCHAR(50) NOT NULL,
nivel_tarea VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
comentario VARCHAR(255),
imagen LONGBLOB,
localizacion VARCHAR(60) NOT NULL,
fecha_inicio DATE NOT NULL,
fecha_fin DATE,
cod_usuario_gestion INT,
cod_usuario_crea INT,
tipo_incidencia VARCHAR(50),
FOREIGN KEY (cod_usuario_gestion) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (cod_usuario_crea) REFERENCES Usuarios(cod_usuario)
);

-- tabla tareas Finalizadas
CREATE TABLE TareasFinalizadas (
cod_tarea INT PRIMARY KEY,
estado VARCHAR(50) NOT NULL,
nivel_tarea VARCHAR(50) NOT NULL,
descripcion VARCHAR(255) NOT NULL,
comentario VARCHAR(255),
imagen LONGBLOB,
localizacion VARCHAR(60) NOT NULL,
fecha_inicio DATE NOT NULL,
fecha_fin DATE,
cod_usuario_gestion INT,
cod_usuario_crea INT,
tipo_incidencia VARCHAR(50),
FOREIGN KEY (cod_usuario_gestion) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (cod_usuario_crea) REFERENCES Usuarios(cod_usuario)
);
-- tabla articulo
CREATE TABLE Articulos (
codigo INT PRIMARY KEY AUTO_INCREMENT,
fecha_alta DATE,
num_serie VARCHAR(20),
nombre VARCHAR(50) NOT NULL,
descripcion VARCHAR(255),
unidades INT(5) NOT NULL,
localizacion VARCHAR(50) NOT NULL,
procedencia_entrada VARCHAR(200),
motivo_baja VARCHAR(200),
fecha_baja DATE,
ruta_imagen LONGBLOB
);

-- tabla articulo
CREATE TABLE Fungibles (
codigo INT PRIMARY KEY,
pedir VARCHAR(2),
FOREIGN KEY (codigo) REFERENCES Articulos(codigo)
);

-- tabla articulo
CREATE TABLE Nofungibles (
codigo INT PRIMARY KEY,
fecha INT(4),
FOREIGN KEY (codigo) REFERENCES Articulos(codigo)
);

-- tabla tiene
CREATE TABLE Tiene (
cod_articulo INT,
cod_departamento SMALLINT,
PRIMARY KEY (cod_articulo, cod_departamento),
FOREIGN KEY (cod_articulo) REFERENCES Articulos(codigo),
FOREIGN KEY (cod_departamento) REFERENCES Departamentos(codigo)
);

-- tabla periodos
CREATE TABLE Periodos (
cod_periodo INT PRIMARY KEY,
inicio time NOT NULL,
fin time NOT NULL

);

-- tabla guardias
CREATE TABLE Guardias (
cod_guardias INT PRIMARY KEY AUTO_INCREMENT,
fecha DATE NOT NULL,
observaciones VARCHAR(255),
periodo INT(2) NOT NULL,
cod_usuario INT NOT NULL,
FOREIGN KEY (cod_usuario) REFERENCES Usuarios(cod_usuario),
FOREIGN KEY (periodo) REFERENCES Periodos (cod_periodo),
UNIQUE(fecha, periodo, cod_usuario)
);

-- tabla horarios
CREATE TABLE Horarios(
cod_horario INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50),
apellidos VARCHAR(50),
dia VARCHAR(15),
inicio time,
fin time,
clase VARCHAR(100),
cod_usuario INT,
FOREIGN KEY (cod_usuario) REFERENCES Usuarios(cod_usuario)
);

-- valores de la tabla cursos

INSERT INTO Cursos (grupo, aula) VALUES
('B1A', NULL),
('B1B', NULL),
('B1C', NULL),
('B1D', NULL),
('B2A', NULL),
('B2B', NULL),
('B2C', NULL),
('CFGB1', NULL),
('CFGB2', NULL),
('DAM1', NULL),
('DAM2', NULL),
('DAW1', NULL),
('DAW2', NULL),
('DIV3A', NULL),
('DIV3B', NULL),
('DIV4E', NULL),
('DIV4F', NULL),
('E1A', NULL),
('E1B', NULL),
('E1C', NULL),
('E1D', NULL),
('E1E', NULL),
('E1F', NULL),
('E2A', NULL),
('E2B', NULL),
('E2C', NULL),
('E2D', NULL),
('E2E', NULL),
('E2F', NULL),
('E2G', NULL),
('E3A', NULL),
('E3B', NULL),
('E3C', NULL),
('E3D', NULL),
('E3E', NULL),
('E4A', NULL),
('E4B', NULL),
('E4C', NULL),
('E4D', NULL),
('E4E', NULL),
('E4F', NULL),
('PEFP1', NULL),
('PEFP2', NULL),
('SMR1', NULL),
('SMR2', NULL);
-- valores de las tabla departamentos
INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('fra', 'DPTO Francés', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('ing', 'DPTO Inglés', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('tec', 'DPTO Tecnología', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('rel', 'DPTO Religión', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('mat', 'DPTO Matemáticas', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('ef', 'DPTO Educación física', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('dib', 'DPTO Dibujo', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('inf', 'DPTO Informática', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('len', 'DPTO Lengua', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('fil', 'DPTO Filosofía', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('geh', 'DPTO Geografía e historia', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('ori', 'DPTO Orientación', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('fyq', 'DPTO Física y química', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('mus', 'DPTO Música', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('bio', 'DPTO Biología y geología', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('gri', 'DPTO Griego', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('eco', 'DPTO Economía', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('fol', 'DPTO FOL', 'x', 'xxx');

INSERT INTO Departamentos(referencia, nombre, jefe, ubicacion)
VALUES('IESJV', 'DPTO CENTRO', 'x', 'xxx');

-- valores de las tabla usuarios
 INSERT INTO Usuarios(dni,nombre, apellidos, email, clave, rol, validar, departamento)
 VALUES('11111111a', 'administrador', 'administrador', 'incidenciasiesbargas@gmail.com','$2y$10$q.b1SyM1jZkK5x1iGIyb9eBmBh7AxiHgIgFmoYfPBUjCkUfhtfsSy',0,'si', (SELECT codigo FROM Departamentos WHERE nombre = "DPTO informática"));

-- valores de las tabla periodos
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(1, '8:30', '9:25');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(2, '9:25', '10:20');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(3, '10:20', '11:15');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(4, '11:45', '12:40');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(5, '12:40', '13:35');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(6, '13:35', '14:25');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(7, '15:15', '16:10');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(8, '16:10', '17:05');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(9, '17:05', '18:00');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(10, '18:30', '19:25');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(11, '19:25', '20:20');
INSERT INTO Periodos (cod_periodo, inicio, fin) VALUES(12, '20:20', '21:15');



CREATE TABLE Reservas(
  id INT PRIMARY KEY AUTO_INCREMENT,
  autor INT NOT NULL,
  aula VARCHAR(150) NOT NULL,
  fecha DATE NOT NULL, inicio TIME NOT NULL, fin TIME NOT NULL,
  comentario VARCHAR(255),
  FOREIGN KEY (autor) REFERENCES usuarios(cod_usuario),
  UNIQUE uniqueCombination (aula, fecha, inicio, fin)
);



CREATE TABLE Alumnos (
  matricula varchar(20) PRIMARY KEY,
  nombre varchar(30) NOT NULL,
  apellidos varchar(50),
  grupo varchar(20),
  FOREIGN KEY (grupo) REFERENCES cursos(grupo)
);




CREATE TABLE Incidencias (
  nombre varchar(100) NOT NULL,
  puntos int(11) NOT NULL,
  descripcion text,
  PRIMARY KEY (nombre, puntos)
);

CREATE TABLE Partes (
  cod_parte INT NOT NULL,
  cod_usuario INT NOT NULL,
  matricula_Alumno varchar(20) NOT NULL,
  incidencia varchar(100) NOT NULL,
  puntos int(11) NOT NULL,
  materia varchar(40) DEFAULT NULL,
  fecha date NOT NULL,
  hora time NOT NULL,
  descripcion text,
  fecha_Comunicacion date NOT NULL,
  via_Comunicacion varchar(25) NOT NULL,
  tipo_Parte varchar(20) NOT NULL,
  caducado tinyint(1) NOT NULL,
  PRIMARY KEY (cod_parte),
  FOREIGN KEY (cod_usuario) REFERENCES usuarios(cod_usuario)
);

CREATE TABLE Expulsiones (
  cod_expulsion  INT NOT NULL,
  cod_usuario  INT NOT NULL,
  matricula_del_Alumno varchar(20) NOT NULL,
  fecha_Inicio date DEFAULT NULL,
  Fecha_Fin date DEFAULT NULL,
  fecha_Insercion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (cod_expulsion),
  FOREIGN KEY (cod_usuario) REFERENCES usuarios(cod_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (matricula_del_Alumno) REFERENCES alumnos(matricula) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE PartesExpulsiones (
  cod_parte  INT NOT NULL,
  cod_expulsion  INT NOT NULL,
  PRIMARY KEY (cod_parte, cod_expulsion),
  FOREIGN KEY (cod_parte) REFERENCES Partes(cod_parte),
  FOREIGN KEY (cod_expulsion) REFERENCES Expulsiones(cod_expulsion)
);

INSERT INTO Cursos (grupo, aula) VALUES
('B1A', NULL),
('B1B', NULL),
('B1C', NULL),
('B1D', NULL),
('B2A', NULL),
('B2B', NULL),
('B2C', NULL),
('CFGB1', NULL),
('CFGB2', NULL),
('DAM1', NULL),
('DAM2', NULL),
('DAW1', NULL),
('DAW2', NULL),
('DIV3A', NULL),
('DIV3B', NULL),
('DIV4E', NULL),
('DIV4F', NULL),
('E1A', NULL),
('E1B', NULL),
('E1C', NULL),
('E1D', NULL),
('E1E', NULL),
('E1F', NULL),
('E2A', NULL),
('E2B', NULL),
('E2C', NULL),
('E2D', NULL),
('E2E', NULL),
('E2F', NULL),
('E2G', NULL),
('E3A', NULL),
('E3B', NULL),
('E3C', NULL),
('E3D', NULL),
('E3E', NULL),
('E4A', NULL),
('E4B', NULL),
('E4C', NULL),
('E4D', NULL),
('E4E', NULL),
('E4F', NULL),
('PEFP1', NULL),
('PEFP2', NULL),
('SMR1', NULL),
('SMR2', NULL);