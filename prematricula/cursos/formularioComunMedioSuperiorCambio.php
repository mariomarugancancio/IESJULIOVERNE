<h2 class="text-center">Datos del Alumno o Alumna</h2>
<div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="primer-apellido">Primer Apellido:</label>
                    <input class="form-control" type="text" id="primer-apellido" name="primer-apellido" required>
                    <div class="error primerapeerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="nombre">Nombre:</label>
                    <input class="form-control" type="text" id="nombre" name="nombre" required>
                    <div class="error nombreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="sexo">Sexo: (H o M)</label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="">Seleccione...</option>
                        <option value="H">H</option>
                        <option value="M">M</option>
                    </select>
                    <div class="error sexoerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="telefonoAlumno">Teléfono del alumno:</label>
                    <input class="form-control" type="text" id="telefonoAlumno" name="telefonoAlumno" required>
                    <div class="error telefonoAlumnoerr novalido"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="segundo-apellido">Segundo Apellido:</label>
                    <input class="form-control" type="text" id="segundo-apellido" name="segundo-apellido" required>
                    <div class="error segundoapeerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="dni">DNI:</label>
                    <input class="form-control" type="text" id="dni" name="dni" required>
                    <div class="error dnierr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="correoAlumno">Correo electrónico del alumno:</label>
                    <input class="form-control" type="text" id="correoAlumno" name="correoAlumno" required>
                    <div class="error correoAlumnoerr novalido"></div>
                </div>

                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="form-group mb-2">
                    <label for="municipio_nacimiento">Municipio:</label>
                    <input class="form-control" type="text" id="municipio_nacimiento" name="municipio_nacimiento" required>
                    <div class="error municipionacerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="provincia_nacimiento">Provincia:</label>
                    <input class="form-control" type="text" id="provincia_nacimiento" name="provincia_nacimiento" required>
                    <div class="error provincianacerr novalido"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="pais_nacimiento_extranjeros">País de Nacimiento (Solo Extranjeros):</label>
                    <input class="form-control" type="text" id="pais_nacimiento_extranjeros" name="pais_nacimiento_extranjeros">
                </div>
                <div class="form-group mb-2">
                    <label for="familia_numerosa">Familia Numerosa:</label>
                    <select class="form-control" id="familia_numerosa" name="familia_numerosa" required>
                        <option value="">Seleccione...</option>
                        <option value="SI">SÍ</option>
                        <option value="NO">NO</option>
                    </select>
                    <div class="error familianumerr novalido"></div>
                </div>
            </div>
        </div>
        <h2 class="text-center">Datos de los padres o tutores legales</h2>

        <div class="row">
            <div class="col-md-6">
                <h4>Padre o Tutor/a 1</h4>
                <div class="form-group mb-2">
                    <label for="nombre_apellidos_padre">Nombre y Apellidos del padre:</label>
                    <input class="form-control" type="text" id="nombre_apellidos_padre" name="nombre_apellidos_padre" required>
                    <div class="error nombreapepadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="dni_padre">DNI:</label>
                    <input class="form-control" type="text" id="dni_padre" name="dni_padre" required>
                    <div class="error dnipadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="telefono_padre">Teléfono del padre:</label>
                    <input class="form-control" type="text" id="telefono_padre" name="telefono_padre" required>
                    <div class="error telefonopadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="correo_padre">Correo electrónico padre:</label>
                    <input class="form-control" type="email" id="correo_padre" name="correo_padre" required>
                    <div class="error correopadreerr novalido"></div>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Madre o Tutor/a 2</h4>
                <div class="form-group mb-2">
                    <label for="nombre_apellidos_madre">Nombre y Apellidos de la madre:</label>
                    <input class="form-control" type="text" id="nombre_apellidos_madre" name="nombre_apellidos_madre" required>
                    <div class="error nombreapemadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="dni_madre">DNI:</label>
                    <input class="form-control" type="text" id="dni_madre" name="dni_madre" required>
                    <div class="error dnimadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="telefono_madre">Teléfono de la madre:</label>
                    <input class="form-control" type="text" id="telefono_madre" name="telefono_madre" required>
                    <div class="error telefonomadreerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="correo_madre">Correo electrónico madre:</label>
                    <input class="form-control" type="email" id="correo_madre" name="correo_madre" required>
                    <div class="error correomadreerr novalido"></div>
                </div>
            </div>
        </div>

        <h2 class="text-center">Datos del Domicilio Familiar</h2>

                 <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2">
                    
                    <label for="calle">C/Avda. Plaza:</label>
                    <input class="form-control" type="text" id="calle" name="calle" required>
                </div>
                <div class="form-group mb-2">
                    <label for="numero">Número:</label>
                    <input class="form-control" type="number" id="numero" name="numero">
                </div>
                <div class="form-group mb-2">
                    <label for="portal">Portal:</label>
                    <input class="form-control" type="text" id="portal" name="portal">
                </div>
                <div class="form-group mb-2">
                    <label for="piso">Piso:</label>
                    <input class="form-control" type="text" id="piso" name="piso">
                </div>
                <div class="form-group mb-2">
                    <label for="puerta">Puerta:</label>
                    <input class="form-control" type="text" id="puerta" name="puerta">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">

                    <label for="codigo_postal">Código Postal:</label>
                    <input class="form-control" type="number" id="codigo_postal" name="codigo_postal" required>
                    <div class="error codigopostarlerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="municipio">Municipio:</label>
                    <input class="form-control" type="text" id="municipio" name="municipio" required>
                    <div class="error municipioerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="provincia">Provincia:</label>
                    <input class="form-control" type="text" id="provincia" name="provincia" required>
                    <div class="error provinciaerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="telefono_urgencia">Teléfono en caso de Urgencias:</label>
                    <input class="form-control" type="text" id="telefono_urgencia" name="telefono_urgencia" placeholder="Máximo 2 teléfonos" required>
                    <div class="error telefonourgenciaerr novalido"></div>
                </div>
                <div class="form-group mb-2">
                <label for="cambioDT">¿Ha cambiado de domicilio o teléfono respecto al curso pasado?</label>
                    <select class="form-control" id="cambioDT" name="cambioDT" required>
                        <option value="">Seleccione...</option>
                        <option value="SI">SÍ</option>
                        <option value="NO">NO</option>
                    </select>
                    <div class="error cambioDTerr novalido"></div>
                    </div>
                    <div class="form-group mb-2">
                <label for="trabaja">Trabaja (SI o NO):</label>
                    <select class="form-control" id="trabaja" name="trabaja" required>
                        <option value="">Seleccione...</option>
                        <option value="SI">SÍ</option>
                        <option value="NO">NO</option>
                    </select>
                    <div class="error trabajaerr novalido"></div>
                    </div>
                </div>
        </div>

                <div class="form-group mb-5">
                    <h2 class="text-center">Datos Académicos del Curso Anterior</h2>
                    <p>El solicitante, durante el curso 2023-2024, estuvo matriculado en el centro: <input type="text" id="centro" name="centro" style="margin: 5px;" required> de la localidad: <input type="text" id="localidad_centro" name="localidad_centro" style="margin: 5px;" required> Provincia: <input type="text" id="provincia_centro" name="provincia_centro" style="margin: 5px;" required></p>
                    <p>En el curso de:     
                    <select id="curso_antiguo" name="curso_antiguo" style="margin: 5px;" required>
                        <option value="">Seleccione...</option>
                        <option value="Ninguno">Ninguno</option>             
                        <option value="Sexto Primaria">Sexto Primaria</option>
                        <option value="1ESO">1º ESO</option>             
                        <option value="2ESO">2º ESO</option>             
                        <option value="3ESO">3º ESO</option>             
                        <option value="1BACHILLERATO">1º BACHILLERATO</option>             
                        <option value="2BACHILLERATO">2º BACHILLERATO</option>             
                        <option value="1CFGB">1º CFGB</option>             
                        <option value="2CFGB">2º CFGB</option>             
                        <option value="1SMR">1º SMR</option>             
                        <option value="2SMR">2º SMR</option> 
                        <option value="1DAM">1º DAM</option>             
                        <option value="2DAM">2º DAM</option>
                        <option value="1DAM">1º DAW</option>             
                        <option value="2DAM">2º DAW</option>                 
                     </select> 
                </div>