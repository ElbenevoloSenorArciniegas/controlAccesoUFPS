/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    No se fije en el corte de cabello, soy mucho muy rico  \\

var rutaBack = '../back/controller/Router.php';
currentPersona = "Error";
CURRENT_USER = -1;
RFID_A_REGISTRAR = -1;


function inicio(){
    getLogged();
}

/** Valida los campos requeridos en un formulario
 * Returns flag Devuelve true si el form cuenta con los datos mÃ­nimos requeridos
 */
function validarForm(idForm){
	var form=$('#'+idForm)[0];
	for (var i = 0; i < form.length; i++) {
		var input = form[i];
		if(input.required && input.value==""){
			return false;
		}
	}
	return true;
}

////////// AUTORIZACION \\\\\\\\\\
function preAutorizacionInsert(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
	formData = {};
    formData["ruta"]="AutorizacionInsert";
    formData["codigo"]=currentPersona;
    formData["autorizadoPor"]=CURRENT_USER;
    formData["entrada"]=EntradaList.value;
    formData["date"]=datepicker.value;
    formData["horaIni"]=horaIni.value;
    formData["horaFin"]=horaFin.value;
        
 	enviar(formData,rutaBack,postAutorizacionInsert);
}

 function postAutorizacionInsert(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
 		if(state=="success"){
             if(result=="true"){            
    	       alert("Autorizacion registrado con Éxito");
               datepicker.value="";
               EntradaList.value="";
               preAutorizacionListByPersona("AutorizacionListByPersona");
             }else{
                alert("Hubo un errror en la inserciÃ³n ( u.u)\n"+result);
             } 
 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function preAutorizacionList(container){
     //Solicite informaciÃ³n del servidor
     cargaContenido(container,'AutorizacionList.html'); 
     var formData = {};
     formData["ruta"]="AutorizacionList";
 	enviar(formData,rutaBack,postAutorizacionList); 
}

 function postAutorizacionList(result,state,byPersona = false){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
        if(byPersona){
            //document.getElementById("AutorizacionListPersona").style.display= "none";
            var col = document.getElementById("AutorizacionListPersona");
            document.getElementById("AutorizacionListTR").removeChild(col);
            botonNuevaAutorizacion.innerHTML="";
        }
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){

            for(var i=1; i < Object.keys(json).length; i++) {
                var Autorizacion = json[i];
                Autorizacion.updateHref='javascript:preUpdateEntity("'+Autorizacion.id+'");';
                Autorizacion.deleteHref='javascript:preDeleteEntity("'+Autorizacion.id+'");';
                delete Autorizacion.id;
                if(byPersona){
                    delete Autorizacion.persona_rfid;
                }

                document.getElementById("AutorizacionListBody").appendChild(createTR(Autorizacion));
            }
            $('#AutorizacionList').DataTable({
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    }
                } );
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function preAutorizacionListByPersona(container){
     //Solicite informaciÃ³n del servidor
     if(currentPersona!="Error"){
         cargaContenido(container,'AutorizacionList.html'); 
         var formData = {};
         formData["ruta"]="AutorizacionListByPersona";
         formData["codigo"]=currentPersona;
        enviar(formData,rutaBack,postAutorizacionListByPersona); 
    }else{
        AutorizacionListByPersona.innerHTML="";
    }
}

 function postAutorizacionListByPersona(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     postAutorizacionList(result,state,true);
}

////////// ENTRADA \\\\\\\\\\
function preEntradaInsert(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	var formData=$('#'+idForm).serialize();
     formData["ruta"]="EntradaInsert";
 	enviar(formData,rutaBack,postEntradaInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postEntradaInsert(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Entrada registrado con Ã©xito");
                     }else{
                        alert("Hubo un errror en la inserciÃ³n ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function preEntradaList(){
     //Solicite informaciÃ³n del servidor
     var formData = {};
     formData["ruta"]="EntradaList";
 	enviar(formData,rutaBack,postEntradaList); 
}

 function postEntradaList(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            removeAllChildren(EntradaList);
            EntradaList.innerHTML="<option value='' disabled selected>Escoja la entrada a autorizar</option>";
            for(var i=1; i < Object.keys(json).length; i++) {   
                var Entrada = json[i];
                EntradaList.appendChild(createOPTION(Entrada.id,Entrada.id));
            }
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

////////// IDENTIFICADOR \\\\\\\\\\
function preIdentificadorInsert(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	var formData=$('#'+idForm).serialize();
     formData["ruta"]="IdentificadorInsert";
 	enviar(formData,rutaBack,postIdentificadorInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postIdentificadorInsert(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Identificador registrado con Ã©xito");
                     }else{
                        alert("Hubo un errror en la inserciÃ³n ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function preIdentificadorList(container){
     //Solicite informaciÃ³n del servidor
     cargaContenido(container,'IdentificadorList.html'); 
     var formData = {};
     formData["ruta"]="IdentificadorList";
 	enviar(formData,rutaBack,postIdentificadorList); 
}

 function postIdentificadorList(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){

            for(var i=1; i < Object.keys(json).length; i++) {   
                var Identificador = json[i];
                //----------------- Para una tabla -----------------------
                document.getElementById("IdentificadorList").appendChild(createTR(Identificador));
                //-------- Para otras opciones ver htmlBuilder.js ---------
            }
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

////////// INTENTO \\\\\\\\\\
function preIntentoInsert(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	var formData=$('#'+idForm).serialize();
     formData["ruta"]="IntentoInsert";
 	enviar(formData,rutaBack,postIntentoInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postIntentoInsert(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Intento registrado con Ã©xito");
                     }else{
                        alert("Hubo un errror en la inserciÃ³n ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function preIntentoList(container){
     //Solicite informaciÃ³n del servidor
     cargaContenido(container,'IntentoList.html'); 
     var formData = {};
     formData["ruta"]="IntentoList";
 	enviar(formData,rutaBack,postIntentoList); 
}

 function postIntentoList(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){
            for(var i=1; i < Object.keys(json).length; i++) {
                var Intento = json[i];
                //----------------- Para una tabla -----------------------
                //document.getElementById("IntentoListBody").appendChild(createTR(Intento));
                var tr = document.createElement("TR");
                //
                var td = document.createElement("TD");
                var cod = Intento.persona_codigo.split("SPLIT");
                if(cod[0]==0){
                    href="javascript:registroPersona('"+cod[1]+"')";
                    var a = document.createElement('A');
                    a.setAttribute('href', href);
                    var textNode = document.createTextNode("No registrado");
                    a.appendChild(textNode);
                    node = a;
                }else{
                    node = document.createTextNode(Intento.persona_codigo);
                }
                td.appendChild(node);
                tr.appendChild(td);
                //
                var td = document.createElement("TD");
                textNode = document.createTextNode(Intento.time);
                td.appendChild(textNode);
                tr.appendChild(td);
                //
                var td = document.createElement("TD");
                textNode = document.createTextNode(Intento.entrada_id);
                td.appendChild(textNode);
                tr.appendChild(td);
                //
                var td = document.createElement("TD");
                span = document.createElement("SPAN");
                span.classList.add("glyphicon");
                if(Intento.isAutorizado==1){
                    span.classList.add("glyphicon-ok");
                    span.style.color="green";
                }else{
                    span.classList.add("glyphicon-remove");
                    span.style.color="red";
                }
                td.appendChild(span);
                tr.appendChild(td);
                document.getElementById("IntentoListBody").appendChild(tr);
                //-------- Para otras opciones ver htmlBuilder.js ---------
            }
            $('#IntentoList').DataTable({
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    }
                    ,
                    "order": [[ 1, "desc" ]]
                } );
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

////////// PERSONA \\\\\\\\\\
function prePersonaInsert(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
	if(validarForm(idForm)){
 	 formData={};
     formData["codigo"]=cod.value;
     formData["nombre"]=nombre.value;
     formData["rfid"]=RFID_A_REGISTRAR;
     formData["img"]="noImg";
     formData["ruta"]="PersonaInsert";
 	 enviar(formData,rutaBack,postPersonaInsert);
 	}else{
 		alert("Debe llenar los campos requeridos");
 	}
}

 function postPersonaInsert(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
 		if(state=="success"){
                     if(result=="true"){            
 			alert("Persona registrado con Éxito");
            btnCerrarModal.click();
            preIntentoList("main");
                     }else{
                        alert("Hubo un errror en la inserciÃ³n ( u.u)\n"+result);
                     } 		}else{
 			alert("Hubo un errror interno ( u.u)\n"+result);
 		}
}

function prePersonaList(container){
     //Solicite informaciÃ³n del servidor
     cargaContenido(container,'PersonaList.html'); 
     var formData = {};
     formData["ruta"]="PersonaList";
 	enviar(formData,rutaBack,postPersonaList); 
}

 function postPersonaList(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){

            for(var i=1; i < Object.keys(json).length; i++) {   
                var Persona = json[i];
                //----------------- Para una tabla -----------------------
                document.getElementById("PersonaList").appendChild(createTR(Persona));
                //-------- Para otras opciones ver htmlBuilder.js ---------
            }
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function prePersonaSelect(){
    var formData = {};
     formData["ruta"]="PersonaSelect";
     formData["codigo"]=inputPersonaSelect.value;
    enviar(formData,rutaBack,postPersonaSelect);
}

function postPersonaSelect(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     if(state=="success"){
         var json=JSON.parse(result);
         if(json[0].msg=="exito"){

            PersonaCodigo.innerHTML = json[1].codigo;
            PersonaNombre.innerHTML = json[1].nombre;
            PersonaImg.src = "images/"+json[1].img+".png";

            currentPersona=json[1].codigo;
            preAutorizacionListByPersona("AutorizacionListByPersona");
            validarAgregar();
         }else{
            alert(json[0].msg);
         }
     }else{
         alert("Hubo un errror interno ( u.u)\n"+result);
     }
}

function login(idForm){
     //Haga aquÃ­ las validaciones necesarias antes de enviar el formulario.
    if(validarForm(idForm)){
     formData={};
     formData["cod"]=loginCodigo.value;
     formData["pass"]=loginPass.value;
     formData["ruta"]="login";
    enviar(formData,rutaBack,postLogin);
    }else{
        alert("Debe llenar los campos requeridos");
    }
}

function postLogin(result,state){
     //Maneje aquÃ­ la respuesta del servidor.
     //Consideramos buena prÃ¡ctica no manejar cÃ³digo HTML antes de este punto.
     var sesTxt=result;
     result=JSON.parse(result);
        if(state=="success"){
             if(result.msg=="true"){
                CURRENT_USER=result.obj;
                sessionStorage.CURRENT_USER = sesTxt;
                getLogged();
             }else{
                alert("Datos incorrectos o no registrados");
             }      
        }else{
            alert("Hubo un errror interno ( u.u)\n"+result);
        }
}

function getLogged() {
    if(sessionStorage.CURRENT_USER!=null){
        CURRENT_USER = JSON.parse(sessionStorage.CURRENT_USER).obj;
    }
    if(CURRENT_USER != -1){
        cargaContenido("main","inicio.html");
    }else{
        cargaContenido("main","login.html");
    }
}


function nuevaAutorizacion() {
    cargaContenido("main","AutorizacionInsert.html");
    setTimeout(function(){ 
        cargaContenido("personaSelect","PersonaSelect.html");
        $( "#datepicker" ).datepicker();
     }, 500);
    preEntradaList();
}

function validarAgregar() {
    if(EntradaList.value != "" && datepicker.value != "" && horaIni.value != "" && horaFin.value 
        && currentPersona != "Error"){
        btnAgregar.href="javascript:preAutorizacionInsert()";
        btnAgregar.classList.add("principal");
    }else{
        btnAgregar.href="#";
        btnAgregar.classList.remove("principal");
    }
}

function registroPersona(rfid){
    btnAbrirModal.click();
    RFID_A_REGISTRAR=rfid;
}

//That's all folks!