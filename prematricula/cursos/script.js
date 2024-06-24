let misForms = document.forms;
//Expresiones Regulares
//Formulario
let fmatriculas = document.forms.matriculas;
let miCurso = document.forms.matriculas['curso'].value;
//Datos del alumno
let miPrimerApe = fmatriculas.elements['primer-apellido'];
let miSegundoApe = fmatriculas.elements['segundo-apellido'];
let miNombre = fmatriculas.elements['nombre'];
let miDNI = fmatriculas.elements['dni'];
let miSexo = fmatriculas.elements['sexo'];
let miCorreo = fmatriculas.elements['correoAlumno'];
let miTelefono = fmatriculas.elements['telefonoAlumno'];

//Datos de Nacimiento
let miMunicipioNac = fmatriculas.elements['municipio_nacimiento'];
let miProvinciaNac = fmatriculas.elements['provincia_nacimiento'];
let familiaNum = fmatriculas.elements['familia_numerosa'];

//Datos de los Progenitores
    //Progenitor1
let nombreApeProgenitor1 = fmatriculas.elements['nombre_apellidos_progenitor1'];
let dniProgenitor1 = fmatriculas.elements['dni_progenitor1'];
let telefonoProgenitor1 = fmatriculas.elements['telefono_progenitor1'];
let correoProgenitor1 = fmatriculas.elements['correo_progenitor1'];
    //Progenitor2
let nombreApeProgenitor2 = fmatriculas.elements['nombre_apellidos_progenitor2'];
let dniProgenitor2 = fmatriculas.elements['dni_progenitor2'];
let telefonoProgenitor2 = fmatriculas.elements['telefono_progenitor2'];
let correoProgenitor2 = fmatriculas.elements['correo_progenitor2'];

//Datos Domicilio Familiar
let miCodigoPostal = fmatriculas.elements['codigo_postal'];
let miMunicipio = fmatriculas.elements['municipio'];
let miProvincia = fmatriculas.elements['provincia'];
let telefonoUrgencia = fmatriculas.elements['telefono_urgencia'];

let trabaja = fmatriculas.elements['trabaja'];
let cambioDT = fmatriculas.elements['cambioDT'];


// Errores del Alumno
let miErrorPrimerApe = document.querySelector(".primerapeerr");
let miErrorSegundoApe = document.querySelector(".segundoapeerr");
let miErrorNombre = document.querySelector(".nombreerr");
let miErrorDNI = document.querySelector(".dnierr");
let miErrorSexo = document.querySelector(".sexoerr");
let miErrorCorreo = document.querySelector(".correoAlumnoerr");
let miErrorTelefono = document.querySelector(".telefonoAlumnoerr");

//Errores de Nacimiento
let miErrorMunicipioNac = document.querySelector(".municipionacerr");
let miErrorProvinciaNac = document.querySelector(".provincianacerr");
let miErrorFamiliaNum = document.querySelector(".familianumerr");

//Errores de los Progenitores
    //Progenitor1
let miErrornombreApeProgenitor1 = document.querySelector(".nombreapeprogenitor1err");
let miErrordniProgenitor1 = document.querySelector(".dniprogenitor1err");
let miErrortelefonoProgenitor1 = document.querySelector(".telefonoprogenitor1err");
let miErrorcorreoProgenitor1 = document.querySelector(".correoprogenitor1err");
    //Progenitor2
let miErrornombreApeProgenitor2 = document.querySelector(".nombreapeprogenitor2err");
let miErrordniProgenitor2 = document.querySelector(".dniprogenitor2err");
let miErrortelefonoProgenitor2 = document.querySelector(".telefonoprogenitor2err");
let miErrorcorreoProgenitor2 = document.querySelector(".correoprogenitor2err");

//Errores del Domicilio Familiar
let miErrorCodigoPostal = document.querySelector(".codigopostarlerr");
let miErrorMunicipio = document.querySelector(".municipioerr");
let miErrorProvincia = document.querySelector(".provinciaerr");
let miErrortelefonoUrgencias = document.querySelector(".telefonourgenciaerr");
let miErrortrabaja = document.querySelector(".trabajaerr");
let miErrorcambioDT = document.querySelector(".cambioDTerr");

