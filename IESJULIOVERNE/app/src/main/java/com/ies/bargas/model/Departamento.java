package com.ies.bargas.model;

import java.util.ArrayList;
import java.util.List;

public class Departamento {
    private int codigo;
    private String nombre;
    private String jefe;
    private String referencia;
    private String ubicacion;

    public Departamento(int codigo, String nombre, String jefe, String referencia, String ubicacion) {
        this.codigo = codigo;
        this.nombre = nombre;
        this.jefe = jefe;
        this.referencia = referencia;
        this.ubicacion = ubicacion;
    }
    public Departamento(int codigo, String nombre) {
        this.codigo = codigo;
        this.nombre = nombre;
    }

    public Departamento() {
    }

    public int getCodigo() {
        return codigo;
    }

    public void setCodigo(int codigo) {
        this.codigo = codigo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getJefe() {
        return jefe;
    }

    public void setJefe(String jefe) {
        this.jefe = jefe;
    }

    public String getReferencia() {
        return referencia;
    }

    public void setReferencia(String referencia) {
        this.referencia = referencia;
    }

    public String getUbicacion() {
        return ubicacion;
    }

    public void setUbicacion(String ubicacion) {
        this.ubicacion = ubicacion;
    }

    @Override
    public String toString() {
        return "Departamento{" +
                "codigo=" + codigo +
                ", nombre='" + nombre + '\'' +
                ", jefe='" + jefe + '\'' +
                ", referencia='" + referencia + '\'' +
                ", ubicacion='" + ubicacion + '\'' +
                '}';
    }

    public static String[] toStringNombre(List<Departamento> departamentos) {
        String [] lista = new String[departamentos.size()];
        for(int i=0;i<departamentos.size();i++){
            lista [i] = departamentos.get(i).getNombre();
        }
        return lista;
    }
}
