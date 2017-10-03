
    document.getElementById("agregaremp").addEventListener("click", function() {    
            if($("#nombre").val() && $("#departamento").val() && $("#hentrada").val() && $("#hsalida").val()){
               $.ajax({
                        url: "agregarempleado/guardar_empleado",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: { 
                        'num_empleado': $('#numero').val(),
                        'nom_empleado': $('#nombre').val(),
                        'nom_depto': $('#departamento').val(),
                        'hora_ent': $('#hentrada').val(),
                        'hora_sal': $('#hsalida').val()
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
                                  text: "Ingreso Capturado.",
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

    angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {
        $scope.datos= {};

        var req = {
                    method: 'GET',
                    url: 'consulta/traer_departamentos'
                };
                $http(req)
                        .success(function (data) {
                            if (data.status)
                            {
                                $scope.datos = data.data;                
                            }
                            else {
                                sweetAlert("Oops...", "No hay datos que mostrar", "warning");
                            }
                        })
                        .error(function (error) {
                           alert('Error. Intente de nuevo mas tarde');
                        });                

    });