//Llamar a las funciones con blur
miPrimerApe.addEventListener("blur", validarNombres);
miSegundoApe.addEventListener("blur", validarNombres);
miNombre.addEventListener("blur", validarNombres);
miSexo.addEventListener("blur", validarSexo);
miMunicipioNac.addEventListener("blur", validarNombres);
miProvinciaNac.addEventListener("blur", validarNombres);
familiaNum.addEventListener("blur", validarFamiliaNumerosa);

miCodigoPostal.addEventListener("blur", validarCodigoPostal);
miMunicipio.addEventListener("blur", validarNombres);
miProvincia.addEventListener("blur", validarNombres);
telefonoUrgencia.addEventListener("blur", validarTelefonosUrgencia);

nombreApeProgenitor1.addEventListener("blur", validarNombres);
dniProgenitor1.addEventListener("blur", validarDNI);
telefonoProgenitor1.addEventListener("blur", validarTelefono);
correoProgenitor1.addEventListener("blur", validarCorreo);
nombreApeProgenitor2.addEventListener("blur", validarNombres);
dniProgenitor2.addEventListener("blur", validarDNI);
telefonoProgenitor2.addEventListener("blur", validarTelefono);
correoProgenitor2.addEventListener("blur", validarCorreo);


if(miCurso == "SMR2" || miCurso == "SMR1" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
    miCorreo.addEventListener("blur", validarCorreo);
}
if(miCurso !== "1ESO" && miCurso !== "2ESO"){
    
    miDNI.addEventListener("blur", validarDNI);
}


if(miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
    miTelefono.addEventListener("blur", validarTelefono);
}

if(miCurso == "SMR2" || miCurso == "SMR1" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
    trabaja.addEventListener("blur", validarFamiliaNumerosa); 
}

if(miCurso == "CFGB2" || miCurso == "SMR2" || miCurso == "PEFP2" || miCurso == "DAM2" || miCurso == "DAW2"){
    cambioDT.addEventListener("blur", validarFamiliaNumerosa);
}


if(miCurso == "1BTOCIENCIAS" || miCurso == "1BTOHUMCSO" || miCurso == "2BTOCIENCIAS" || miCurso == "2BTOHUMCSO"){
    var listaOptativas = document.querySelectorAll('td[id$="_optativas"]').length;
    if(miCurso == "1BTOHUMCSO" || miCurso == "2BTOCIENCIAS" || miCurso == "2BTOHUMCSO"){
        var listaModalidades = document.querySelectorAll('td[id$="_modalidad"]').length;
    }
    let listaMateriasModalidad = document.querySelectorAll('td[id$="_modalidad"] input');
    if(miCurso == "1BTOHUMCSO" || miCurso == "2BTOHUMCSO" || miCurso == "2BTOCIENCIAS"){
        let radios = document.querySelectorAll("input[type='radio'][name='obligatorias']");
        radios.forEach(element => element.addEventListener('change',()=>{
            trasladarObligatoriaAModalidad();
        }));       
    }
    listaMateriasModalidad.forEach(element=>{
        element.addEventListener('change',()=>{
            trasladarUltimosAListaOptativas();
        });
    });
}


function trasladarObligatoriaAModalidad(){
    let clasesAniadidas = document.querySelectorAll('.obligatoriaAniadido');
    clasesAniadidas.forEach(element=>element.remove());
    let radio = document.querySelector("input[type='radio'][name='obligatorias']:not(:checked)");
    let radioChecked = document.querySelector("input[type='radio'][name='obligatorias']:checked");
    document.getElementById('preferenciaClasesObligatoria').value = radioChecked.value;
    let listaModalidad = document.getElementById("clasesModalidad");
    let nuevoTr = document.createElement("tr");
    nuevoTr.classList.add("obligatoriaAniadido");

    let nuevoTd = document.createElement("td");
    nuevoTd.id = (listaModalidades+1).toString()+"_modalidad";

    let nuevoInput= document.createElement("input");
    nuevoInput.type="number";
    nuevoInput.classList.add("clasesModalidad");
    nuevoInput.min="1";
    nuevoInput.max="5";
    nuevoInput.name=radio.parentElement.id.substring(radio.parentElement.id.indexOf("obligatorias") + "obligatorias".length);
    nuevoInput.setAttribute('onchange',"trasladarUltimosAListaOptativas()")
    nuevoTd.appendChild(nuevoInput);
    nuevoTd.innerHTML += " " + radio.parentElement.innerHTML.substring(radio.parentElement.innerHTML.search(">")+2); 
    nuevoTr.appendChild(nuevoTd);
    nuevoTr.innerHTML += "<td>4 horas</td>"
    listaModalidad.appendChild(nuevoTr);
}

