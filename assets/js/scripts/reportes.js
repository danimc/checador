    $(document).ready(function() {
        $('#traer_checadas').focus(); 
    });


    document.getElementById("print_report").addEventListener("click", function() { 

            if($("#fechaimpresion").val()){
                window.open("imprimir?fechaimpresion=" + $("#fechaimpresion").val()); 
            } else{
               sweetAlert("Oops...", "Debes de ingresar fecha para el reporte", "warning"); 
            }
    });



    angular.module('MyApp',[])
        .controller("AppCtrl", function ($scope, $http) {
            
            
            $scope.datos = [];
            $scope.totales_entradas = [];
            $scope.totales_salidas = [];
            $scope.id_entrada= '';
            $scope.hora = '';
            $scope.observaciones = '';
            $scope.id_entradaB = '';
            
            $scope.imagen = '';

            $scope.historial= [];
            $scope.id_empleado = '';

            $scope.buscar= '';

            $scope.traer = function () {

            if($("#fechaimpresion").val()){
                $scope.datos= [];
                $scope.historial= [];
      

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


                var req = {
                    method: 'GET',
                    url: 'consulta/totales_entradas?fechaimpresion='+ $("#fechaimpresion").val()
                };
                $http(req)
                        .success(function (data) {
                            if (data.status)
                            {
                                $scope.totales_entradas = [];
                                $scope.totales_entradas.push(['Estatus', 'Total']); 

                                $.each(data.data, function( key, value ) {
                                  $scope.totales_entradas.push([value.estatus, value.totales*1]);
                                });


                                  google.charts.load("current", {packages:["corechart"]});
                                  google.charts.setOnLoadCallback(drawChart);
                                  function drawChart() {

                                    var data = google.visualization.arrayToDataTable($scope.totales_entradas);


                                    var options = {
                                      title: 'Entradas',
                                      is3D: true,
                                    };

                                    var chart = new google.visualization.PieChart(document.getElementById('grafica_entradas'));
                                    chart.draw(data, options);
             
                                  }            
                            }
                            else {
                                //sweetAlert("Oops...", "No hay datos que mostrar", "warning");
                            }
                        })
                        .error(function (error) {
                           //alert('Error. Intente de nuevo mas tarde');
                        });              
             

                var req = {
                    method: 'GET',
                    url: 'consulta/totales_salidas?fechaimpresion='+ $("#fechaimpresion").val()
                };
                $http(req)
                        .success(function (data) {
                            if (data.status)
                            {
                                $scope.totales_salidas = [];
                                $scope.totales_salidas.push(['Estatus', 'Total']); 

                                $.each(data.data, function( key, value ) {
                                  $scope.totales_salidas.push([value.estatus, value.totales*1]);
                                });


                                  google.charts.load("current", {packages:["corechart"]});
                                  google.charts.setOnLoadCallback(drawChart);
                                  function drawChart() {

                                    var data = google.visualization.arrayToDataTable($scope.totales_salidas);


                                    var options = {
                                      title: 'Salidas',
                                      is3D: true,
                                    };

                                    var chart_salidas = new google.visualization.PieChart(document.getElementById('grafica_salidas'));
                                    chart_salidas.draw(data, options);
                                  }            
                            }
                            else {
                                //sweetAlert("Oops...", "No hay datos que mostrar", "warning");
                            }
                        })
                        .error(function (error) {
                           //alert('Error. Intente de nuevo mas tarde');
                        });              
            } else{
               sweetAlert("Oops...", "Debes de ingresar fecha para el reporte", "warning"); 
            }

            };



              


            $scope.traer_historial = function () {

            if($("#fechainicial").val() && $scope.id_empleado && $("#fechafinal").val() ){
                $scope.datos= [];
                $scope.historial= [];
      

                var req = {
                    method: 'GET',
                    url: 'consulta/traer_historial?id_empleado='+$scope.id_empleado+'&fechainicial='+ $("#fechainicial").val()+'&fechafinal='+ $("#fechafinal").val()
                };
                $http(req)
                        .success(function (data) {
                            if (data.status)
                            {
                                $scope.historial = data.data;                
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
            $scope.editar = function (entrada,id_entrada) {
                $scope.observaciones = "";
                $scope.id_entrada= id_entrada;
            	$scope.hora = entrada;
              
            };


            $scope.borrar = function (id_entradaB) {
                $scope.observacionesB = "";
                $scope.id_entradaB= id_entradaB;            
            };

            $scope.imagen_function = function (imagen) {

                $scope.imagen = imagen;

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
                          'horanueva': $scope.hora,
                          'observaciones': $scope.observaciones
                          
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



            $scope.delete = function () {

                        $.ajax({
                        url: "consulta/borrar_checadas",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: {
                          'id_checada': $scope.id_entradaB,
                          'observaciones': $scope.observacionesB
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        },
                        success: function (data) {


                            if (data.status)
                            {
                                sweetAlert("Correcto", "Borrado con exito!", "success");
                                $scope.traer();
                                $("#BorrarModal").modal("hide");
                            }
                            else
                            { 
                                sweetAlert("Oops...", "Ocurrio un error al registrar!", "error");
                            }
                        }
                        });              
            };

            
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

    document.getElementById("print_historial").addEventListener("click", function() {

            if($("#fechainicial").val() && $scope.id_empleado && $("#fechafinal").val() ){
               window.open("imprimir_historial?id_empleado="+$scope.id_empleado+"&fechainicial="+ $("#fechainicial").val()+"&fechafinal="+ $("#fechafinal").val());  
            } else{
               sweetAlert("Oops...", "Debes de llenar todos los datos para el reporte", "warning"); 
            }

    });

        });
        
