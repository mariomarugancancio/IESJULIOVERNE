package com.ies.bargas.adapters;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.PopupMenu;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.fragment.app.FragmentManager;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.ies.bargas.R;
import com.ies.bargas.activities.parts.FloatingFragment;
import com.ies.bargas.activities.parts.ModifyPartActivity;
import com.ies.bargas.controllers.WebService;
import com.ies.bargas.model.Parte;
import com.ies.bargas.model.Parte;
import com.ies.bargas.util.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.List;

public class ParteAdapter extends BaseAdapter {

    private Context context;
    private List<Parte> partes;
    private SharedPreferences prefs;
    private String rol;
    private FragmentManager fragmentManager;


    public ParteAdapter(Context context, List<Parte> partes, FragmentManager fragmentManager) {
        this.context = context;
        this.partes = partes;
        this.prefs = context.getSharedPreferences("Preferences", Context.MODE_PRIVATE);
        this.fragmentManager= fragmentManager;
    }

    @Override
    public int getCount() {
        return partes.size();
    }

    @Override
    public Object getItem(int position) {
        return partes.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View listItemView = convertView;
        if (convertView == null) {
            listItemView = LayoutInflater.from(context).inflate(R.layout.part_list, parent, false);
        }

        rol= Util.getUserRolPrefs(prefs);


        Parte parte = partes.get(position);

<<<<<<< Updated upstream
        TextView codUsuarioView = listItemView.findViewById(R.id.cod_usuario);
        TextView codParteView = listItemView.findViewById(R.id.cod_parte);
        TextView matriculaAlumnoView = listItemView.findViewById(R.id.matricula_Alumno);
        TextView incidenciaView = listItemView.findViewById(R.id.incidencia);
        TextView materiaView = listItemView.findViewById(R.id.materia);
        TextView fechaView = listItemView.findViewById(R.id.fecha);
        TextView horaView = listItemView.findViewById(R.id.hora);
        TextView descripcionView = listItemView.findViewById(R.id.descripcion);
        TextView fechaComunicacionView = listItemView.findViewById(R.id.fecha_Comunicacion);
        TextView viaComunicacionView = listItemView.findViewById(R.id.via_Comunicacion);
        TextView tipoParteView = listItemView.findViewById(R.id.tipo_Parte);
        TextView caducadoView = listItemView.findViewById(R.id.caducado);
=======
        TextView nombre = listItemView.findViewById(R.id.nombre_Alumno);
        TextView apellidos = listItemView.findViewById(R.id.apellidos_Alumno);
        TextView puntos = listItemView.findViewById(R.id.puntos_Incidencia);
        TextView descripcion = listItemView.findViewById(R.id.descripcion_incidencia);
>>>>>>> Stashed changes

        listItemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
<<<<<<< Updated upstream
                Intent intent = new Intent(context, ModifyPartActivity.class);
                intent.putExtra("cod_parte", parte.getCod_parte());
                intent.putExtra("cod_usuario", parte.getCod_usuario());
<<<<<<< Updated upstream
                intent.putExtra("matricula_Alumno", parte.getMatriculaAlumno());
                intent.putExtra("incidencia", parte.getIncidencia());
=======
=======
                if (parte.isCaducado()==0) {

                    Intent intent = new Intent(context, ModifyPartActivity.class);
                    intent.putExtra("cod_parte", parte.getCod_parte());
                    intent.putExtra("cod_usuario", parte.getCod_usuario());

                    intent.putExtra("matricula_Alumno", parte.getMatriculaAlumno().getMatricula());
                    intent.putExtra("grupo_Alumno", parte.getMatriculaAlumno().getGrupo());
                    intent.putExtra("apellidos_Alumno", parte.getMatriculaAlumno().getApellidos());
                    intent.putExtra("nombre_Alumno", parte.getMatriculaAlumno().getNombre());

>>>>>>> Stashed changes
                intent.putExtra("materia", parte.getMateria());
                intent.putExtra("fecha", parte.getFecha().toString());
                intent.putExtra("hora", parte.getHora());
                intent.putExtra("descripcion", parte.getDescripcion());
                intent.putExtra("fecha_Comunicacion", parte.getFechaComunicacion().toString());
                intent.putExtra("via_Comunicacion", parte.getViaComunicacion());
                intent.putExtra("tipo_Parte", parte.getTipoParte());
                intent.putExtra("caducado", parte.isCaducado());
                context.startActivity(intent);
                    intent.putExtra("incidencia", parte.getIncidencia().getCodigo());
                    intent.putExtra("descripcion_incidencia", parte.getIncidencia().getDescripcion());
                    intent.putExtra("nombre_incidencia", parte.getIncidencia().getNombre());
                    intent.putExtra("puntos_incidencia", parte.getIncidencia().getPuntos());

                    intent.putExtra("materia", parte.getMateria());
                    intent.putExtra("fecha", parte.getFecha().toString());
                    intent.putExtra("hora", parte.getHora());
                    intent.putExtra("descripcion", parte.getDescripcion());
                    intent.putExtra("fecha_Comunicacion", parte.getFechaComunicacion().toString());
                    intent.putExtra("via_Comunicacion", parte.getViaComunicacion());
                    intent.putExtra("tipo_Parte", parte.getTipoParte());
                    intent.putExtra("caducado", parte.isCaducado());
                    context.startActivity(intent);
                } else
                    Toast.makeText(context, "El parte "+parte.getCod_parte()+" no se puede editar porque está caducado o usado", Toast.LENGTH_SHORT).show();
            }
        });


        listItemView.setOnLongClickListener(new View.OnLongClickListener() {
            @Override
            public boolean onLongClick(View v) {

                // Crear un objeto PopupMenu
                PopupMenu popupMenu = new PopupMenu(context, v);
                // Inflar el archivo de menú XML
                popupMenu.getMenuInflater().inflate(R.menu.menu_emergente_partes, popupMenu.getMenu());

                MenuItem titulo= popupMenu.getMenu().findItem(R.id.titulo);
                MenuItem caducar= popupMenu.getMenu().findItem(R.id.caducar);
                MenuItem eliminar= popupMenu.getMenu().findItem(R.id.eliminar);
                titulo.setTitle("Codigo: "+parte.getCod_parte());
                titulo.setEnabled(false);
                int caducidad=0;
                if (parte.isCaducado()==0){
                    caducar.setTitle("Caducar");
                    caducidad=1;
                } else if (parte.isCaducado()==1){
                    caducar.setTitle("Rehabilitar");
                } else {
                    caducar.setTitle("Usado");
                    caducar.setEnabled(false);
                    eliminar.setVisible(false);
                }
                if (!rol.equals("0"))
                    eliminar.setVisible(false);

                // Configurar un listener para manejar la selección de elementos del menú
                final int finalCaducidad = caducidad;
                popupMenu.setOnMenuItemClickListener(new PopupMenu.OnMenuItemClickListener() {
                    @Override
                    public boolean onMenuItemClick(MenuItem item) {
                        if (item.getItemId() == R.id.eliminar) {


                            RequestQueue queue = Volley.newRequestQueue(context);
                            String url = WebService.RAIZ + WebService.deleteParte + "?"
                                    + "cod_parte=" + parte.getCod_parte();

                            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                                    new Response.Listener<String>() {
                                        @Override
                                        public void onResponse(String response) {
                                            int respuesta= Integer.parseInt(response);
                                            if (respuesta==0){
                                                Toast.makeText(context, "No se ha podido eliminar porque no existe el parte ¯\\_( ͡° ͜ʖ ͡°)_/¯", Toast.LENGTH_SHORT).show();
                                            } else if (respuesta==1){
                                                Toast.makeText(context, "El parte "+ parte.getCod_parte()+" Ha sido eliminado correctamente", Toast.LENGTH_SHORT).show();
                                                partes.remove(parte);
                                                sumarPuntos(parte);
                                            } else {
                                                Toast.makeText(context, "Algo ha fallado durante la eliminación, no preguntes el qué ¯\\_( ͡° ͜ʖ ͡°)_/¯", Toast.LENGTH_LONG).show();
                                            }
                                        }
                                    },
                                    new Response.ErrorListener() {
                                        @Override
                                        public void onErrorResponse(VolleyError error) {
                                            Toast.makeText(context, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
                                        }
                                    });
                            queue.add(stringRequest);


                            return true;
                        }
                        else if (item.getItemId() == R.id.caducar){
                            RequestQueue queue = Volley.newRequestQueue(context);
                            String url = WebService.RAIZ + WebService.caducarParte + "?"
                                    + "cod_parte=" + parte.getCod_parte()
                                    + "&caducado=" + finalCaducidad;

                            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                                    new Response.Listener<String>() {
                                        @Override
                                        public void onResponse(String response) {
                                            int respuesta= Integer.parseInt(response);
                                            if (respuesta==0){
                                                Toast.makeText(context, "No se ha podido modificar la caducidad porque no existe el parte ¯\\_( ͡° ͜ʖ ͡°)_/¯", Toast.LENGTH_SHORT).show();
                                            } else if (respuesta==1){
                                                Toast.makeText(context, "La caducidad del parte "+ parte.getCod_parte()+" Ha sido modificado correctamente", Toast.LENGTH_SHORT).show();
                                                partes.get(partes.indexOf(parte)).setCaducado(finalCaducidad);
                                                sumarPuntos(parte);
                                            } else {
                                                Toast.makeText(context, "Algo ha fallado durante la modificacion de la caducidad, no preguntes el qué ¯\\_( ͡° ͜ʖ ͡°)_/¯", Toast.LENGTH_LONG).show();
                                            }
                                        }
                                    },
                                    new Response.ErrorListener() {
                                        @Override
                                        public void onErrorResponse(VolleyError error) {
                                            Toast.makeText(context, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
                                        }
                                    });
                            queue.add(stringRequest);


                            return true;
                        }
                        return false;
                    }
                });
                popupMenu.show();
                return true;
            }
        });

