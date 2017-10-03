    $(document).ready(function() {
        $('#traer_detalle').focus(); 
    });





    angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {
            
            
            $scope.datos = [];

            $scope.traer_detalle = function () {

            if($("#fechainicial").val() && $("#fechafinal").val() ){
                //$scope.datos= [];    

                var req = {
                    method: 'GET',
                    url: 'consulta/traer_detalle?fechainicial='+ $("#fechainicial").val()+'&fechafinal='+ $("#fechafinal").val()
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
               sweetAlert("Oops...", "Debes de llenar todos los datos para el reporte", "warning"); 
            }


              
            };



    document.getElementById("print_detalle").addEventListener("click", function() {

            if($("#fechainicial").val() && $("#fechafinal").val() ){
               window.open("imprimir_detalle?fechainicial="+ $("#fechainicial").val()+"&fechafinal="+ $("#fechafinal").val());  
            } else{
               sweetAlert("Oops...", "Debes de llenar todos los datos para el reporte", "warning"); 
            }

    });

});
        
