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
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class GuardiasTotalFragment extends Fragment implements Serializable {

    private ListView listViewShifts;
    private ShiftAdapter adapter;
    private ArrayList<Guardia> guardiasList;

    private SharedPreferences prefs;


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_guardias_total, container, false);
        listViewShifts = view.findViewById(R.id.listViewShifts);
        guardiasList = new ArrayList<>();
        //Cargar los datos
        cargarDatos();
        //Devolver la vista
        return view;
    }

    @Override
    public void onCreateContextMenu(ContextMenu menu, View v, ContextMenu.ContextMenuInfo menuInfo) {
        super.onCreateContextMenu(menu, v, menuInfo);
        //Inflamos el context menu con nuestro layout
        getActivity().getMenuInflater().inflate(R.menu.context_menu_shifts, menu);
    }

    @Override
    public boolean onContextItemSelected(MenuItem item) {
        //Obtener info en el context menu del objeto que se pinche
        AdapterView.AdapterContextMenuInfo info = (AdapterView.AdapterContextMenuInfo) item.getMenuInfo();
        Guardia guardiaSeleccionada = guardiasList.get(info.position);
        if (item.getItemId() == R.id.edit) {
            // Ir a la actividad de agregar/editar guardia
            Intent intent = new Intent(getActivity(), AddShiftsActivity.class);
            intent.putExtra("guardia", (Serializable) guardiaSeleccionada);
            startActivity(intent);
        } else if (item.getItemId() == R.id.delete) {
            // Llamar al archivo PHP para eliminar la guardia
            String url = WebService.RAIZ + WebService.Delete + "?cod_guardias=" + guardiaSeleccionada.getCod_guardia();
            StringRequest request = new StringRequest(Request.Method.GET, url,
                    response -> {
                        //Comprobar si la eliminación fue exitosa
                        if (response.equals("Guardia eliminada correctamente")) {
                            // Eliminar la guardia de la lista y actualizar el ListView
                            guardiasList.remove(info.position);
                            adapter.notifyDataSetChanged();
                        } else {
                            //Mostrar un mensaje de error
                            Toast.makeText(getActivity(), "Error al eliminar la guardia", Toast.LENGTH_SHORT).show();
                        }
                    },
                    error -> {
                        // Manejar errores
                        error.printStackTrace();
                    }) {
                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("id", guardiaSeleccionada.getCod_guardia()+"");
                    return params;
                }
            };
            Volley.newRequestQueue(getActivity()).add(request);
        }
        return super.onContextItemSelected(item);
    }

    // Método para cargar datos en el ListView
    private void cargarDatos() {

        prefs = getActivity().getSharedPreferences("Preferences", Context.MODE_PRIVATE);
        String url = WebService.RAIZ + WebService.ObtenerGuardias;
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

                        adapter = new ShiftAdapter(getActivity(), R.layout.list_view_item_shifts, guardiasList, "total");
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