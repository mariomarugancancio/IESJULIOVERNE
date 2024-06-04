package com.ies.bargas.fragments;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
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
import com.ies.bargas.util.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.Serializable;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
public class GuardiasSalaProfesoresFragment extends Fragment implements Serializable {

    private ListView listViewShifts;
    private ShiftAdapter adapter;
    private ArrayList<Guardia> guardiasList;

    //Variable para el rol del usuario
    private String rol;


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_guardias_sala_profesores, container, false);
        listViewShifts = view.findViewById(R.id.listViewShiftsSalaProfesores);
        guardiasList = new ArrayList<>();

        //Obtiene el rol del usuario de las preferencias compartidas
        SharedPreferences prefs = getActivity().getSharedPreferences("Preferences", Context.MODE_PRIVATE);
        rol = Util.getUserRolPrefs(prefs);

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

                            //Filtrar por turno
                            LocalTime now = LocalTime.now();
                                //Comienzo de turno de mañana
                                LocalTime startMorning = LocalTime.of(8, 30);
                                //Fin del turno de mañana
                                LocalTime endMorning = LocalTime.of(14, 30);
                                //Comienzo del turno de tarde
                                LocalTime startAfternoon = LocalTime.of(15, 15);
                                //Fin del turno de tarde
                                LocalTime endAfternoon = LocalTime.of(21, 15);
                            //Condicion para saber en que turno se esta
                            if ((now.isAfter(startMorning) && now.isBefore(endMorning)) || (now.isAfter(startAfternoon) && now.isBefore(endAfternoon))) {
                                guardiasList.add(guardia);
                            }
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