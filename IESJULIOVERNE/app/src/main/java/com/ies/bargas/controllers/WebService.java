package com.ies.bargas.controllers;

public class WebService {
    //public static final String RAIZ = "https://iesbargas.es/android/"; //Hosting
    public static final String RAIZ = "http://192.168.1.13/IESJULIOVERNE/android/"; //tener en cuenta en vez de poner localhost poner la ip
    public static final String LOGIN = "usuarios/login.php";
    public static final String SIGNUP = "usuarios/signup.php";
    public static final String Departamentos = "usuarios/findAllDepartamentos.php";
    public static final String Cursos = "usuarios/findAllCursos.php";
    public static final String Recover = "usuarios/recover.php";
    public static final String Modify = "usuarios/modify.php";
    public static final String Asignaturas="partes/findAsignaturas.php";
    public static final String Incidencias="partes/findAllIncidencias.php";
    public static final String Alumnos="partes/findAlumnos.php";
    public static final String InsertParts="partes/insertParts.php";
    public static final String InsertExpulsiones="partes/insertExpulsiones.php";
    public static final String SelectPartes ="partes/selectPartes.php";


}
