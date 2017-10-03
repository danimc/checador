  angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {
            
            
            $scope.datos= [];
            $scope.buscar= '';

            var req = {
                    method: 'GET',
                    url: 'consulta/traer_listado_empleados'
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


            $scope.borrar = function (numero) {

            swal({
              title: "Confirmación!",
              text: "Esta seguro de borrar registro?",
              showCancelButton: false,
              confirmButtonColor: "#5B6871",
              confirmButtonText: "Borrar",
              closeOnConfirm: false
            },
            function(){
            $.ajax({
                            url: "consulta/baja_empleado",
                            type: "POST",
                            dataType: "json",
                            cache: true,
                            data: {
                            'num_empleado': numero
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
                                      text: "Dado de Baja.",
                                      timer: 2000,
                                      showConfirmButton: false
                                    });
                                    $("#texto").html("");
                                    $( "#baja" ).addClass( "disabled" );
                                    $( "#numero" ).prop('disabled', false);
                                    window.location.reload(false); 
                                }
                                else
                                { 
                                    sweetAlert("Oops...", "Ocurrio un error al borrar!", "error");
                                }
                            }
                        });
                });
            };

            $scope.bloqueo = function (numero, activo) {

                swal({
                  title: "Bloqueo o Activación?",
                  text: "El empleado será bloqueado o activado",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Aceptar",
                  cancelButtonText: "Cancelar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm) {
                  if (isConfirm) { 
                        $.ajax({
                                        url: "consulta/bloqueo_empleado",
                                        type: "POST",
                                        dataType: "json",
                                        cache: true,
                                        data: {
                                        'num_empleado': numero,
                                        'activo': activo
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
                                                  text: "Blouqeo aplicado.",
                                                  timer: 2000,
                                                  showConfirmButton: false
                                                });
                                                $("#texto").html("");
                                                $( "#baja" ).addClass( "disabled" );
                                                $( "#numero" ).prop('disabled', false);
                                                window.location.reload(false); 
                                            }
                                            else
                                            { 
                                                sweetAlert("Oops...", "Ocurrio un error al bloquear!", "error");
                                            }
                                        }
                                    })
                    swal("Aceptar", "El empleado ha sido Bloqueado/Activado.", "success");
                  } else {
                    swal("Cancelar", "No se guardaron los cambios", "error");
                    window.location.replace("empleados");
                  }
                });        
            };


            $scope.modificar = function (numero) {
                window.location.replace("modificar_empleado_list?numero="+numero);
            };
             
            
        });
        