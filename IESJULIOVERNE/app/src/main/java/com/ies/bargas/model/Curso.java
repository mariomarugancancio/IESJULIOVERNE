package com.ies.bargas.model;

import java.util.ArrayList;
import java.util.List;

public class Curso {
    private String grupo;
    private String aula;

    public Curso(String grupo, String aula) {
        this.grupo = grupo;
        this.aula = aula;
    }

    public Curso(String grupo) {
        this.grupo = grupo;
    }

    public Curso() {
    }

    public String getGrupo() {
        return grupo;
    }

    public void setGrupo(String grupo) {
        this.grupo = grupo;
    }

    public String getAula() {
        return aula;
    }

    public void setAula(String aula) {
        this.aula = aula;
    }

    @Override
    public String toString() {
        return "Curso{" +
                "grupo='" + grupo + '\'' +
                ", aula='" + aula + '\'' +
                '}';
    }
    public static String [] toStringNombre(List<Curso> cursos) {
        String [] lista = new String [cursos.size()];
        for(int i=0;i<cursos.size();i++){
            lista [i] = cursos.get(i).getGrupo();
        }
        return lista;
    }
}
