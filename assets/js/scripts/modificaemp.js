
var typeaheadSource;

 $(document).ready(function() {
    $('#numero').focus(); 
    $("#numero").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
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

     document.getElementById("numero").addEventListener("keyup", function(e) {   
            if(e.keyCode == 13){
                 cargar_datos($('#numero').val());    
            }    
        });   

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