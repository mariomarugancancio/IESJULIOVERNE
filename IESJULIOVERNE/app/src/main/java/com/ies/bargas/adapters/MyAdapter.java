package com.ies.bargas.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.ies.bargas.model.Item;
import com.ies.bargas.R;

import java.util.List;

public class MyAdapter extends RecyclerView.Adapter<MyAdapter.ViewHolder> {

    private List<Item> items;
    private int layout;
    private OnItemClickListener itemClickListener;

    private Context context;


    public MyAdapter(List<Item> items, int layout, OnItemClickListener listener) {
        this.items = items;
        this.layout = layout;
        this.itemClickListener = listener;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        // Inflamos el layout y se lo pasamos al constructor del ViewHolder, donde manejaremos
        // toda la lógica como extraer los datos, referencias...
        View v = LayoutInflater.from(parent.getContext()).inflate(layout, parent, false);
        context = parent.getContext();
        ViewHolder vh = new ViewHolder(v);
        return vh;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        // Llamamos al método Bind del ViewHolder pasándole objeto y listener
        holder.bind(items.get(position), itemClickListener);
    }

    @Override
    public int getItemCount() {
        return items.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        // Elementos UI a rellenar
        public TextView textViewName;
        public ImageView imageViewPoster;

        public ViewHolder(View itemView) {
            // Recibe la View completa. La pasa al constructor padre y enlazamos referencias UI
            // con nuestras propiedades ViewHolder declaradas justo arriba.
            super(itemView);
            textViewName = (TextView) itemView.findViewById(R.id.textView);
            imageViewPoster = (ImageView) itemView.findViewById(R.id.imageView);
        }

        /*Método importante para la imagen que aparece por defecto y la imagen que debe aparecer
          una vez se ponga el cursor encima del módulo*/
        public void bind(final Item item, final OnItemClickListener listener) {
            //Nombre del método en el TestView
            textViewName.setText(item.getName());
            //Comprueba el nombre del módulo y su imagen por defecto y establece su StateListDrawable
            imageViewPoster.setBackgroundResource(item.getImage());

            /* OnClickListener para el elemento de la vista y cuando se hace clic en el elemento,
               se llama al método onItemClick del listener */
            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    listener.onItemClick(item, getAdapterPosition());
                }
            });
        }
    }

    // Declaramos nuestra interfaz con el/los método/s a implementar
    public interface OnItemClickListener {
        void onItemClick(Item item, int position);
    }
}