<h2 class="text-center">Datos del Alumno o Alumna</h2>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="primer-apellido">Primer Apellido:</label>
            <input class="form-control" type="text" id="primer-apellido" name="primer-apellido" value="<?php echo $primer_apellido_alumno; ?>" required>
            <div class="error primerapeerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="nombre">Nombre:</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $nombre_alumno; ?>" required>
            <div class="error nombreerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="sexo">Sexo: (H o M)</label>
            <select class="form-control" id="sexo" name="sexo" required>
                <?php if ($sexo_alumno == "H") {
                    echo '<option value="H">H</option>';
                    echo '<option value="M">M</option>';
                    echo '<option value="">Seleccione...</option>';

                } else if ($sexo_alumno == "M") {
                    echo '<option value="M">M</option>';
                    echo '<option value="H">H</option>';
                    echo '<option value="">Seleccione...</option>';

                } else {
                    echo '<option value="">Seleccione...</option>';
                    echo '<option value="M">M</option>';
                    echo '<option value="H">H</option>';
                } ?>

            </select>
            <div class="error sexoerr novalido"></div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="segundo-apellido">Segundo Apellido:</label>
            <input class="form-control" type="text" id="segundo-apellido" name="segundo-apellido" value="<?php echo $segundo_apellido_alumno; ?>" required>
            <div class="error segundoapeerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="dni">DNI:</label>
            <input class="form-control" type="text" id="dni" name="dni" value="<?php echo $dni_alumno; ?>" required>
            <div class="error dnierr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="correoAlumno">Correo electrónico:</label>
            <input class="form-control" type="email" id="correoAlumno" name="correoAlumno" value="<?php echo $email_alumno; ?>" required>
            <div class="error correoAlumnoerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="telefonoAlumno">Teléfono:</label>
            <input class="form-control" type="number" id="telefonoAlumno" name="telefonoAlumno" value="<?php echo $telefono_alumno; ?>" required>
            <div class="error telefonoAlumnoerr novalido"></div>
        </div>
    </div>
