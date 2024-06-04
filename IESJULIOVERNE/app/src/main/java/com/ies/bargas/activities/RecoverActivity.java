package com.ies.bargas.activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.ies.bargas.R;
import com.ies.bargas.controllers.WebService;

import org.json.JSONArray;

public class RecoverActivity extends AppCompatActivity {
    private EditText editTextEmail;
    private Button btnEmailRecuperar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recover);

        editTextEmail = findViewById(R.id.editTextEmailRecuperar);
        btnEmailRecuperar = findViewById(R.id.btnEmailRecuperar);
        //recuperar datos
        btnEmailRecuperar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                RequestQueue queue = Volley.newRequestQueue(RecoverActivity.this);
                String email = editTextEmail.getText().toString();
                String url = WebService.RAIZ + WebService.Recover+ "?email=" + email ;

                StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(RecoverActivity.this, response, Toast.LENGTH_LONG).show();
                        Intent intent = new Intent(RecoverActivity.this, LoginActivity.class);
                       startActivity(intent);
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                        Toast.makeText(RecoverActivity.this, "ERROR: " + error.getMessage(), Toast.LENGTH_LONG).show();

                    }


                });
                queue.add(stringRequest);
            }
        });

    }
}