    document.getElementById("print_report").addEventListener("click", function() { 
            if($("#fechadatos").val()){
                window.open("imprimir_bitacora?fechaimpresion=" + $("#fechadatos").val());      
            } else{
               sweetAlert("Oops...", "Debes de ingresar fecha para el reporte", "warning"); 
            }
           
  
    });


    angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {
            
            
            $scope.datos= {};
            $scope.id_entrada= '';
            $scope.hora = '';

            $scope.traer = function () {

            if($("#fechadatos").val()){
                $scope.datos= {};
                var req = {
                    method: 'GET',
                    url: 'consulta/traer_log?fechadatos='+ $("#fechadatos").val()
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
            } else{
               sweetAlert("Oops...", "Debes de ingresar fecha para el reporte", "warning"); 
            }
           


              
            };

            $scope.editar = function (entrada,id_entrada) {

                $scope.id_entrada= id_entrada;
            	$scope.hora = entrada;
              
            };


             $scope.modificar = function () {

                var req = {
                    method: 'GET',
                    url: 'consulta/trae_checadas?fechaimpresion='+ $("#fechaimpresion").val()
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
              
            };

                        
             $scope.cambiar = function () {

                        $.ajax({
                        url: "consulta/modificar_checadas",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: {
                          'id_checada': $scope.id_entrada,
                          'horanueva': $scope.hora
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        },
                        success: function (data) {


                            if (data.status)
                            {
                                sweetAlert("Correcto", "Cambiado con exito!", "success");
                                $scope.traer();
                                $("#myModal").modal("hide");
                            }
                            else
                            { 
                                sweetAlert("Oops...", "Ocurrio un error al registrar!", "error");
                            }
                        }
                        });
                    
              
            };
            
        });
        