</div>
<h2 class="text-center">Datos de Nacimiento</h2>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fechaNacimiento; ?>" required>
        </div>
        <div class="form-group mb-2">
            <label for="municipio_nacimiento">Municipio:</label>
            <input class="form-control" type="text" id="municipio_nacimiento" name="municipio_nacimiento" value="<?php echo $municipioNacimiento; ?>" required>
            <div class="error municipionacerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="provincia_nacimiento">Provincia:</label>
            <input class="form-control" type="text" id="provincia_nacimiento" name="provincia_nacimiento" value="<?php echo $provinciaNacimiento; ?>" required>
            <div class="error provincianacerr novalido"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">
            <label for="pais_nacimiento_extranjeros">País de Nacimiento (Solo Extranjeros):</label>
            <input class="form-control" type="text" id="pais_nacimiento_extranjeros" name="pais_nacimiento_extranjeros"
                value="<?php echo $paisNacimiento; ?>">
        </div>
        <div class="form-group mb-2">
            <label for="familia_numerosa">Familia Numerosa:</label>
            <select class="form-control" id="familia_numerosa" name="familia_numerosa" required>
                   
                <?php if ($familiaNumerosa == "SI") {
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                    echo '<option value="">Seleccione...</option>';

                } else if ($familiaNumerosa == "NO") {
                    echo '<option value="NO">NO</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="">Seleccione...</option>';

                } else {
                    echo '<option value="">Seleccione...</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                } ?>
            </select>
            <div class="error familianumerr novalido"></div>
        </div>
    </div>
</div>
<h2 class="text-center">Datos de los progenitores o tutores legales</h2>


<div class="row">
    <div class="col-md-6">
        <h4>Progenitor 1 o Tutor/a 1</h4>
        <div class="form-group mb-2">
            <label for="nombre_apellidos_progenitor1">Nombre y Apellidos del progenitor 1:</label>
            <input class="form-control" type="text" id="nombre_apellidos_progenitor1" name="nombre_apellidos_progenitor1"
                value="<?php echo $nombre_apellidos_progenitor1; ?>" required>
            <div class="error nombreapeprogenitor1err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="dni_progenitor1">DNI:</label>
            <input class="form-control" type="text" id="dni_progenitor1" name="dni_progenitor1" value="<?php echo $dni_progenitor1; ?>"
                required>
            <div class="error dniprogenitor1err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="telefono_progenitor1">Teléfono del progenitor 1:</label>
            <input class="form-control" type="text" id="telefono_progenitor1" name="telefono_progenitor1" value="<?php echo $telefono_progenitor1; ?>" required>
            <div class="error telefonoprogenitor1err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="correo_progenitor1">Correo electrónico progenitor 1:</label>
            <input class="form-control" type="email" id="correo_progenitor1" name="correo_progenitor1" value="<?php echo $email_progenitor1; ?>" required>
            <div class="error correoprogenitor1err novalido"></div>
        </div>
    </div>
    <div class="col-md-6">
        <h4>Progenitor 2 o Tutor/a 2</h4>
        <div class="form-group mb-2">
            <label for="nombre_apellidos_progenitor2">Nombre y Apellidos del progenitor 2:</label>
            <input class="form-control" type="text" id="nombre_apellidos_progenitor2" name="nombre_apellidos_progenitor2"
                value="<?php echo $nombre_apellidos_progenitor2; ?>" required>
            <div class="error nombreapeprogenitor2err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="dni_progenitor2">DNI:</label>
            <input class="form-control" type="text" id="dni_progenitor2" name="dni_progenitor2" value="<?php echo $dni_progenitor2; ?>"
                required>
            <div class="error dniprogenitor2err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="telefono_progenitor2">Teléfono del progenitor 2:</label>
            <input class="form-control" type="text" id="telefono_progenitor2" name="telefono_progenitor2" value="<?php echo $telefono_progenitor2; ?>" required>
            <div class="error telefonoprogenitor2err novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="correo_progenitor2">Correo electrónico progenitor 2:</label>
            <input class="form-control" type="email" id="correo_progenitor2" name="correo_progenitor2" value="<?php echo $email_progenitor2; ?>" required>
            <div class="error correoprogenitor2err novalido"></div>
        </div>
    </div>
</div>

<h2 class="text-center">Datos del Domicilio Familiar</h2>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">

            <label for="calle">C/Avda. Plaza:</label>
            <input class="form-control" type="text" id="calle" name="calle" value="<?php echo $calle; ?>" required>
        </div>
        <div class="form-group mb-2">
            <label for="numero">Número:</label>
            <input class="form-control" type="number" id="numero" name="numero" value="<?php echo $numero; ?>">
        </div>
        <div class="form-group mb-2">
            <label for="portal">Portal:</label>
            <input class="form-control" type="text" id="portal" name="portal" value="<?php echo $portal; ?>">
        </div>
        <div class="form-group mb-2">
            <label for="piso">Piso:</label>
            <input class="form-control" type="text" id="piso" name="piso" value="<?php echo $piso; ?>">
        </div>
        <div class="form-group mb-2">
            <label for="puerta">Puerta:</label>
            <input class="form-control" type="text" id="puerta" name="puerta" value="<?php echo $puerta; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-2">

            <label for="codigo_postal">Código Postal:</label>
            <input class="form-control" type="number" id="codigo_postal" name="codigo_postal" value="<?php echo $codigoPostal; ?>" required>
            <div class="error codigopostarlerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="municipio">Municipio:</label>
            <input class="form-control" type="text" id="municipio" name="municipio" value="<?php echo $municipio; ?>"
                required>
            <div class="error municipioerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="provincia">Provincia:</label>
            <input class="form-control" type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>"
                required>
            <div class="error provinciaerr novalido"></div>
        </div>
        <div class="form-group mb-2">
            <label for="telefono_urgencia">Teléfono en caso de Urgencias:</label>
            <input class="form-control" type="text" id="telefono_urgencia" name="telefono_urgencia"
                placeholder="Máximo 2 teléfonos" value="<?php echo $telefonoUrgencia; ?>" required>
            <div class="error telefonourgenciaerr novalido"></div>
            <div class="form-group mb-2">
                <label for="cambioDT">¿Ha cambiado de domicilio o teléfono respecto al curso pasado?</label>
                    <select class="form-control" id="cambioDT" name="cambioDT" required>
                    <?php if ($cambio == "SI") {
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                    echo '<option value="">Seleccione...</option>';

                } else if ($cambio == "NO") {
                    echo '<option value="NO">NO</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="">Seleccione...</option>';

                } else {
                    echo '<option value="">Seleccione...</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                } ?>
                    </select>
                    <div class="error cambioDTerr novalido"></div>
                    </div>
            <div class="form-group mb-2">
                <label for="trabaja">Trabaja (SI o NO):</label>
                    <select class="form-control" id="trabaja" name="trabaja" required>
                    <?php if ($trabaja == "SI") {
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                    echo '<option value="">Seleccione...</option>';

                } else if ($trabaja == "NO") {
                    echo '<option value="NO">NO</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="">Seleccione...</option>';

                } else {
                    echo '<option value="">Seleccione...</option>';
                    echo '<option value="SI">SÍ</option>';
                    echo '<option value="NO">NO</option>';
                } ?>
                    </select>
                    <div class="error trabajaerr novalido"></div>
                    </div>
        </div>
    </div>
</div>

<div class="form-group mb-5">
    <h2 class="text-center">Datos Académicos del Curso Anterior</h2>
    <p>El solicitante, durante el curso 2023-2024, estuvo matriculado en el centro: <input type="text" id="centro"
            name="centro" style="margin: 5px;" value="<?php echo $centro; ?>" required> de la localidad: <input
            type="text" id="localidad_centro" name="localidad_centro" style="margin: 5px;" value="<?php echo $localidad_centro; ?>" required> Provincia: <input type="text" id="provincia_centro" name="provincia_centro"
            style="margin: 5px;" value="<?php echo $provincia_centro; ?>" required></p>
    <p>En el curso de:
        <select id="curso_antiguo" name="curso_antiguo" style="margin: 5px;" required>
            <?php if ($curso_antiguo == "Sexto Primaria") {
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "1ESO") {
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "2ESO") {
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "3ESO") {
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "4ESO") {
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "1BACHILLERATO") {
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "2BACHILLERATOa") {
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "1CFGB") {
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "2CFGB") {
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "1SMR") {
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else if ($curso_antiguo == "1DAM") {
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            }else if ($curso_antiguo == "2DAM") {
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            }else if ($curso_antiguo == "1DAW") {
                echo ' <option value="1DAW">1º DAW</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="2DAW">2º DAW</option>';
            }else if ($curso_antiguo == "2DAW") {
                echo ' <option value="2DAW">2º DAW</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAW">1º DAW</option>';
            }else if ($curso_antiguo == "1PEFP") {
                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            }else if ($curso_antiguo == "2PEFP") {
                echo ' <option value="2PEFP">2º PEFP</option>';
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1PEFP">1º PEFP</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            }else if ($curso_antiguo == "2SMR") {
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } else {
                echo ' <option value="Ninguno">Ninguno</option>';
                echo ' <option value="Sexto Primaria">Sexto Primaria</option>';
                echo ' <option value="1ESO">1º ESO</option>';
                echo ' <option value="2ESO">2º ESO</option>';
                echo ' <option value="3ESO">3º ESO</option>';
                echo ' <option value="4ESO">4º ESO</option>';
                echo ' <option value="1BACHILLERATO">1º BACHILLERATO</option>';
                echo ' <option value="2BACHILLERATO">2º BACHILLERATO</option>';
                echo ' <option value="1CFGB">1º CFGB</option>';
                echo ' <option value="2CFGB">2º CFGB</option>';
                echo ' <option value="1SMR">1º SMR</option>';
                echo ' <option value="2SMR">2º SMR</option>';
                echo ' <option value="1DAM">1º DAM</option>';
                echo ' <option value="2DAM">2º DAM</option>';
                echo ' <option value="1DAM">1º DAW</option>';
                echo ' <option value="2DAM">2º DAW</option>';
            } ?>

        </select>
</div>
               
           
<div class="form-group mb-2">
                <p>¿Desea pertenecer al AMPA? 
                <?php if($ampa == "SI"){
                        echo '<input type="radio" id="ampa_si" name="ampa" value="SI" checked> SÍ ';
                        echo '<input type="radio" id="ampa_no" name="ampa" value="NO"> NO</p>';

                    }else if($ampa == "NO"){
                            echo '<input type="radio" id="ampa_si" name="ampa" value="SI"> SÍ ';
                            echo '<input type="radio" id="ampa_no" name="ampa" value="NO" checked> NO</p>';
                    }else{
                        echo '<input type="radio" id="ampa_si" name="ampa" value="SI"> SÍ ';
                        echo '<input type="radio" id="ampa_no" name="ampa" value="NO"> NO</p>';
                    }
                    ?>
                </div> 