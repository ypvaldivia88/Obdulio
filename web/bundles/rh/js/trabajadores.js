function CalcularEdad(valor){
  if (valor.length >= 6){
    var anonaz = valor.charAt(0)+valor.charAt(1);
    var mesnaz = valor.charAt(2)+valor.charAt(3);
    var dianaz = valor.charAt(4)+valor.charAt(5);
    
    if(mesnaz>12){
        $('#message-danger').removeClass('hidden');  
        $('#mensajeAjaxMal').html('<i class="icon fa fa-close"></i> La parte que corresponde al mes no puede exceder de 12');
        $('#trabajador_cid').val('');                 
        $('#divCid').addClass('has-error');
        return false; 
    }    
    else if(mesnaz==01 || mesnaz==03 || mesnaz==05 || mesnaz==07 || mesnaz==08 || mesnaz==10 || mesnaz==12){
        if(dianaz>31){
            $('#message-danger').removeClass('hidden');  
            $('#mensajeAjaxMal').html('<i class="icon fa fa-close"></i> Para ese mes tiene que ser el día 31 o menos');
            $('#trabajador_cid').val('');                 
            $('#divCid').addClass('has-error');
            return false; 
        }
    }
    else if(mesnaz==04 || mesnaz==06 || mesnaz==09 || mesnaz==11){
        if(dianaz>30){
            $('#message-danger').removeClass('hidden');  
            $('#mensajeAjaxMal').html('<i class="icon fa fa-close"></i> Para ese mes tiene que ser el día 30 o menos');
            $('#trabajador_cid').val('');                 
            $('#divCid').addClass('has-error');
            return false; 
        }
    }
    else if(mesnaz==02){
        var a,bisiesto;
        if (anonaz>40)
          a = 1900 + parseFloat(anonaz);
        else  
          a = 2000 + parseFloat(anonaz);
        if ((a % 4 == 0) && ((a % 100 != 0) || (a % 400 == 0)))
            bisiesto = true;
        else
            bisiesto = false;
        if(dianaz>29 && bisiesto){
            $('#message-danger').removeClass('hidden');  
            $('#mensajeAjaxMal').html('<i class="icon fa fa-close"></i> Para años biciestos febrero llega hasta 29');
            $('#trabajador_cid').val('');                 
            $('#divCid').addClass('has-error');
            return false; 
        }
        else if(dianaz>28 && !bisiesto){
            $('#message-danger').removeClass('hidden');  
            $('#mensajeAjaxMal').html('<i class="icon fa fa-close"></i> Para años biciestos febrero llega hasta 28');
            $('#trabajador_cid').val('');                 
            $('#divCid').addClass('has-error');
            return false; 
        }
    }
   
       $('#message-danger').addClass('hidden');  
       $('#divCid').removeClass('has-error'); 
    
       
    
    
    
    //alert(anonaz+"/"+mesnaz+"/"+dianaz);
    if (anonaz>40)
      anonaz = 1900 + parseFloat(anonaz);
    else  
      anonaz = 2000 + parseFloat(anonaz);	

    var fecha = new Date();  
    var dia=fecha.getDate();
    var mes=fecha.getMonth()+1;
    var ano=fecha.getFullYear();
    
 //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
  if ((mesnaz == mes) && (dianaz > dia)) {
    ano=(ano-1); }

  //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
  if (mesnaz > mes) {
    ano=(ano-1);}
 
  //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
  var edad=(ano-anonaz);
  document.getElementById('trabajador_edad').value=edad;
  document.getElementById('trabajador_otrosDatos_fechaNacimiento').value=anonaz+"-"+mesnaz+"-"+dianaz;
  
  //document.getElementById('trabajador_fecha').value=new Date(Date.parse(anonaz+"-"+mesnaz+"-"+dianaz));
  }
}

