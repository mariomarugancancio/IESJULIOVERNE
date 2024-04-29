package com.ies.bargas.activities;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.EditText;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.navigation.NavigationView;
import com.ies.bargas.R;
import com.ies.bargas.controllers.WebService;
import com.ies.bargas.model.Alumno;
import com.ies.bargas.model.Asignatura;
import com.ies.bargas.model.Departamento;
import com.ies.bargas.model.Incidencia;
import com.ies.bargas.model.Parte;
import com.ies.bargas.util.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class AddPartsActivity extends AppCompatActivity {

    private SharedPreferences prefs;
    private Spinner spinnerCurso;
    private Spinner spinnerAlumno;
    private Spinner spinnerIncidencia;
    private Spinner spinnerAsignatura;
    private TextView incidenciaDescripcion;
    private List<Incidencia> globalInci;
    private EditText descripcion;
    private RadioGroup radioGroup;
    private CalendarView calendario;
    private Button guardar;
    private Button volver;
    private TextView error;
    private List<Alumno> globalAlumnos;
    private String globalMatricula;
    private int globalIncidencia;
    private List<Asignatura> globalAsignaturas;
    private NavigationView navigationView;

    private DrawerLayout drawerLayout;
    private ActionBarDrawerToggle toggle;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_part);

        spinnerCurso = findViewById(R.id.spinnerCurso);
        spinnerAlumno = findViewById(R.id.spinnerAlumno);
        spinnerIncidencia = findViewById(R.id.spinnerIncidencia);
        incidenciaDescripcion = findViewById(R.id.incidenciaDescripcion);
        radioGroup = findViewById(R.id.radioGroupCommunication);
        descripcion = findViewById(R.id.partDescripcion);
        calendario = findViewById(R.id.calendarView);
        guardar= findViewById(R.id.buttonSave);
        volver= findViewById(R.id.buttonBack);
        error = findViewById(R.id.errorAddPart);
        spinnerAsignatura= findViewById(R.id.spinnerAsignatura);
        // configurar el diseño del layout
        navigationView = findViewById(R.id.nav_view);
        drawerLayout = findViewById(R.id.drawer_layout);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("PARTES");
        toggle = new ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawerLayout.addDrawerListener(toggle);
        toggle.syncState();
        // establecer el nombre del usuario en el header
        View headerView = navigationView.getHeaderView(0);
        TextView navUsername = headerView.findViewById(R.id.nav_username);
        //se auto-rellenan el email y contraseña en caso de haberse guardado
        prefs = getSharedPreferences("Preferences", Context.MODE_PRIVATE);
        setCredentialsIfExist(navUsername);
        // configurar la vista de la navegacion
        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                int id = item.getItemId();
                Intent intent;
                if (id == R.id.nav_parts) {
                    // Inicia la Activity para mostrar las partes
                    intent = new Intent(AddPartsActivity.this, PartsActivity.class);
                    startActivity(intent);
                } else if (id == R.id.nav_shifts) {
                    // Inicia la Activity para mostrar las guardias
                    intent = new Intent(AddPartsActivity.this, ShiftsActivity.class);
                    startActivity(intent);
                } else if (id == R.id.nav_main) {
                    // Inicia la Activity para editar el perfil de usuario
                    intent = new Intent(AddPartsActivity.this, MainActivity.class);
                    startActivity(intent);
                } else if (id == R.id.nav_user) {
                    // Inicia la Activity para editar el perfil de usuario
                    intent = new Intent(AddPartsActivity.this, UserProfileActivity.class);
                    startActivity(intent);
                } else if (id == R.id.nav_logout) {
                    // Cierra la sesión y vuelve a la pantalla de inicio de sesión
                    Util.removeSharedPreferences(prefs);
                    intent = new Intent(AddPartsActivity.this, LoginActivity.class);
                    startActivity(intent);
                    finish();  // Cierra MainActivity
                }
                // Cierra el menú de navegación después de manejar el clic
                drawerLayout.closeDrawer(GravityCompat.START);
                return true;
            }
        });
        findAllCursos();
        //findAllIncidencias();

        //Actauliza la lista de alumnos cada vez que se seleccione un Curso
       /* spinnerCurso.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                // Obtiene el valor seleccionado del Spinner
                String grupo = (String) parentView.getItemAtPosition(position);
                findAlumnos(grupo);
                findAsignaturas(grupo);

            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
            }
        });
*/

        //Actualiza la descripcion de la incidencia
        spinnerIncidencia.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                globalIncidencia=position+1;
                incidenciaDescripcion.setText(globalInci.get(position).getDescripcion());
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
            }
        });

        spinnerAlumno.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                globalMatricula=globalAlumnos.get(position).getMatricula();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });


        guardar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AddParts();
            }
        });

        volver.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(AddPartsActivity.this, PartsActivity.class);
                startActivity(intent);
            }
        });
    }

  /*  private void findAsignaturas(String curso) {
        List<Asignatura> asignaturas = new ArrayList<Asignatura>();
        //recuperar datos
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = WebService.RAIZ + WebService.Asignaturas + "?curso=" + curso;

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;

                try {
                    if (response.length() > 0) {
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            int codAsignatura= jsonObject.getInt("cod_asignatura");
                            String nombre = jsonObject.getString("nombre");
                            int horas= jsonObject.getInt("horas");
                            String curso = jsonObject.getString("curso");
                            String tipo = jsonObject.getString("tipo");
                            Asignatura asignatura = new Asignatura(codAsignatura, nombre, horas, curso, tipo);
                            asignaturas.add(asignatura);
                        }
                        globalAsignaturas=asignaturas;
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, Asignatura.toStringNombre(asignaturas));
                        spinnerAsignatura.setAdapter(adapter1);
                    } else {
                        String[] vacio = new String[0];
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, vacio);
                        spinnerAsignatura.setAdapter(adapter1);
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ninguna asignatura", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(AddPartsActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

            }


        });
        queue.add(jsonArrayRequest);
    }*/

    private void findAllCursos() {

        //recuperar datos
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = WebService.RAIZ + WebService.Cursos;

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;

                try {
                    //Del array obtenido de la bbdd se obtiene el grupo para guardarlo directamente en un array de String
                    if (response.length() > 0) {
                        String[] opciones = new String[response.length()];
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            String grupo = jsonObject.getString("grupo");
                            opciones[i] = grupo;
                        }

                        ArrayAdapter<String> adapter2 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, opciones);
                        spinnerCurso.setAdapter(adapter2);
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ningÃºn curso", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(AddPartsActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

            }


        });
        queue.add(jsonArrayRequest);
    }

  /*  private void findAlumnos(String grupo) {
        List<Alumno> alumnos = new ArrayList<Alumno>();
        //recuperar datos
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = WebService.RAIZ + WebService.Alumnos + "?grupo=" + grupo;

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;

                try {
                    if (response.length() > 0) {
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            String matricula = jsonObject.getString("matricula");
                            String nombre = jsonObject.getString("nombre");
                            String apellidos = jsonObject.getString("apellidos");
                            Alumno alumno = new Alumno(matricula, nombre, apellidos, grupo);
                            alumnos.add(alumno);
                        }
                        globalAlumnos=alumnos;
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, Alumno.toStringNombre(alumnos));
                        spinnerAlumno.setAdapter(adapter1);
                    } else {
                        String[] vacio = new String[0];
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, vacio);
                        spinnerAlumno.setAdapter(adapter1);
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ningÃºn alumno", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(AddPartsActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

            }


        });
        queue.add(jsonArrayRequest);
    }

    private void findAllIncidencias() {
        List<Incidencia> incidencias = new ArrayList<Incidencia>();
        //recuperar datos
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = WebService.RAIZ + WebService.Incidencias;

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;

                try {
                    if(response.length()>0) {
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            int codigo= jsonObject.getInt("cod_incidencia");
                            String nombre = jsonObject.getString("nombre");
                            int puntos = jsonObject.getInt("puntos");
                            String userDescripcion = jsonObject.getString("descripcion");
                            Incidencia incidencia = new Incidencia(codigo, nombre, puntos, userDescripcion);
                            incidencias.add(incidencia);
                        }
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(AddPartsActivity.this,
                                android.R.layout.simple_spinner_item, Incidencia.toStringNombre(incidencias));
                        spinnerIncidencia.setAdapter(adapter1);

                        globalInci = incidencias;
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ninguna incidencia", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(AddPartsActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
        queue.add(jsonArrayRequest);
    }
*/
    private void AddParts(){
        /*
        if (descripcion.getText().toString().isEmpty() || !radioGroup.isSelected()){
            error.setText("AÃ±ade una descripciÃ³n y un metodo de comunicaciÃ³n");
        } else {
            prefs = getSharedPreferences("Preferences", Context.MODE_PRIVATE);
            int cod_usuario= Integer.parseInt(Util.getUserCodUsuarioPrefs(prefs));
            String matricula= globalMatricula;
            int incidencia = globalIncidencia;
            Parte parte = new Parte(cod_usuario,matricula, incidencia, );
        }
        */
    }
    private void setCredentialsIfExist(TextView navUsername) {
        String nombre = Util.getUserNombrePrefs(prefs);
        String apellidos = Util.getUserApellidosPrefs(prefs);
        if (!nombre.isEmpty() && !apellidos.isEmpty()){
            navUsername.setText(nombre+ " "+apellidos);

        }
    }
}