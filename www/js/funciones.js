$(document).ready(function() {
	
$("#tipo").focus();

	$("#tipo").change(function(){
		if($("#tipo").val()==""){
			 $.msgBox({
				title: "Error",
				content: "Por favor seleccione un tipo de documento para ser validado",
				type: "error",
				beforeClose: function () {$("#tipo").focus(); return false; }
			});
		 }
		 else{
			$("#udocumento").prop("disabled",false);
			$("#udocumento").focus();
		 }
	});

      $("#udocumento").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      });
	
	
	
	  $("#aceptar").attr("disabled","disabled");
	 msgBoxImagePath = "images/";
	 $("#carga").hide();
	
	 $("#udocumento").blur(function(){
		 if($("#tipo").val()==""){
			 $.msgBox({
				title: "Error",
				content: "Por favor seleccione un tipo de documento para ser validado",
				type: "error",
				beforeClose: function () {$("#tipo").focus(); return false; }
			});
		 }
		 if($("#udocumento").val()==""){
			 $.msgBox({
				title: "Error",
				content: "Por favor Ingrese el número de cédula para ser validada",
				type: "error",
				beforeClose: function () {$("#udocumento").focus(); return false; }
			});
		 }
		  //console.log("sasasas");
		 $("#carga").show();
		 $.ajax({
				type: "POST",
				url: 'php/validarCedula.php',
				beforeSend: function(){
				},
				data:
					{
						documento:$("#udocumento").val(),
						tipo:$("#tipo").val()
					},
				success: function(response)
				{
					//console.log(eval(response));
					if(eval(response) ==1 ){
						$.msgBox({
							title: "Respuesta",
							content: "Ud ya se encuentra registrado.",
							type: "info",
							beforeClose: function () {$("#carga").hide(); window.open("/ptar2022/formulario.php?registro=1","_SELF"); }
						});
						 $("#carga").hide();
					}
					$("#carga").hide();
				}
			});
	 });
	



	
	  
	  $( "#dialog" ).dialog({
		  autoOpen: true,
		  modal:true,
		  width : '80%',
		  //maxWidth: 600,
		  draggable:false,
		  resizable:false,
		  fluid:true,
		  buttons: {
			'CERRAR': function(e) {
			   $("#dialog").dialog("close");
				}
			}
	  });
	  
	   $( "#dialog2" ).dialog({
			  autoOpen: false,
			  modal:true,
			  width : '80%',
			  //maxWidth: 600,
			  draggable:false,
			  resizable:false,
			  fluid:true,
			  buttons: [
				{
				  text: "CERRAR",
				  //icon: "ui-icon-heart",
				  click: function() {
					$( this ).dialog( "close" );
				  }
 
      // Uncommenting the following line would hide the text,
      // resulting in the label being used as a tooltip
      //showText: false
    }
  ]
		  });


$(window).resize(function () {
    fluidDialog();
});

// catch dialog if opened within a viewport smaller than the dialog width
$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
    fluidDialog();
});