<<<<<<< Updated upstream
        codUsuarioView.setText("Profesor: " + parte.getCod_usuario());
        codParteView.setText("Código: " + parte.getCod_parte());
        matriculaAlumnoView.setText("Alumno: " + parte.getMatriculaAlumno());
        incidenciaView.setText("Incidencia: " + parte.getIncidencia());
        materiaView.setText("Materia: " + parte.getMateria());
        fechaView.setText("Fecha: " + parte.getFecha().toString());
        horaView.setText("Hora: " + parte.getHora());
        descripcionView.setText("Descripción: " + parte.getDescripcion());
        fechaComunicacionView.setText("Fecha de Comunicación: " + parte.getFechaComunicacion().toString());
        viaComunicacionView.setText("Vía de Comunicación: " + parte.getViaComunicacion());
        tipoParteView.setText("Tipo de Parte: " + parte.getTipoParte());
        caducadoView.setText("¿Caducado?: " + parte.isCaducado());
=======
        nombre.setText("Nombre: " + parte.getMatriculaAlumno().getNombre());
        apellidos.setText("Apellidos: " + parte.getMatriculaAlumno().getApellidos());
        puntos.setText("Puntos: " + parte.getIncidencia().getPuntos());
        descripcion.setText("Incidencia: " + parte.getIncidencia().getDescripcion());