function trasladarUltimosAListaOptativas(){
    if(miCurso == "2BTOCIENCIAS"){
        let listaMateriasModalidad = document.querySelectorAll('td[id$="_modalidad"] input');        
        let listaM = [];
        listaMateriasModalidad.forEach(element=>{
            listaM.push({valor:element.value,nombreAsignatura:element.parentElement.innerHTML.substring(element.parentElement.innerHTML.search(">")+2)});
        });
        console.log(listaM);
        let clasesAniadidas = document.querySelectorAll('.aniadido');
        clasesAniadidas.forEach(element=>element.remove());
        listaM.forEach(element=>{
            if(element.valor == (5) ||element.valor == (4) ){
                if(element.valor == (4)){
                    let nuevoTd = document.createElement("tr");
                    nuevoTd.classList.add("aniadido")            
                    nuevoTd.innerHTML="<td id='"+(listaOptativas+1)+"_optativas'><input type='number' class='clasesOptativas' min='1' max='5' > "+element.nombreAsignatura+"</td><td>4 horas</td>"
                    document.getElementById("tablaOptativas").appendChild(nuevoTd);
                }
                else{
                    let nuevoTd = document.createElement("tr");
                    nuevoTd.classList.add("aniadido")            
                    nuevoTd.innerHTML="<td id='"+(listaOptativas+2)+"_optativas'><input type='number' class='clasesOptativas' min='1' max='5' > "+element.nombreAsignatura+"</td><td>4 horas</td>"
                    document.getElementById("tablaOptativas").appendChild(nuevoTd);
                }       
            }
        });
    }else{
        let listaMateriasModalidad = document.querySelectorAll('td[id$="_modalidad"] input');
        let listaM = [];
        listaMateriasModalidad.forEach(element=>{
            listaM.push({valor:element.value,nombreAsignatura:element.parentElement.innerHTML.substring(element.parentElement.innerHTML.search(">")+2)});
        });
        console.log(listaM);
        let clasesAniadidas = document.querySelectorAll('.aniadido');
        clasesAniadidas.forEach(element=>element.remove());
        listaM.forEach(element=>{
            if(element.valor == (4) ||element.valor == (3) ){
                if(element.valor == (4)){
                    let nuevoTd = document.createElement("tr");
                    nuevoTd.classList.add("aniadido")            
                    nuevoTd.innerHTML="<td id='"+(listaOptativas+2)+"_optativas'><input type='number' class='clasesOptativas' min='1' max='5' > "+element.nombreAsignatura+"</td><td>4 horas</td>"
                    document.getElementById("tablaOptativas").appendChild(nuevoTd);
                }
                else{
                    let nuevoTd = document.createElement("tr");
                    nuevoTd.classList.add("aniadido")            
                    nuevoTd.innerHTML="<td id='"+(listaOptativas+1)+"_optativas'><input type='number' class='clasesOptativas' min='1' max='5' > "+element.nombreAsignatura+"</td><td>4 horas</td>"
                    document.getElementById("tablaOptativas").appendChild(nuevoTd);
                }       
            }
        });
    }
}


