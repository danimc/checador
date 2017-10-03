    document.getElementById("justificar").addEventListener("click", function() {    
            if($("#fecha").val() && $("#tipo").val() ){
               $.ajax({
                        url: "consulta/justificar",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: { 
                        'fecha': $('#fecha').val(),
                        'tipo': $('#tipo').val(),
                        'observaciones': $('#observaciones').val()
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        },
                        success: function (data) {
                            if (data.status)
                            {
                                swal({
                                  title: "Listo!...",
                                  text: "Justificación Capturada.",
                                  timer: 2000,
                                  showConfirmButton: false
                                });
/*                                $("#texto").html("");
                                $( "#save" ).addClass( "disabled" );
                                $( "#numero" ).prop('disabled', false);
                                $( "#password" ).prop('disabled', false);*/
                                window.location.reload(false); 
                            }
                            else
                            { 
                                sweetAlert("Oops...", "Ocurrio un error al agregar el empleado!", "error");
                                
                            }
                        }
                    });
            } else{
               sweetAlert("Oops...", "Debes de llenar todos los datos para agregar el empleado", "warning"); 
            }
            
         
    });        
