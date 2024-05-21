package com.ies.bargas.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.PopupMenu;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.ies.bargas.R;
import com.ies.bargas.model.Guardia;

import java.util.List;

public class ShiftAdapter extends ArrayAdapter<Guardia> {

    private Context context;
    private int layout;
    private List<Guardia> guardias;

    public ShiftAdapter(@NonNull Context context, int layout, List<Guardia> guardias) {
        super(context, 0, guardias);
        this.layout=layout;
        this.context = context;
        this.guardias = guardias;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View listItemView = convertView;
        if (listItemView == null) {
            listItemView = LayoutInflater.from(context).inflate(layout, parent, false);
        }

        Guardia currentGuardia = guardias.get(position);

        TextView fechaTextView = listItemView.findViewById(R.id.Fecha);
        TextView periodoTextView = listItemView.findViewById(R.id.Periodo);
        TextView claseTextView = listItemView.findViewById(R.id.Clase);
        TextView profesorTextView = listItemView.findViewById(R.id.Profesor);
        TextView observacionesTextView = listItemView.findViewById(R.id.Observaciones);

        fechaTextView.setText(currentGuardia.getFecha()+"");
        periodoTextView.setText(currentGuardia.getPeriodo().getInicio()+"-"+currentGuardia.getPeriodo().getFin());
        claseTextView.setText(currentGuardia.getClase());
        profesorTextView.setText(currentGuardia.getUsuario().getNombre()+" "+currentGuardia.getUsuario().getApellidos());
        observacionesTextView.setText(currentGuardia.getObservaciones()+"");

       /* listItemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(context, ModifyAlumnoActivity.class);
                intent.putExtra("matricula", currentAlumno.getMatricula());
                intent.putExtra("nombre", currentAlumno.getNombre());
                intent.putExtra("apellidos", currentAlumno.getApellidos());
                intent.putExtra("grupo", currentAlumno.getGrupo());
                context.startActivity(intent);
            }
        });*/

        listItemView.setOnLongClickListener(new View.OnLongClickListener() {
            @Override
            public boolean onLongClick(View v) {

                // Crear un objeto PopupMenu
                PopupMenu popupMenu = new PopupMenu(context, v);
                // Inflar el archivo de menú XML
                popupMenu.getMenuInflater().inflate(R.menu.context_menu_shifts, popupMenu.getMenu());

                MenuItem titulo= popupMenu.getMenu().findItem(R.id.titulo);
                titulo.setTitle(currentGuardia.getFecha()+"");
                titulo.setEnabled(false);

                // Configurar un listener para manejar la selección de elementos del menú
                popupMenu.setOnMenuItemClickListener(new PopupMenu.OnMenuItemClickListener() {
                    @Override
                    public boolean onMenuItemClick(MenuItem item) {
                       /* if (item.getItemId() == R.id.eliminar) {


                            RequestQueue queue = Volley.newRequestQueue(context);
                            String url = WebService.RAIZ + WebService.DeleteAlumno + "?"
                                    + "matricula=" + currentAlumno.getMatricula();

                            StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                                    new Response.Listener<String>() {
                                        @Override
                                        public void onResponse(String response) {
                                            int respuesta= Integer.parseInt(response);
                                            if (respuesta==0){
                                                Toast.makeText(context, "No se ha podido eliminar porque no existe el usuario ¯\\_( ͡° ͜ʖ ͡°)_/¯", Toast.LENGTH_SHORT).show();
                                            } else if (respuesta==1){
                                                Toast.makeText(context, currentAlumno.getNombre()+" Ha sido eliminado correctamente", Toast.LENGTH_SHORT).show();
                                                alumnos.remove(currentAlumno);
                                                notifyDataSetChanged();
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
                        }*/
                        return false;
                    }
                });
                popupMenu.show();
                return true;
            }
        });
        return listItemView;
    }
}
