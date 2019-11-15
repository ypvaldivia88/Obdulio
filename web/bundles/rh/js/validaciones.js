//key >= 48 && key <= 57    -- Números
//(key >= 65 && key <= 90)  -- Letras Mayúsculas
//(key >= 97 && key <= 122) -- Letras Minúsculas
//backspace 	8
//tab           9
//enter 	13
//shift 	16
//ctrl          17
//alt           18
//pause/break 	19
//caps lock 	20
//escape 	27
//page up 	33
//page down 	34
//end           35
//home          36
//left arrow 	37
//up arrow 	38
//right arrow 	39
//down arrow 	40
//,     	44
//insert 	45
//delete 	46 

function OnlyNumbers(evt){
  var evento = evt || window.event;
  var key = evento.charCode || evento.keyCode;
  if(key ==9 || key==13 || (key >= 48 && key <= 57) || key == 8 || key == 37 || key == 39)
	return true;
  return false;	
}

function OnlyFloat(evt){
  var evento = evt || window.event;
  var key = evento.charCode || evento.keyCode;
  if(key ==9 || key==13 || (key >= 48 && key <= 57) || key == 8 || key == 37 || key == 39 || key == 44 || key == 46)
	return true;
  return false;	
}

function ValidarNada(evt){
  var key = evt.keyCode || evt.which;
  //alert(key);
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[]+$/;
  
  if (RegExPattern.test(tecla) || key ==9 || key==13)
    return true;
  else     
    return false;	
}

function ValidarString(evt){
  var key = evt.keyCode || evt.which;
  //alert(key);
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[a-zA-Z .,-ñÑáÁéÉíÍóÓúÚüÜ]+$/;
  
  if (RegExPattern.test(tecla) || key == 8 || key == 37 || key == 39 || key ==9 || key==13)
    return true;
  else     
    return false;	
}

function ValidarIncidencia(evt){
  var key = evt.keyCode || evt.which;
  //alert(key);
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[a-zA-Z ñÑáÁéÉíÍóÓúÚüÜ]+$/;
  
  if (RegExPattern.test(tecla) || key == 8 || key == 37 || key == 39 || key ==9 || key==13)
    return true;
  else     
    return false;	
}

function ValidarUsuario(evt){
  var key = evt.keyCode || evt.which;
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[a-z.]+$/;
  
  if (RegExPattern.test(tecla) || key == 8 || key == 9 || key == 37 || key == 39 || key == 13) 
    return true;
  else     
    return false;	
}

function ValidarClave(evt){
  var key = evt.keyCode || evt.which;
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[a-zA-z0-9.]+$/;
  
  if (RegExPattern.test(tecla) || key == 8 || key == 9 || key == 37 || key == 39 || key == 13) 
    return true;
  else     
    return false;	
}

function ValidarColumna(evt){
  var key = evt.keyCode || evt.which;
  var tecla = String.fromCharCode(key).toString();  
  var RegExPattern=/^[A-Z]+$/;
  
  if (RegExPattern.test(tecla) || key == 8 || key == 9 || key == 37 || key == 39 || key == 13) 
    return true;
  else     
    return false;	
}

function ValidarTallaZapatos(value){
  if (value>=34 && value<=47){
      document.getElementById("divZapatos").setAttribute("class","form-group col-md-6");
      return true;
  }
  else{      
      document.getElementById("trabajador_otrosDatos_tallaZapatos").value="";
      document.getElementById("trabajador_otrosDatos_tallaZapatos").setAttribute('placeholder','Recuerde que solo están las medidas del 34 al 37!!!');
      document.getElementById("trabajador_otrosDatos_tallaZapatos").focus();
      document.getElementById("divZapatos").setAttribute("class","form-group col-md-6 has-error");
  }
  
}

/*function ValidarCodigoTelefonico(value){
    //alert(value.length);return;
  if (value.length==4){
      document.getElementById("divCodigo").setAttribute("class","form-group col-md-6");
      return true;
  }
  else{      
      document.getElementById("municipio_codigoTelefonico").value="";
      document.getElementById("municipio_codigoTelefonico").setAttribute('placeholder','El código debe ser de 4 dígitos. Ej: Sancti Spíritus y Jatibonico sería 4188!!!');
      document.getElementById("municipio_codigoTelefonico").focus();
      document.getElementById("divCodigo").setAttribute("class","form-group col-md-6 has-error");
  }
  
}*/

function ValidarAlto(value){
  if (value>=100 && value<=300){
      document.getElementById("divAlto").setAttribute("class","form-group col-md-6");
      return true;
  }
  else{      
      document.getElementById("trabajador_otrosDatos_alto").value="";
      document.getElementById("trabajador_otrosDatos_alto").setAttribute('placeholder','Solo en el rando de 100 a 300 cm!!!');
      document.getElementById("trabajador_otrosDatos_alto").focus();
      document.getElementById("divAlto").setAttribute("class","form-group col-md-6 has-error");
  }
  
}

function ValidarPeso(value){
  if (value>=50 && value<=300){
      document.getElementById("divPeso").setAttribute("class","form-group col-md-6");
      return true;
  }
  else{      
      document.getElementById("trabajador_otrosDatos_peso").value="";
      document.getElementById("trabajador_otrosDatos_peso").setAttribute('placeholder','Solo en el rando de 50 a 300 libras!!!');
      document.getElementById("trabajador_otrosDatos_peso").focus();
      document.getElementById("divPeso").setAttribute("class","form-group col-md-6 has-error");
  }
  
}

function ValidarTelefonoCelular(value){
  if (value.charAt(0)=='5' && value.length==8){
      document.getElementById("divTelefonoCelular").setAttribute("class","form-group col-md-6");
      return true;
  }
  else{      
      document.getElementById("trabajador_otrosDatos_telefonoCelular").value="";
      document.getElementById("trabajador_otrosDatos_telefonoCelular").setAttribute('placeholder','Recuerde que el teléfono celular comienza con 5 y tiene 8 dígitos!!!');
      document.getElementById("trabajador_otrosDatos_telefonoCelular").focus();
      document.getElementById("divTelefonoCelular").setAttribute("class","form-group col-md-6 has-error");
  }
  
}

function CambioLength(){
    var length = document.getElementById("trabajador_no").value.length;
    if(length<5){
        document.getElementById("divNo").setAttribute("class","form-group col-md-6");
        document.getElementById("divAlertDanger").setAttribute("class","alert alert-danger alert-dismissible hidden")
    }    
    else
      document.getElementById("divNo").setAttribute("class","form-group col-md-6 has-error");
}

