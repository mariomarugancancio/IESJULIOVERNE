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

import java.text.SimpleDateFormat;
import java.time.LocalTime;
import java.util.Date;
import java.util.List;
import java.util.TimeZone;

public class ShiftAdapter extends ArrayAdapter<Guardia> {

    private Context context;
    private int layout;
    private List<Guardia> guardias;
    private String tipoGuardia;
private static int valor=0;
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

        fechaTextView.setTextColor(Color.BLACK);
        periodoTextView.setTextColor(Color.BLACK);
        claseTextView.setTextColor(Color.BLACK);
        profesorTextView.setTextColor(Color.BLACK);
        observacionesTextView.setTextColor(Color.BLACK);
        // Obtener la hora actual del sistema
        LocalTime ahora = LocalTime.now();

        // Definir los límites de tiempo con segundos
        LocalTime inicio1 = LocalTime.of(8, 30, 0); // 08:30:00
        LocalTime fin1 = LocalTime.of(9, 24, 59);
        LocalTime inicio2 = LocalTime.of(15, 15, 0); // 08:30:00
        LocalTime fin2 = LocalTime.of(16, 9, 59);
        LocalTime inicio3 = LocalTime.of(9, 25, 0); // 08:30:00
        LocalTime fin3 = LocalTime.of(10, 19, 59);
        LocalTime inicio4 = LocalTime.of(16, 10, 0); // 08:30:00
        LocalTime fin4 = LocalTime.of(17, 4, 59);
        LocalTime inicio5 = LocalTime.of(10, 20, 0); // 08:30:00
        LocalTime fin5 = LocalTime.of(11, 14, 59);
        LocalTime inicio6 = LocalTime.of(17, 5, 0); // 08:30:00
        LocalTime fin6 = LocalTime.of(17, 59, 59);
        LocalTime inicio7 = LocalTime.of(11, 45, 0); // 08:30:00
        LocalTime fin7 = LocalTime.of(12, 39, 59);
        LocalTime inicio8 = LocalTime.of(18, 30, 0); // 08:30:00
        LocalTime fin8 = LocalTime.of(19, 24, 59);
        LocalTime inicio9 = LocalTime.of(12, 40, 0); // 08:30:00
        LocalTime fin9 = LocalTime.of(13, 34, 59);
        LocalTime inicio10 = LocalTime.of(19, 25, 0); // 08:30:00
        LocalTime fin10 = LocalTime.of(20, 19, 59);
        LocalTime inicio11 = LocalTime.of(13, 35, 0); // 08:30:00
        LocalTime fin11 = LocalTime.of(14, 24, 59);
        LocalTime inicio12 = LocalTime.of(20, 20, 0); // 08:30:00
        LocalTime fin12 = LocalTime.of(21, 14, 59);

        //Verde claro

        LocalTime inicio13 = LocalTime.of(00, 00, 0); // 08:30:00
        LocalTime fin13 = LocalTime.of(8, 29, 59);
        LocalTime inicio14 = LocalTime.of(14, 25, 0); // 08:30:00
        LocalTime fin14 = LocalTime.of(15, 14, 59);
        LocalTime inicio15 = LocalTime.of(11, 15, 0); // 08:30:00
        LocalTime fin15 = LocalTime.of(11, 44, 59);
        LocalTime inicio16 = LocalTime.of(18, 00, 0); // 08:30:00
        LocalTime fin16 = LocalTime.of(18, 29, 59);
        //Colores
        if(tipoGuardia.equals("salaProfesores")) {
            String fecha = currentGuardia.getPeriodo().getInicio();
            if (fecha.equals("08:30:00") || fecha.equals("15:15:00")) {
                if(ahora.isAfter(inicio1) && ahora.isBefore(fin1) && fecha.equals("08:30:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    valor=1;
                }else if(ahora.isAfter(inicio2) && ahora.isBefore(fin2)  && fecha.equals("15:15:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    valor=2;
                }else if(valor == 0 && ahora.isAfter(inicio13) && ahora.isBefore(fin13)){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 0 && ahora.isAfter(inicio14) && ahora.isBefore(fin14)){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                } else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulMarino));
                }
                fechaTextView.setTextColor(Color.WHITE);
                periodoTextView.setTextColor(Color.WHITE);
                claseTextView.setTextColor(Color.WHITE);
                profesorTextView.setTextColor(Color.WHITE);
                observacionesTextView.setTextColor(Color.WHITE);
            } else if (fecha.equals("09:25:00") || fecha.equals("16:10:00")) {
                if(ahora.isAfter(inicio3) && ahora.isBefore(fin3)  && fecha.equals("09:25:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=3;
                }else if( ahora.isAfter(inicio4) && ahora.isBefore(fin4)  && fecha.equals("16:10:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=4;
                }else if(valor == 1){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 2){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulIntenso));
                }
            } else if (fecha.equals("10:20:00") || fecha.equals("17:05:00")) {
                if(ahora.isAfter(inicio5) && ahora.isBefore(fin5)  && fecha.equals("10:20:00") ){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=5;
                } else if(ahora.isAfter(inicio6) && ahora.isBefore(fin6)  && fecha.equals("17:05:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=6;
                }else if(valor == 3){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 4){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulMedio));
                }
            } else if (fecha.equals("11:45:00") || fecha.equals("18:30:00")) {
                if(ahora.isAfter(inicio7) && ahora.isBefore(fin7)  && fecha.equals("11:45:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=7;
                }else if(ahora.isAfter(inicio8) && ahora.isBefore(fin8) && fecha.equals("18:30:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=8;
                }else if(valor == 5 ){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 6 ){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 0  && ahora.isAfter(inicio15) && ahora.isBefore(fin15)){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 0  && ahora.isAfter(inicio16) && ahora.isBefore(fin16)){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro1));
                }
            } else if (fecha.equals("12:40:00") || fecha.equals("19:25:00")) {
                if(ahora.isAfter(inicio9) && ahora.isBefore(fin9) && fecha.equals("12:40:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=9;
                }else if( ahora.isAfter(inicio10) && ahora.isBefore(fin10) && fecha.equals("19:25:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=10;
                }else if(valor == 7){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 8){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro2));
                }
            } else if (fecha.equals("13:35:00") || fecha.equals("20:20:00")) {
                if(ahora.isAfter(inicio11) && ahora.isBefore(fin11) && fecha.equals("13:35:00") ){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=11;
                }else if( ahora.isAfter(inicio12) && ahora.isBefore(fin12) && fecha.equals("20:20:00")){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeOscuro));
                    fechaTextView.setTextColor(Color.WHITE);
                    periodoTextView.setTextColor(Color.WHITE);
                    claseTextView.setTextColor(Color.WHITE);
                    profesorTextView.setTextColor(Color.WHITE);
                    observacionesTextView.setTextColor(Color.WHITE);
                    valor=12;
                }else if(valor == 9){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else if(valor == 10){
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorVerdeClaro));
                }else {
                    filaShiftLinearLayout.setBackgroundColor(ContextCompat.getColor(context, R.color.colorAzulClaro3));
                }
            } else {
                filaShiftLinearLayout.setBackgroundColor(Color.WHITE); // Color por defecto
            }
        }

        return listItemView;
    }
}