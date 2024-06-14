package com.ies.bargas.adapters;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.PopupMenu;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.content.ContextCompat;

import com.ies.bargas.R;
import com.ies.bargas.model.Guardia;

import java.util.List;

public class ShiftAdapter extends ArrayAdapter<Guardia> {

    private Context context;
    private int layout;
    private List<Guardia> guardias;
    private String tipoGuardia;

    public ShiftAdapter(@NonNull Context context, int layout, List<Guardia> guardias, String tipoGuardia) {
        super(context, 0, guardias);
        this.layout=layout;
        this.context = context;
        this.guardias = guardias;
        this.tipoGuardia=tipoGuardia;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View listItemView = convertView;
        if (listItemView == null) {
            listItemView = LayoutInflater.from(context).inflate(layout, parent, false);
        }

        Guardia currentGuardia = guardias.get(position);
        LinearLayout filaShiftLinearLayout = listItemView.findViewById(R.id.filaShift);
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


        //Colores
        if(tipoGuardia.equals("salaProfesores")) {
            String fecha = currentGuardia.getFecha().toString();
            if (fecha.equals("08:30:00") || fecha.equals("15:15:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulMarino));
            } else if (fecha.equals("09:25:00") || fecha.equals("16:10:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulIntenso));
            } else if (fecha.equals("10:20:00") || fecha.equals("17:05:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulMedio));
            } else if (fecha.equals("11:45:00") || fecha.equals("18:30:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro1));
            } else if (fecha.equals("12:40:00") || fecha.equals("19:25:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro2));
            } else if (fecha.equals("13:35:00") || fecha.equals("20:20:00")) {
                filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro3));
            } else {
                filaShiftLinearLayout.setBackgroundColor(Color.WHITE); // Color por defecto
            }
        }

        return listItemView;
    }
}
