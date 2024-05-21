package com.ies.bargas.fragments;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.ContextMenu;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.ies.bargas.activities.shifts.AddShiftsActivity;
import com.ies.bargas.adapters.ShiftAdapter;
import com.ies.bargas.controllers.WebService;

import com.ies.bargas.R;
import com.ies.bargas.model.Guardia;
import com.ies.bargas.model.Periodo;
import com.ies.bargas.model.User;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class GuardiasSalaProfesoresFragment extends Fragment implements Serializable {

    private ListView listViewShifts;
    private ShiftAdapter adapter;
    private ArrayList<Guardia> guardiasList;



    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_guardias_sala_profesores, container, false);
        listViewShifts = view.findViewById(R.id.listViewShiftsSalaProfesores);
        guardiasList = new ArrayList<>();
        //Cargar los datos
        cargarDatos();




        //Devolver la vista
        return view;
    }


    // Método para cargar datos en el ListView
    private void cargarDatos() {
        String url = WebService.RAIZ + WebService.ObtenerGuardiasSalaProfesores;
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url,
                response -> {
                    try {
                        guardiasList.clear();
                        for (int i = 0; i < response.length(); i++) {
                            JSONObject jsonObject = response.getJSONObject(i);
                            User user = new User(jsonObject.getInt("cod_usuario"), jsonObject.getString("nombre"),jsonObject.getString("apellidos"), jsonObject.getInt("delphos"));

                            Periodo periodo = new Periodo (jsonObject.getString("periodoinicio"), jsonObject.getString("periodofin"));
                            DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("yyyy-MM-dd", Locale.US);
                            LocalDate localDate = LocalDate.parse(jsonObject.getString("fecha"), dateFormatter);
                            String clase = jsonObject.getString("clase");
                            Guardia guardia = new Guardia( jsonObject.getInt("cod_guardias"), jsonObject.getString("observaciones"), user,
                                    localDate, periodo, clase);
                            guardiasList.add(guardia);


                        }

                        adapter = new ShiftAdapter(getActivity(), R.layout.list_view_item_shifts, guardiasList);
                        listViewShifts.setAdapter(adapter);
                        registerForContextMenu(listViewShifts);
                        adapter.notifyDataSetChanged();
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                },
                //Manejar errores
                error -> {
                    error.printStackTrace();
                });
        Volley.newRequestQueue(getActivity()).add(jsonArrayRequest);
    }
}