function validarNombres(event) {
    let patron = /^([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/;    
    let valor = event.target.value;
    let elementoError, claseNovalido;

    switch (event.target.id) {
        case 'primer-apellido':
            elementoError = miErrorPrimerApe;
            claseNovalido = 'primer-apellido';
            break;
        case 'segundo-apellido':
            elementoError = miErrorSegundoApe;
            claseNovalido = 'segundo-apellido';
            break;
        case 'nombre':
            elementoError = miErrorNombre;
            claseNovalido = 'nombre';
            break;
        case 'municipio_nacimiento':
            elementoError = miErrorMunicipioNac;
            claseNovalido = 'municipio_nacimiento';
            break;
        case 'provincia_nacimiento':
            elementoError = miErrorProvinciaNac;
            claseNovalido = 'provincia_nacimiento';
            break;
        case 'municipio':
            elementoError = miErrorMunicipio;
            claseNovalido = 'municipio';
            break;
        case 'provincia':
            elementoError = miErrorProvincia;
            claseNovalido = 'provincia';
            break;
        case 'nombre_apellidos_progenitor1':
            elementoError = miErrornombreApeProgenitor1   ;
            claseNovalido = 'nombre_apellidos_progenitor1';
            break;
        case 'nombre_apellidos_progenitor2':
                elementoError = miErrornombreApeProgenitor2   ;
                claseNovalido = 'nombre_apellidos_progenitor2';
                break;
        default:
            return false;
    }

    if (!valor.match(patron)) {
        event.target.classList.add('novalido');
        elementoError.innerHTML = 'El formato no es válido, la primera letra debe ser mayúscula y el resto minúscula';
        return false;
    } else {
        event.target.classList.remove('novalido');
        elementoError.innerHTML = '';
    }

    return true;
}

function validarDNI(event) {
    let patron = /^\d{8}[A-Z]$/;
    let valorDNI = event.target.value;
    let elementoError, claseNovalido;

    if (event.target.id === 'dni') {
        elementoError = miErrorDNI;
        claseNovalido = 'dni';
    } else if (event.target.id === 'dni_progenitor1') {
        elementoError = miErrordniProgenitor1;
        claseNovalido = 'dni_progenitor1';
    } else if (event.target.id === 'dni_progenitor2') {
        elementoError = miErrordniProgenitor2;
        claseNovalido = 'dni_progenitor2';
    }

    if (!valorDNI.match(patron)) {
        event.target.classList.add('novalido');
        elementoError.innerHTML = 'El formato no es valido, debe constar de 8 números y una letra en mayúscula';
        return false;
    } else {
        let numeros = valorDNI.substring(0, 8);
        let letraUsuario = valorDNI.charAt(8).toUpperCase();
        let letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        let letraCalculada = letras[numeros % 23];
        if (letraUsuario !== letraCalculada) {
            event.target.classList.add('novalido');
            elementoError.innerHTML = 'La letra del DNI no es valida';
            return false;
        } else {
            event.target.classList.remove('novalido');
            elementoError.innerHTML = '';
        }
    }
    return true;
}

function validarSexo() {
    let patron = /^[HM]$/;
    let valorSexo = miSexo.value;
    if (!valorSexo.match(patron)) {
        miSexo.classList.add('novalido');
        miErrorSexo.innerHTML = 'El formato no es valido, debe ser "H" o "M"';
        return false;
    } else {
        miSexo.classList.remove('novalido');
        miErrorSexo.innerHTML = '';
        return true;
    }
}

function validarFamiliaNumerosa(event){
    let patron = /^(SI|NO)$/;
    let valor = event.target.value;
    let elementoError;

    switch (event.target.id) {
        case 'familia_numerosa':
            elementoError = miErrorFamiliaNum;
            break;
        case 'trabaja':
            elementoError = miErrortrabaja;
            break;
        case 'cambioDT':
            elementoError = miErrorcambioDT;
            break;
        default:
            return false;
    }

    if (!valor.match(patron)) {
        event.target.classList.add('novalido');
        elementoError.innerHTML = 'El formato no es válido. Debe ser "SI" o "NO"';
        return false;
    } else {
        event.target.classList.remove('novalido');
        elementoError.innerHTML = '';
    }

    return true;
}


function validarTelefono(event) {
    let patron = /^(\d{9})$/;
    
    let valor = event.target.value;
    let elementoError;

    if (event.target.id === 'telefono_progenitor1') {
        elementoError = miErrortelefonoProgenitor1;
    } else if (event.target.id === 'telefono_progenitor2') {
        elementoError = miErrortelefonoProgenitor2;
    }else if (event.target.id === 'telefonoAlumno') {
        elementoError = miErrorTelefono;
    }

    if (!valor.match(patron)) {
        event.target.classList.add('novalido');
        elementoError.innerHTML = 'El formato no es válido. Deben ser 9 dígitos.';
        return false;
    } else {
        event.target.classList.remove('novalido');
        elementoError.innerHTML = '';
    }

    return true;
}

function validarCorreo(event) {
    let patron =  /.+@.+\.(com|es|org)$/;
    let valor = event.target.value;
    let elementoError;
    

    switch (event.target.id) {
        case 'correoAlumno':
            elementoError = miErrorCorreo;
            break;
        case 'correo_progenitor1':
            elementoError = miErrorcorreoProgenitor1;
            break;
        case 'correo_progenitor2':
            elementoError = miErrorcorreoProgenitor2;
            break;
        default:
            return false;
    }

    if (!valor.match(patron)) {
        event.target.classList.add('novalido');
        elementoError.innerHTML = 'El formato no es válido. Debe ser nombre@dominio.com/es/org';
        return false;
    } else {
        event.target.classList.remove('novalido');
        elementoError.innerHTML = '';
    }

    return true;
}


function validarCodigoPostal() {
    let patron = /^\d{5}$/; 
    let valorCodigoPostal = miCodigoPostal.value;

    if(!valorCodigoPostal.match(patron)){
        miCodigoPostal.classList.add('novalido');
        miErrorCodigoPostal.innerHTML = 'El formato no es valido, debe ser tener 5 núneros enteros';
        return false;
    }else{
        miCodigoPostal.classList.remove('novalido');
        miErrorCodigoPostal.innerHTML = '';
        return true;
    }
}

function validarTelefonosUrgencia() {
    let patron = /^\d{9}(,\s?\d{9})?$/; 
    let valorTelefonoUrgencia = telefonoUrgencia.value;

    if(!valorTelefonoUrgencia.match(patron)){
        telefonoUrgencia.classList.add('novalido');
        miErrortelefonoUrgencias.innerHTML = 'El formato no es valido, Deben ser 9 dígitos (si se añade más de uno debe ir separado de una ",")';
        return false;
    }else{
        telefonoUrgencia.classList.remove('novalido');
        miErrortelefonoUrgencias.innerHTML = '';
        return true;
    }
}

function validarmateriasOptativas(){
    let miCurso = document.forms.matriculas['curso'].value;
    let asignaturas = "";
    switch(miCurso){
        case "1ESO":
            asignaturas = "1,2,3"
        break;
        case "2ESO":
            asignaturas = "1,2,3"
        break;
        case "3ESO":
            asignaturas = "1,2,3"
        break;
        case "4ESO":
            asignaturas = "1,2,3,4,5"
        break;
        case "1BTOCIENCIAS":
            asignaturas = "1,2,3,4"
        break;
        case "2BTOCIENCIAS":
            asignaturas = "1,2,3"
        break;
        case "1BTOHUMCSO":
            asignaturas = "1,2,3,4"
        break;
        case "2BTOHUMCSO":
            asignaturas = "1,2,3"
        break;
    }

    let clases = document.querySelectorAll('.clasesOptativas');     /*Lo ha puesto el usuario (supuesto orden) */
    let arrayClases = [];       /*Clases usuario eleccion */
    let arrayClasesMal = [];
    let arrayClasesEnOrden = [];    /*Array ordenar clases */
    clases.forEach(clase=>{
        if(clase.value != null && clase.value != ""){
            arrayClases.push(clase.value);  
        }    
        arrayClasesMal.push(clase.value);
    });
    console.log(arrayClases);

      //Mostrar en orden en pdf 
      let indexClasesMal = 0;
    let indexPreferencia = 0;   /* el orden de las clases segun el usuario (de aqui pillamos las clases sin ordenar)
                                    "2:[0],3:[1],1:[2]" por eso empezammos a cero*/
    for (let idClase = 1; idClase <= arrayClasesMal.length; idClase++,indexClasesMal++) {       //Metemos clases segun preferencia 
    if(arrayClasesMal[indexClasesMal] == ""){
        continue;
    }
    //Recorremos el array
        arrayClasesEnOrden[arrayClases[indexPreferencia]-1] = document.getElementById(idClase+"_optativas".toString()).innerHTML.substring(document.getElementById(idClase+"_optativas".toString()).innerHTML.search(">")+2)
        indexPreferencia++
    }

    let arrayOrdenado = arrayClases.sort((a, b) => a - b).toString();       //Ordena un array numericamente (ordena la eleccion de usuario) 
    if(arrayOrdenado!=asignaturas){
        return false;
    }

    document.getElementById("preferenciaClasesOptativas").value = arrayClasesEnOrden.join("/");     //En vez de separar por , separamos con /
    console.log(arrayClasesEnOrden.join());
    return true;   
}

function validarmateriasOpcion(){
    /*A crear funcion y añadir en validar SOLO 4ESO*/
    let  asignaturas = "1,2,3,4,5"

    let clases = document.querySelectorAll('.clasesOpcion');    /*Lo ha puesto el usuario (supuesto orden) */
    let arrayClases = [];   /*Clases usuario eleccion */
    let arrayClasesMal = [];
    let arrayClasesEnOrden = [];    /*Array ordenar clases */
    clases.forEach(clase=>{
        if(clase.value != null && clase.value != ""){
            arrayClases.push(clase.value);  
        }    
        arrayClasesMal.push(clase.value);
    });
    console.log(arrayClases);

      //Para mostrar en orden en pdf 
      let indexClasesMal = 0;
    let indexPreferencia = 0; /* el orden de las clases segun el usuario (de aqui pillamos las clases sin ordenar)
                                "2:[0],3:[1],1:[2]" por eso empezammos a cero*/
    for (let idClase = 1; idClase <= arrayClasesMal.length; idClase++,indexClasesMal++) {   //Metemos clases segun preferencia 
    if(arrayClasesMal[indexClasesMal] == ""){
        continue;
    }
    //Recorremos el array
        arrayClasesEnOrden[arrayClases[indexPreferencia]-1] = document.getElementById(idClase+"_opcion".toString()).innerHTML.substring(document.getElementById(idClase+"_opcion".toString()).innerHTML.search(">")+2)
        indexPreferencia++
    }

    let arrayOrdenado = arrayClases.sort((a, b) => a - b).toString();   //Ordena un array numericamente (ordena la eleccion de usuario) 
    if(arrayOrdenado!=asignaturas){
        return false;
    }

    document.getElementById("preferenciaClasesOpcion").value = arrayClasesEnOrden.join("/");        //En vez de separar por , separamos con /
    console.log(arrayClasesEnOrden.join());
    return true;   
}


function validarmateriasModalidad(){
    /*A crear funcion y añadir en validar */
    let miCurso = document.forms.matriculas['curso'].value;

    let asignaturas = "";
    switch(miCurso){
        case "1BTOCIENCIAS":
            asignaturas = "1,2,3,4"
        break;
        case "2BTOCIENCIAS":
            asignaturas = "1,2,3,4,5"
        break;
        case "1BTOHUMCSO":
            asignaturas = "1,2,3,4"
        break;
        case "2BTOHUMCSO":
            asignaturas = "1,2,3,4"
        break;
    } 
    let clases = document.querySelectorAll('.clasesModalidad');     /*Lo ha puesto el usuario (supuesto orden) */
    let arrayClases = [];   /*Clases usuario eleccion */
    let arrayClasesMal = [];
    let arrayClasesEnOrden = [];    /* Array ordenar clases */
    clases.forEach(clase=>{
        if(clase.value != null && clase.value != ""){
            arrayClases.push(clase.value);   
        }    
        arrayClasesMal.push(clase.value);
    });
    console.log(arrayClases);

      //Mostrar en orden en pdf 
      let indexClasesMal = 0;
    let indexPreferencia = 0;   /* el orden de las clases segun el usuario (de aqui pillamos las clases sin ordenar)
                                "2:[0],3:[1],1:[2]" por eso empezammos a cero*/
    for (let idClase = 1; idClase <= arrayClasesMal.length; idClase++,indexClasesMal++) {       //Metemos clases segun preferencia 
    if(arrayClasesMal[indexClasesMal] == ""){
        continue;
    }
    //Recorremos el array
        arrayClasesEnOrden[arrayClases[indexPreferencia]-1] = document.getElementById(idClase+"_modalidad".toString()).innerHTML.substring(document.getElementById(idClase+"_modalidad".toString()).innerHTML.search(">")+2)
        indexPreferencia++
    }

    let arrayOrdenado = arrayClases.sort((a, b) => a - b).toString();       //Ordena un array numericamente (ordena la eleccion de usuario) 
    if(arrayOrdenado!=asignaturas){
        return false;
    }

    document.getElementById("preferenciaClasesModalidad").value = arrayClasesEnOrden.join("/");     //En vez de separar por , separamos con /
    console.log(arrayClasesEnOrden.join());
    return true;  
}


function validarDatos() {
    //Validar datos generales
    let primerApellidoValido = document.forms.matriculas['primer-apellido'].value;
    let segundoApellidoValido = document.forms.matriculas['segundo-apellido'].value;
    let nombreValido = document.forms.matriculas['nombre'].value;

    //Validar datos que no son generales
    if(miCurso !== "1ESO" && miCurso !== "2ESO"){
        let dniValido = document.forms.matriculas['dni'].value;
    }
    let sexoValido = document.forms.matriculas['sexo'].value;
    let municipioNacValido = document.forms.matriculas['municipio_nacimiento'].value;
    let provinciaNacValido = document.forms.matriculas['provincia_nacimiento'].value;
    let familiaNumerosaValido = document.forms.matriculas['familia_numerosa'].value;
    let codigoPostalValido = document.forms.matriculas['codigo_postal'].value;
    let miMunicipioValido = document.forms.matriculas['municipio'].value;
    let miProvinciaValido = document.forms.matriculas['provincia'].value; 
    let telefonoUrgenciasValido = document.forms.matriculas['telefono_urgencia'].value;

    let fecha_nacimientoValido = document.forms.matriculas['fecha_nacimiento'].value;
    let calleValido = document.forms.matriculas['calle'].value;
    let numeroValido = document.forms.matriculas['numero'].value; 

    let centroAnteriorValido = document.forms.matriculas['centro'].value;
    let localidadcentroAnteriorValido = document.forms.matriculas['localidad_centro'].value;
    let provinciacentroAnteriorValido = document.forms.matriculas['provincia_centro'].value;
    let cursoAnteriorValido = document.forms.matriculas['curso_antiguo'].value;

    let nombreApeProgenitor1Valido = document.forms.matriculas['nombre_apellidos_progenitor1'].value;
    let dniprogenitor1Valido = document.forms.matriculas['dni_progenitor1'].value;
    let telefonoProgenitor1Valido = document.forms.matriculas['telefono_progenitor1'].value;
    let correoProgenitor1Valido = document.forms.matriculas['correo_progenitor1'].value;
    let nombreApeProgenitor2Valido = document.forms.matriculas['nombre_apellidos_progenitor2'].value;
    let dniprogenitor2Valido = document.forms.matriculas['dni_progenitor2'].value; 
    let telefonoProgenitor2Valido = document.forms.matriculas['telefono_progenitor2'].value;
    let correoProgenitor2Valido = document.forms.matriculas['correo_progenitor2'].value;

    if(miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
        let miCorreoValido = document.forms.matriculas['correoAlumno'].value;
    }
    
    if(miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
        let miTelefonoValido = document.forms.matriculas['telefonoAlumno'].value;
    }
    
    if(miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
        let trabajaValido = document.forms.matriculas['trabaja'].value;
    }
    
    if(miCurso == "SMR2" || miCurso == "PEFP2" || miCurso == "DAM2" || miCurso == "DAW2"){
        let cambioValido = document.forms.matriculas['cambioDT'].value;
    }

        //Verificar validez de los datos
        let validacionCorrecta = validarNombres({ target: document.getElementById('primer-apellido') }) && 
                                  validarNombres({ target: document.getElementById('segundo-apellido') }) && 
                                  validarNombres({ target: document.getElementById('nombre') }) && 
                                  validarSexo() && 
                                  validarNombres({ target: document.getElementById('municipio_nacimiento') }) && 
                                  validarNombres({ target: document.getElementById('provincia_nacimiento') }) && 
                                  validarFamiliaNumerosa(({ target: document.getElementById('familia_numerosa') })) && 
                                  validarCodigoPostal() && 
                                  validarNombres({ target: document.getElementById('municipio') }) && 
                                  validarNombres({ target: document.getElementById('provincia') }) && 
                                  validarTelefonosUrgencia({ target: document.getElementById('telefono_urgencia')})
                && validarNombres({ target: document.getElementById('nombre_apellidos_progenitor1') }) 
                && validarDNI({ target: document.getElementById('dni_progenitor1') })
                && validarTelefono({ target: document.getElementById('telefono_progenitor1') }) 
               && validarCorreo({ target: document.getElementById('correo_progenitor1') })
                /* && validarNombres({ target: document.getElementById('nombre_apellidos_progenitor2') })
                 && validarDNI({ target: document.getElementById('dni_progenitor2') })
                 && validarTelefono({ target: document.getElementById('telefono_progenitor2') })
                 && validarCorreo({ target: document.getElementById('correo_progenitor2') })*/;
            

            if(miCurso == "SMR2"){
                validacionCorrecta = validacionCorrecta && validarCorreo({ target: document.getElementById('correoAlumno')});
            }            
            
            if(miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
                validacionCorrecta = validacionCorrecta && validarTelefono({ target: document.getElementById('telefonoAlumno')});
            }
            
            if(miCurso == "SMR2" || miCurso == "SMR1" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "DAW1" || miCurso == "DAW2"){
                validacionCorrecta = validacionCorrecta && validarFamiliaNumerosa({ target: document.getElementById('trabaja')});
            }
            
            if(miCurso == "SMR2" || miCurso == "PEFP2" || miCurso == "DAM2" || miCurso == "DAW2"){
                validacionCorrecta = validacionCorrecta && validarFamiliaNumerosa({ target: document.getElementById('cambioDT')});
            }
            if(miCurso !== "1ESO" && miCurso !== "2ESO"){
                validacionCorrecta = validacionCorrecta && validarDNI({ target: document.getElementById('dni') });
            }
        if (!validacionCorrecta) {
            alert("Los datos son incorrectos.");
            return;
        }  

        if(!fecha_nacimientoValido){
            alert("Por favor, rellene su fecha de nacimiento");
            return; 
        }

        if(!calleValido || !numeroValido){
            alert("Por favor, rellene su dirección");
            return;
        }
        
        if(miCurso == "1ESO" || miCurso == "CFGB1" || miCurso == "CFGB2" || miCurso == "SMR1" || miCurso == "SMR2" || miCurso == "DAW1" || miCurso == "DAW2" || miCurso == "DAM1" || miCurso == "DAM2" || miCurso == "PEFP1" || miCurso == "PEFP2"){
            if(!centroAnteriorValido || !localidadcentroAnteriorValido || !provinciacentroAnteriorValido || !cursoAnteriorValido){
            alert("Por favor, rellene los datos académicos del curso anterior");
            return;
            }
        }
    
        if(miCurso == "1ESO" || miCurso == "2ESO" || miCurso == "3ESO" || miCurso == "4ESO"){
            let bilingue = document.forms.matriculas['bilingue'].value;
            if(!bilingue){
                alert("Por favor, rellene si desea cursar el programa bilingüe");
                return;
            }
        }
    
        if(miCurso == "1ESO" || miCurso == "2ESO" || miCurso == "3ESO" || miCurso == "4ESO" || miCurso == "1BTOCIENCIAS" || miCurso == "1BTOHUMCSO"){
        let religion = document.forms.matriculas['religion'].value;
            if(!religion){
                alert("Por favor, rellene si desea cursar Religión");
                return;
            }
        }
        let ampa = document.forms.matriculas['ampa'].value;
        if(!ampa){
            alert("Por favor, rellene si desea pertenecer al ampa");
            return;
        }
    
        if(miCurso == "4ESO"){
            let mates = document.forms.matriculas['comunes_mates'].value;
            if(!mates){
                alert("Por favor, elija Matemáticas A o Matemáticas B");
                return
            }
            if(!validarmateriasOpcion()){
                alert("Por favor, elija las Materias de Opción");
                return;
            }
        }

        if(miCurso == "1BTOHUMCSO" || miCurso == "2BTOHUMCSO" || miCurso == "2BTOCIENCIAS"){
            let obligatoria = document.forms.matriculas['obligatorias'].value;
            if(!obligatoria){
            alert("Por favor, elija una Materia Obligatoria");
            return;
        }
        }

        if(miCurso == "1BTOCIENCIAS" || miCurso == "1BTOHUMCSO" || miCurso == "2BTOCIENCIAS" || miCurso == "2BTOHUMCSO"){
            if(!validarmateriasModalidad()){
                alert("Por favor, elija las Materias de Modalidad");
                return;
            }
        }
       
        if(miCurso !== "DAW1" || miCurso !== "DAW2" || miCurso !== "DAM1" || miCurso !== "DAM2" || miCurso !== "PEFP1" || miCurso !== "PEFP2"){
            if(!validarmateriasOptativas()){
                alert("Por favor, elija las Materias de Optativas");
                return
            } 
        }       

        alert("Los datos son válidos. Generando PDF...");
        document.getElementById('matriculas').submit();
    }