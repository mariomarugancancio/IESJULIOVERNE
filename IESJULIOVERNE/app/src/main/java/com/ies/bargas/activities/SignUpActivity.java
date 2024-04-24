package com.ies.bargas.activities;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.ies.bargas.controllers.WebService;
import com.ies.bargas.model.Curso;
import com.ies.bargas.model.Departamento;
import com.ies.bargas.model.User;
import com.ies.bargas.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class SignUpActivity extends AppCompatActivity {

    //Declarar vistas
    private EditText editTextDNI;
    private EditText editTextName;
    private EditText editTextSurnames;
    private EditText editTextEmail;
    private EditText editTextPassword;
    private EditText editTextCodDelphos;
    private Spinner spinnerDto;
    private Spinner spinnerTutor;
    private LinearLayout layoutProfesor;
    private RadioGroup radioGroupRole;
    private RadioButton radioButtonProfesor;
    private RadioButton radioButtonMantenimiento;
    private RadioButton radioButtonConserje;
    private Button buttonRegister;

    private TextView error;
    private TextView textViewLogin;
    private TextView textViewRecover;

    private List<Departamento> dtoGlobal = new ArrayList<Departamento>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        //Inicializamos las vistas
        editTextDNI = findViewById(R.id.editTextDNI);
        editTextName = findViewById(R.id.editTextName);
        editTextSurnames = findViewById(R.id.editTextSurnames);
        editTextEmail = findViewById(R.id.editTextEmail);
        editTextPassword = findViewById(R.id.editTextPassword);
        editTextCodDelphos = findViewById(R.id.editTextCodDelphos);
        spinnerDto = findViewById(R.id.spinnerDto);
        spinnerTutor = findViewById(R.id.spinnerTutor);
        layoutProfesor = findViewById(R.id.layoutProfesor);
        radioGroupRole = findViewById(R.id.radioGroupRole);
        radioButtonProfesor = findViewById(R.id.radioButtonProfesor);
        radioButtonMantenimiento = findViewById(R.id.radioButtonMantenimiento);
        radioButtonConserje = findViewById(R.id.radioButtonConserje);
        buttonRegister = findViewById(R.id.buttonRegister);
        error = findViewById(R.id.error);
        textViewLogin = findViewById(R.id.textViewLogin);
        textViewRecover = findViewById(R.id.textViewRecoverSignUp);
        // Configuración de los Spinners con los arrays de strings definidos en strings.xml

        //Recuperar Departamentos y cursos


        findAllDepartamentos();
        findAllCursos();




      /*  ArrayAdapter<CharSequence> adapterDto = ArrayAdapter.createFromResource(this,
                R.array.array_departamentos, android.R.layout.simple_spinner_item);
        adapterDto.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerDto.setAdapter(adapterDto);

        ArrayAdapter<CharSequence> adapterTutor = ArrayAdapter.createFromResource(this,
                R.array.array_tutores, android.R.layout.simple_spinner_item);
        adapterTutor.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerTutor.setAdapter(adapterTutor);*/

        // Configuración del escuchador del RadioGroup para mostrar u ocultar el layoutProfesor en función del rol seleccionado
        radioGroupRole.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                if (checkedId == R.id.radioButtonProfesor) {
                    layoutProfesor.setVisibility(View.VISIBLE);
                } else {
                    layoutProfesor.setVisibility(View.GONE);
                }
            }
        });

        // Configuración del escuchador del botón de registro para crear un nuevo usuario cuando se hace clic en el botón
        buttonRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                registerUser();
            }
        });
        textViewLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navegar a RegistrarActivity
                Intent intent = new Intent(SignUpActivity.this, LoginActivity.class);
                startActivity(intent);
            }
        });

        textViewRecover.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navegar a RegistrarActivity
                Intent intent = new Intent(SignUpActivity.this, RecoverActivity.class);
                startActivity(intent);            }
        });
    }

    private void findAllDepartamentos() {
        List<Departamento> departamentos = new ArrayList<Departamento>();
        //recuperar datos
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = WebService.RAIZ + WebService.Departamentos;

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;

                try {
                    if(response.length()>0) {
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            int codigo = jsonObject.getInt("codigo");
                            String nombre = jsonObject.getString("nombre");
                            Departamento departamento = new Departamento(codigo, nombre);
                            departamentos.add(departamento);
                        }
                        dtoGlobal = departamentos;
                        ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(SignUpActivity.this,
                                android.R.layout.simple_spinner_item, Departamento.toStringNombre(departamentos));
                        spinnerDto.setAdapter(adapter1);

                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ningún departamento", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(SignUpActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

            }


        });
        queue.add(jsonArrayRequest);
    }

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
                    if(response.length()>0) {
                        String[] opciones = new String[response.length()+1];
                        opciones[0]="Ninguno";
                        for (int i = 0; i < response.length(); i++) {

                            jsonObject = response.getJSONObject(i);

                            String grupo = jsonObject.getString("grupo");
                            opciones[i+1]=grupo;
                        }

                        ArrayAdapter<String> adapter2 = new ArrayAdapter<String>(SignUpActivity.this,
                                android.R.layout.simple_spinner_item, opciones);
                        spinnerTutor.setAdapter(adapter2);
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "ERROR: No se encontro ningún curso", Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(SignUpActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

            }


        });
        queue.add(jsonArrayRequest);
    }

    //Registrar un nuevo user
    private void registerUser() {

        //Obtener datos introducidos por el user
        String dni = editTextDNI.getText().toString();
        String name = editTextName.getText().toString();
        String surnames = editTextSurnames.getText().toString();
        String email = editTextEmail.getText().toString();
        String password = editTextPassword.getText().toString();
        String dto = spinnerDto.getSelectedItem().toString();
        int dtoCodigo=0;
        String tutor = spinnerTutor.getSelectedItem().toString();
        String codDelphos = editTextCodDelphos.getText().toString();
        String rol = "0";

        boolean incompleto=false;
        boolean campoComun=(dni.isEmpty() || name.isEmpty() || surnames.isEmpty() || email.isEmpty() || password.isEmpty());
        User newUser= new User();



        if (campoComun){
            incompleto=true;
        } else {
            if(radioButtonMantenimiento.isChecked()){
                rol="2";
                newUser=new User(email, password, name, surnames, dni, 0, "no", null, null, rol);
            } else if (radioButtonConserje.isChecked()){
                rol="3";
                newUser=new User(email, password, name, surnames, dni, 0, "no", null, null, rol);
            } else if (radioButtonProfesor.isChecked()){
                if (dto.isEmpty() || tutor.isEmpty() || codDelphos.isEmpty()){
                    incompleto=true;
                } else {
                    rol="1";
                    //aprovechando el array de Dto del metodo anterior se extrae el codigo
                    for (Departamento d: dtoGlobal){
                        if (d.getNombre().equals(dto))
                            newUser=new User(email, password, name, surnames, dni,Integer.parseInt(codDelphos), "no", d, tutor, rol);
                    }

                }
            } else {
                incompleto=true;
            }
        }

        if (!incompleto){
            error.setText("");


            //recuperar datos
            String url;
            RequestQueue queue;
            if(newUser.getRol() == "1") {
                queue = Volley.newRequestQueue(this);
                url = WebService.RAIZ + WebService.SIGNUP + "?"
                        + "email=" + newUser.getEmail()
                        + "&clave=" + newUser.getClave()
                        + "&nombre=" + newUser.getNombre()
                        + "&apellidos=" + newUser.getApellidos()
                        + "&dni=" + newUser.getDni()
                        + "&cod_delphos=" + newUser.getCod_delphos()
                        + "&departamento=" + newUser.getDepartamento().getCodigo()
                        + "&tutor_grupo=" + newUser.getTutor_grupo()
                        + "&rol=" + newUser.getRol();

            }else{
                queue = Volley.newRequestQueue(this);
                url = WebService.RAIZ + WebService.SIGNUP + "?"
                        + "email=" + newUser.getEmail()
                        + "&clave=" + newUser.getClave()
                        + "&nombre=" + newUser.getNombre()
                        + "&apellidos=" + newUser.getApellidos()
                        + "&dni=" + newUser.getDni()
                        + "&rol=" + newUser.getRol();

            }

            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            // Aquí manejas la respuesta del servidor
                            int numero = Integer.parseInt(response);
                            if (numero==0){
                                error.setText("Correo o DNI ya registrado");
                            } else if (numero==1){
                                Toast.makeText(getApplicationContext(), "El usuario se ha registrado correctamente", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(SignUpActivity.this, LoginActivity.class);
                                startActivity(intent);
                            } else {
                                Toast.makeText(getApplicationContext(), "No se ha podido guardar el usuario, no preguntes por qué", Toast.LENGTH_LONG).show();
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(SignUpActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();
                        }
                    });
            queue.add(stringRequest);

        } else {
            error.setText("Rellena todos los campos");
        }
    }
}
