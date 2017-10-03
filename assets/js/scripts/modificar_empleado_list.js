
var typeaheadSource;

 $(document).ready(function() {
    $('#nombre').focus(); 

    var numero_edit = $("#numero").val();
      cargar_datos(numero_edit);

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
                    $( "#save" ).addClass( "disabled" );
                },
                success: function (data) {
                  if(data.status)
                  {
                        if (data.data[0].STATUS === 'TRUE')
                        {
                            $("#nombre").val(data.data[0].nombre);
                            $("#numero").val(data.data[0].numero);
                            $("#departamento").val(data.data[0].departamento);
                            $("#hentrada").val(data.data[0].hora_entrada);
                            $("#hsalida").val(data.data[0].hora_salida);
                            $( "#cambios" ).removeClass( "disabled" );
                            $( "#baja" ).removeClass( "disabled" );
                            $( "#numero" ).prop('disabled', true);
                            $( "#nombre" ).prop('disabled', true);
                            //$( "#departamento" ).prop('disabled', true);
                            $("#hentrada").val(data.data[0].hora_entrada);
                            $("#hsalida").val(data.data[0].hora_salida);
                        }
                        else
                        { 
                            $("#nombre").val("");
                            $("#numero").val("");
                            $( "#save" ).addClass( "disabled" );
                            $( "#numero" ).prop('disabled', false);
                            $( "#nombre" ).prop('disabled', false);
                            $( "#departamento" ).prop('disabled', false);
                        }
                    }
                    else
                    {
                        $("#numero").val("");
                        $("#nombre").val("");
                        $( "#save" ).addClass( "disabled" );
                        $( "#numero" ).prop('disabled', false);
                        $( "#nombre" ).prop('disabled', false);
                        $( "#departamento" ).prop('disabled', false);
                    }
                }
            });
      }

});


    document.getElementById("cambios").addEventListener("click", function() {    
            if($("#departamento").val() && $("#hentrada").val() && $("#hsalida").val() ){
                    $.ajax({
                        url: "consulta/modifica_empleado",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: {
                        'num_empleado': $('#numero').val(),
                        'departamento': $('#departamento').val(),
                        'hora_entrada': $('#hentrada').val(),
                        'hora_salida': $('#hsalida').val()
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
                                  text: "Empleado Modificado.",
                                  timer: 2000,
                                  showConfirmButton: false
                                });
                                $("#texto").html("");
                                $( "#cambios" ).addClass( "disabled" );
                                $( "#numero" ).prop('disabled', false);
                                window.location.reload(false); 
                            }
                            else
                            { 
                                sweetAlert("Oops...", "Ocurrio un error al registrar!", "error");
                            }
                        }
                    });
            } else{
               sweetAlert("Oops...", "Debes de llenar todos los datos para el reporte", "warning"); 
            }

    });

    document.getElementById("baja").addEventListener("click", function() {    

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
                            'num_empleado': $('#numero').val()
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
                                    sweetAlert("Oops...", "Ocurrio un error al registrar!", "error");
                                }
                            }
                        });
                });
                            

    
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