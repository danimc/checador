    $(document).ready(function() {
        $('#economico').focus(); 
    });



    angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {

    document.getElementById("economico").addEventListener("click", function() {    
            if($("#nombre").val() && $("#fecha").val() ){
               $.ajax({
                        url: "consulta/economico",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: { 
                        'id_empleado': $scope.id_empleado,                            
                        'fecha': $('#fecha').val()
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

            
            $.ajax({
                url: "consulta/traer_empleados",
                type: "GET",
                dataType: "json",
                cache: true,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                },
                success: function (data) {
                  if(data.status)
                  {
                    typeaheadSource = data.data;
                            $('#nombre').typeahead({
                                minLength: 1,
                                order: "asc",
                                hint: true,
                                source: typeaheadSource,
                                display: 'nombre',
                                callback: {
                                    onClickAfter: function (node, a, item, event) {

                                        cargar_datos(item.numero);  
                                        

                                    }
                                },
                                debug: true
                            });
                    }
                    else
                    {
                       alert("Error. Favor de Refrescar Página"); 
                    }
                }
            });

        function cargar_datos(numero) {
        $.ajax({
                url: "consulta/llenar_estatus",
                type: "GET",
                dataType: "json",
                cache: true,
                data: {
                    'numero': numero
                 },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                    
                },
                success: function (data) {
                  if(data.status)
                  {
                        if (data.data[0].STATUS === 'TRUE')
                        {
                            $scope.id_empleado = data.data[0].id_empleado;
                        }
                        else
                        { 

                        }
                    }
                    else
                    {

                    }
                }
            });
      }


        });
        