function fluidDialog() {
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-content").data("dialog");
        // if fluid option == true
        if (dialog.options.fluid) {
            var wWidth = $(window).width();
            // check window width against dialog width
            if (wWidth < dialog.options.maxWidth + 50) {
                // keep dialog from filling entire screen
                $this.css("max-width", "90%");
            } else {
                // fix maxWidth bug
                $this.css("max-width", dialog.options.maxWidth);
            }
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }
    });

}
	  
	  $('#politica2').css( 'margin-left: 170px !important');

	  
	  $("#politica").click(function(){
		  $('#dialog2').dialog('open');
	  });
	  
	  $("#uso").click(function(){
		  $('#dialog').dialog('open');
	  });
	  
		$("#aceptar").click(function(){
			//$( "#dialog" ).dialog( "open" );
			//alert($("#paises2").val());
			//return;
			 $("#carga").show();
			$.ajax({
				type: "POST",
				url: 'php/guardarDatos.php',
				data:
					{
						tipo:$("#tipo").val(),
						documento:$("#udocumento").val(),
						nombres:$("#uname").val(),
						empresa:$("#uempresa").val(),
						pais:$("#paises2").val(),
						telefono:$("#utelefono").val(),
						correo:$("#ucorreo").val()
					},
				success: function(response)
				{
					if(response == 1){
						$.msgBox({
							title: "Error",
							content: "Error consultando el indicativo del pais que seleccionó",
							type: "error",
							beforeClose: function () {return false; }
						});
						 $("#carga").hide();
					}
					else if(response == 2){
						$.msgBox({
							title: "Error",
							content: "Error insertando los datos",
							type: "error",
							beforeClose: function () {return false; }
						});
						 $("#carga").hide();
					}
					else{
						$.msgBox({
						title: "Éxito",
						content: "Información Guardada con éxito",
						type: "info",
						beforeClose: function () { $("#carga").hide(); window.open("/ptar2022/formulario.php?registro=1","_SELF"); }
					});
					 $("#carga").hide();
					return;						
					}
				}
			});
		})
		
		$("#validar").click(function(){
			//$( "#dialog" ).dialog( "open" );
			//alert($("#uemail").val());
			if($("#uname").val() == ""){
					$.msgBox({
						title: "Error",
						content: "El campo de nombre no puede estar vacio",
						type: "error",
						beforeClose: function () { $("#uname").focus(); }
					});
					return;	
			}
			
			if($("#ucorreo").val() == ""){
					$.msgBox({
						title: "Error",
						content: "El campo de correo no puede estar vacio",
						type: "error",
						beforeClose: function () { $("#ucorreo").focus(); }
					});
					return;	
			}
			
			$("#carga").show();
			//console.log("aqui");
			$.ajax({
				type: "POST",
				url: 'php/validarCorreo.php',
				data:
					{
						correo:$("#ucorreo").val(),
						nombres:$("#uname").val()
					},
				success: function(response)
				{
						$.msgBox({
						title: "Éxito",
						content: "Un código de verificación fue enviado a su correo. Por favor, digítelo en el campo de abajo",
						type: "info",
						beforeClose: function () {$("#token_send").prop("disabled",false); $("#token_send").focus(); $("#cargador").hide();}
					});
					 $("#carga").hide();
				}
				
			});
			
			//$("#showBtn").focus();
			
			//$.msgbox("An error 1053 ocurred while perfoming this service operation on the MySql Server service.", {type: "error"});
			
		})
		
		
		
$("#tokenT").click(function(){
			//$( "#dialog" ).dialog( "open" );
			//alert($("#uemail").val());
			if($("#token_send").val() == ""){
					$.msgBox({
						title: "Error",
						content: "El campo de Código de Verificación no puede estar vacio",
						type: "error",
						beforeClose: function () { $("#token_send").focus(); }
					});
					return;	
			}
			
			if($("#ucorreo").val() == ""){
					$.msgBox({
						title: "Error",
						content: "El campo de correo no puede estar vacio",
						type: "error",
						beforeClose: function () { $("#ucorreo").focus(); }
					});
					return;	
			}
			
			
			
			$.ajax({
				type: "POST",
				url: 'php/validarToken.php',
				beforeSend: function(){
					 $("#cargador").show();
				},
				data:
					{
						correo:$("#ucorreo").val(),
						token:$("#token_send").val()
					},
				success: function(response)
				{
					if(response <=1){
						$.msgBox({
							title: "Error",
							content: "El código de verificación suministrado no concuerda con el enviado a su correo por favor reviselo de nuevo",
							type: "error",
							beforeClose: function () {$("#token_send").prop("disabled",false); $("#token_send").focus(); }
						});
					}
					else{
						$.msgBox({
							title: "Éxito",
							content: "El token concuerda, por favor, continúe con el registro ¡Gracias!",
							type: "info",
							beforeClose: function () {
								$("#token_send").prop("disabled",false); 
								$("#token_send").focus(); 
								//$("#aceptar").prop("disabled",false);
								//$("#aceptar").attr("disabled","disabled");
								$("#validar").attr("disabled","disabled");
								$("#token_send").attr("disabled","disabled");
								$("#ucorreo").attr("disabled","disabled");
								$("#tokenT").attr("disabled","disabled");
								$("#aceptar").prop("disabled",false);
							}
						});
					}
					 $("#cargador").hide();	
				}
			});
			
			//$("#showBtn").focus();
			
			//$.msgbox("An error 1053 ocurred while perfoming this service operation on the MySql Server service.", {type: "error"});
			
		})		
		
		
  })