>>>>>>> Stashed changes

        return listItemView;
    }

    public void sumarPuntos(Parte parte){
        RequestQueue queue = Volley.newRequestQueue(context);
        String url = WebService.RAIZ + WebService.SelectPartes + "?" +
                "matricula=" + parte.getMatriculaAlumno().getMatricula();

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;
                try {

                    int puntos = 0;

                    if (response.length() > 0) {
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            int punto = jsonObject.getInt("puntos");
                            puntos += punto;
                        }
                    }

                    Toast.makeText(context, parte.getMatriculaAlumno().getNombre() + " tiene " + puntos + " puntos", Toast.LENGTH_SHORT).show();

                    if (puntos > 9) {
                        FloatingFragment floatingFragment = FloatingFragment.newInstance(parte.getMatriculaAlumno(), parte.getCod_usuario());
                        floatingFragment.show(fragmentManager, "floatingFragment");
                    } else {
                        comprobarExpulsion(parte);
                    }
                } catch (JSONException e) {
                    Toast.makeText(context, "ERROR: No se encontro ningún parte", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context ,"ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
            }
        });

        queue.add(jsonArrayRequest);
    }

    private void comprobarExpulsion(Parte parte){
        //Comprueba si esta ya expulsado

        RequestQueue queue = Volley.newRequestQueue(context);
        String url;


        url = WebService.RAIZ + WebService.comprobarExpulsion + "?"
                + "matricula=" + parte.getMatriculaAlumno().getMatricula();

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        int respuesta= Integer.parseInt(response);
                        if (respuesta==1)
                            eliminarExpulsion(parte);
                        else
                            notifyDataSetChanged();

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                });
        queue.add(stringRequest);
    }

    private void eliminarExpulsion(Parte parte){

        RequestQueue queue = Volley.newRequestQueue(context);
        String url;


        url = WebService.RAIZ + WebService.deleteExpulsion + "?"
                + "matricula_del_Alumno=" + parte.getMatriculaAlumno().getMatricula();

        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        int respuesta= Integer.parseInt(response);
                        if (respuesta==0){
                            Toast.makeText(context, "No se ha encontrado ninguna expulsion a eliminar", Toast.LENGTH_LONG).show();
                        }else if (respuesta==1){
                            Toast.makeText(context, "Eliminado la expulsion", Toast.LENGTH_LONG).show();
                        } else {
                            Toast.makeText(context, "No se ha eliminado la expulsion encontrada", Toast.LENGTH_LONG).show();
                        }
                        notifyDataSetChanged();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
                    }
                });
        queue.add(stringRequest);
    }

}
