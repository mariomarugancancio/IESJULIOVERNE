<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si se ha pulsado el botón de eliminar incidencia ...
    if (isset($_POST["eliminarInci"])) {
      // Capturamos el valor de $codTarea del campo oculto del formulario
      $codTarea = $_POST["codigoTarea"];
      // Borramos la tarea seleccionada
      require_once('../../archivosComunes/conexion.php');
      try {
        // Mostramos el cuadro de diálogo de confirmación antes de eliminar la incidencia
         // Mostramos el cuadro de diálogo de confirmación antes de eliminar la incidencia
        // Escapamos la variable para mayor seguridad
        $codTareaEscaped = htmlspecialchars($codTarea, ENT_QUOTES, 'UTF-8');
        
        echo "
            <div id='customConfirm' class='modal'>
                <div class='modal-content'>
                    <p>¿Seguro que quieres finalizar esta incidencia?</p>
                    <button id='confirmBtn' class='btn btn-success'>Sí, finalizar</button>
                    <button id='cancelBtn' class='btn btn-danger'>No, cancelar</button>
                </div>
            </div>
        
            <style>
                /* Estilo para el modal */
                .modal {
                    display: block; /* Mostrar el modal */
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
                }
                .modal-content {
                    background-color: #fff;
                    margin: 15% auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 50%;
                    border-radius: 10px;
                    text-align: center;
                }
                .btn {
                    padding: 10px 20px;
                    margin: 10px;
                    border: none;
                    cursor: pointer;
                    font-size: 16px;
                    border-radius: 5px;
                }
                .btn-success {
                    background-color: #28a745;
                    color: white;
                }
                .btn-danger {
                    background-color: #dc3545;
                    color: white;
                }
            </style>
        
            <script>
                // Obtener los elementos del modal y los botones
                var confirmBtn = document.getElementById('confirmBtn');
                var cancelBtn = document.getElementById('cancelBtn');
        
                // Si el usuario hace clic en Sí, finalizar
                confirmBtn.onclick = function() {
                    window.location = 'funciones/eliminar_incidenciaFinalizada.php?codTarea={$codTareaEscaped}';
                };
        
                // Si el usuario hace clic en No, cancelar
                cancelBtn.onclick = function() {
                    window.location = 'adminFinalizadas.php';
                };
            </script>";
        exit;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
  }
?>

