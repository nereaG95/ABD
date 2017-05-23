/*Author: Nerea Gómez Domínguez*/

var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
window.onclick = function(event) {
    if (event.target == modal || event.target == modal2 ) {
        modal.style.display = "none";
    }
}

$(document).ready(function(){
	 $("#add_err").hide();
	 $("#login").click(function(){	
		  var login="login";
		  $("#add_err").hide();
		  name=$("#name").val();
		  pass=$("#pass").val();
			if(valida(login,name,pass)){
				  $.ajax({
				   type: "POST",
				   url: "procesaLogin.php",
					data: "name="+name+"&pass="+pass,
				   success: function(html){   
					if(html == '1'){
						$("#add_err").hide();
						window.location.replace("admin.php");
					}
					else if(html == '2'){
						$("#add_err").hide();
						window.location.replace("index.php");
					}
					else{
						$("#add_err").slideDown();
						$("#add_err").delay(2000);
						$("#add_err").slideUp()
					}
				   }
				   
				  });
			}
		return false;
	});
});

function mostrar(id) {
    if (id == "personal") {
        $("#personal").show();
        $("#grupal").hide();
    }

    if (id == "grupo") {
        $("#personal").hide();
        $("#grupal").show();
    }
    if (id == "comun") {
        $("#personal").hide();
        $("#grupal").hide();
    }
}

//Para controlar el registro
$(document).ready(function(){
	 $("#add_err2").hide();
	 $("#registro").click(function(){
		 var registro="registro";
		  $("#add_err2").hide();
		  name=$("#user").val();
		  pass=$("#contra").val();
			  if(valida(registro,name,pass)){
				  var categorias2 = new Array();
		 
				  $("input:checkbox:checked").each(function() {
						categorias2.push($(this).val());
				  });
				  var categorias = JSON.stringify(categorias2)
				  edad=$("#edad").val();
				  $.ajax({
				   type: "POST",
				   url: "procesaRegistro.php",
				   data: "name="+name+"&pass="+pass+"&edad="+edad+"&categorias="+categorias,
				   success: function(html){   
					if(html == '1'){
						$("#add_err2").hide();
						window.location.replace("index.php");
					}
					else{
						$("#add_err2").slideDown();
						$("#add_err2").delay(2000);
						$("#add_err2").slideUp()
					}
				   }
				   
				  });
		 }
		return false;
	});
})


//Para validar el registro
function valida(tipo,user,pass) {
	var ok = true;
	var longi = true;
	var msg = "Faltan los siguientes campos:\n";
	var suma = 0;

	if(user == "")
	{
		msg += "- User\n";
		ok = false;
	}

	if(pass == "")
	{
		msg += "- Contraseña\n";
		ok = false; 
		longi = false;
	}
	if(longi == true){
		if(pass.length < 8){
		  msg += "-Contraseña muy corta\n";
		  ok=false;
		}
	}
	if(tipo=="registro"){
		$("input:checkbox:checked").each(function() {
			suma++;
		});
		
		if(suma == 0){
			msg += "-Seleccionar un tipo de música\n";
			ok=false;
		}
	}
	if(ok == false){
		alert(msg);
	}
	return ok;
}

//Para controlar el envio de mensajes
$(document).ready(function(){
	 $("select[name=opcion]").change(function(){
		 $('#botonsms').attr("disabled", false);
		 receptor=$("#receptor").val();
		 opcion=$("#opcion").val();
		 grupo=$("#grupo").val();
		//Si cambiamos a las opciones personal o grupo y no hay opciones se deshabilita el botón
		if(opcion=="grupo" && typeof(grupo)=="undefined"){
			$('#botonsms').attr("disabled", true);
		}
		if(opcion=="personal" && typeof(receptor)=="undefined"){
			$('#botonsms').attr("disabled", true);
		}
	 });
	 
	 $("#botonsms").click(function(){
			  $("#correcto").hide();
			  receptor=$("#receptor").val();
			  mensaje=$("#mensaje").val();
			  opcion=$("#opcion").val();
			  grupo=$("#grupo").val();
			  if(mensaje!=''){
				  $.ajax({
				   type: "POST",
				   url: "insertaMensaje.php",
				   data: "receptor="+receptor+"&mensaje="+mensaje+"&grupo="+grupo+"&opcion="+opcion,
				   success: function(html){   
					if(html == '1'){
						$("#correcto").slideDown();
						$("#correcto").delay(2000);
						$("#correcto").slideUp()
						$("#mensaje").val('');
					}
				   }
				   
				  });
			  }
			  else{
				  alert("Debe introducir un mensaje");
			  }
		return false;
	});
})

$(document).ready(function(){
	 $("#add_err3").hide();
	 $("#add").click(function(){
		  if (validaForm()){
			  $("#add_err3").hide();
			  nombre=$("#nombre").val();
			  tipo=$('select[name=tipo]').val();
			  edadMin=$("#edadMin").val();
			  edadMax=$("#edadMax").val();
			  $.ajax({
			   type: "POST",
			   url: "insertaGrupo.php",
			   data: "nombre="+nombre+"&tipo="+tipo+"&edadMin="+edadMin+"&edadMax="+edadMax,
			   success: function(html){   
				if(html == 'true'){
					$("#correcto").slideDown();
					$("#correcto").delay(2000);
					$("#correcto").slideUp();
					document.getElementById("formGrupo").reset();
					//$("#formGrupo").val('');
				}
				else{
					$("#add_err3").show();
				}
			   }
			  });
		}
		return false;
	});
});

function validaForm(){
	 var ok = true;
	var msg = "Debes escribir algo en los campos:\n";
	var escrito = true;

    // Campos de texto
    if($("#nombre").val() == ""){
        msg += "- Nombre del grupo\n";
		ok = false;
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
    }
    if($("#edadMin").val() == ""){
        msg += "- Edad minima\n";
		ok = false;
		escrito=false;
        $("#edadMin").focus();
    }
    if($("#edadMax").val() == ""){
		msg += "- Edad maxima\n";
		escrito=false;
		ok = false;        
		$("#edadMax").focus();
    }
	if(escrito == true){
	  if($("#edadMin").val() > $("#edadMax").val() ){
		  ok=false;
		  msg +="-La edad minima tiene que ser igual o inferior a la edad máxima\n";
	  }
	  }

	  if(ok == false){
		alert(msg);
	  }
	  return ok;
}