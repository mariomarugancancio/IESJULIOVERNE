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
import com.ies.bargas.R;
import com.ies.bargas.activities.shifts.AddShiftsActivity;
import com.ies.bargas.controllers.WebService;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class GuardiasSemanaFragment extends Fragment {

    private ListView listViewGuardiasSemana;
    private ArrayAdapter<String> adapter;
    private ArrayList<String> listaGuardias;

    private String obtenerIdDeGuardia(String guardia) {
        return guardia.split(" ")[0];
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_guardias_semana, container, false);
        listViewGuardiasSemana = view.findViewById(R.id.listViewGuardiasSemana);
        listaGuardias = new ArrayList<>();
        adapter = new ArrayAdapter<>(getActivity(), R.layout.list_view_item_shifts, listaGuardias);
        listViewGuardiasSemana.setAdapter(adapter);
        registerForContextMenu(listViewGuardiasSemana);

        // Cargar los datos
        cargarGuardiasSemana();

        // Devolver la vista
        return view;
    }

    @Override
    public void onCreateContextMenu(ContextMenu menu, View v, ContextMenu.ContextMenuInfo menuInfo) {
        super.onCreateContextMenu(menu, v, menuInfo);
        getActivity().getMenuInflater().inflate(R.menu.context_menu_shifts, menu);
    }

    @Override
    public boolean onContextItemSelected(MenuItem item) {
        AdapterView.AdapterContextMenuInfo info = (AdapterView.AdapterContextMenuInfo) item.getMenuInfo();
        String guardiaSeleccionada = listaGuardias.get(info.position);
        if (item.getItemId() == R.id.edit) {
            // Ir a la actividad de agregar/editar guardia
            Intent intent = new Intent(getActivity(), AddShiftsActivity.class);
            intent.putExtra("guardia", guardiaSeleccionada);
            startActivity(intent);
        } else if (item.getItemId() == R.id.delete) {
            // Llamar al archivo PHP para eliminar la guardia
            String url = WebService.RAIZ + WebService.Delete;
            StringRequest request = new StringRequest(Request.Method.POST, url,
                    response -> {
                        // Comprobar si la eliminación fue exitosa
                        if (response.equals("Guardia eliminada correctamente")) {
                            // Eliminar la guardia de la lista y actualizar el ListView
                            listaGuardias.remove(info.position);
                            adapter.notifyDataSetChanged();
                        } else {
                            // Mostrar un mensaje de error
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
                    params.put("id", obtenerIdDeGuardia(guardiaSeleccionada));
                    return params;
                }
            };
            Volley.newRequestQueue(getActivity()).add(request);
        }
        return super.onContextItemSelected(item);
    }

    // Método para cargar datos en el ListView
    private void cargarGuardiasSemana() {
        String url = WebService.RAIZ + WebService.ObtenerGuardiasSemana;
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(url,
                response -> {
                    try {
                        listaGuardias.clear();
                        for (int i = 0; i < response.length(); i++) {
                            JSONObject jsonObject = response.getJSONObject(i);
                            String guardia = jsonObject.getString("fecha") + " " +
                                    jsonObject.getString("periodo") + " " +
                                    jsonObject.getString("clase") + " " +
                                    jsonObject.getString("profesor") + " " +
                                    jsonObject.getString("observaciones");
                            listaGuardias.add(guardia);
                        }
                        adapter.notifyDataSetChanged();
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                },
                error -> {
                    error.printStackTrace();
                });
        Volley.newRequestQueue(getActivity()).add(jsonArrayRequest);
    }
}
