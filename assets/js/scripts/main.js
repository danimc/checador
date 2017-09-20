 window.addEventListener("DOMContentLoaded", function() {
        var canvas = document.getElementById("canvas"),
        context = canvas.getContext("2d"),
        video = document.getElementById("video"),
        videoObj = { "video": true },
        errBack = function(error) {
                console.log("Video capture error: ", error.code);
        };
        if(navigator.getUserMedia) {
            navigator.getUserMedia(videoObj, function(stream) {
                video.src = stream;
                video.play();
            }, errBack);
        } else if(navigator.webkitGetUserMedia) {
            navigator.webkitGetUserMedia(videoObj, function(stream){
                video.src = window.webkitURL.createObjectURL(stream);
                video.play();
            }, errBack);
        }
        else if(navigator.mozGetUserMedia) {
            navigator.mozGetUserMedia(videoObj, function(stream){
                video.src = window.URL.createObjectURL(stream);
                video.play();
            }, errBack);
        }
    }, false);

 var foto;
 var tomar = 0;

    document.getElementById("save").addEventListener("click", function() {

    if(tomar === 0){

        tomar = 1;

        canvas.getContext("2d").drawImage(video, 0, 0, 320, 240);
        $.post('fotossalvar.php', {imagem:canvas.toDataURL()}, function(data){
        }).done(function(data) {
            $.ajax({
                        url: "consulta/guardar_entrada",
                        type: "POST",
                        dataType: "json",
                        cache: true,
                        data: {'foto': data,
                        'num_empleado': $('#numero').val(),
                        'idempleado': $('#id').val(),
                        'password': $('#password').val()
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                            tomar = 0;
                        },
                        success: function (data) {
                            tomar = 0;
                            resultado = data;
                            if (data.status && data.data[0].folio)
                            {
                                var mensaje = "";
                                if(data.data[0].Entrada){
                                    mensaje = data.data[0].Entrada;
                                }
                                else
                                {
                                    mensaje = data.data[0].Salida;
                                }
                                //alert(mensaje);

                                swal({
                                  title: mensaje + " (" + data.data[0].tiempo + ")",
                                  text:  mensaje + " Capturada Correctamente. Folio: " + data.data[0].folio,
                                  timer: 2000,
                                  imageUrl: "assets/img/thumbs-up.jpg",
                                  showConfirmButton: false
                                });
                                get_ultimas_checadas();
                                $("#texto").html("");
                                $( "#save" ).addClass( "disabled" );
                                $( "#numero" ).prop('disabled', false);
                                $( "#numero" ).focus();
                                $( "#password" ).prop('disabled', false);
                                setTimeout(function(){ limpar(); tomar = 0; }, 1500);
                            }
                            else
                            {
                                tomar = 0;
                                sweetAlert("Oops...", data.data[0].error , "error");
                            }
                        }
                    });
          });
    }
    });

    document.getElementById("cancelar").addEventListener("click", function() {
        limpar();
    });

var typeaheadSource;
var resultado;
get_ultimas_checadas();

 $(document).ready(function() {
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
    $('#numero').focus();
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


        function hora_actual(){
            $.ajax({
                url: "consulta/hora_actual",
                type: "GET",
                dataType: "json",
                cache: true,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //alert("Status: " + textStatus);
                    //alert("Error: " + errorThrown);
                    location.reload();
                },
                success: function (data) {
                    if(data.status)
                    {
                        $("#hora_actual_label").html(data.hora[0].hora_actual);
                        setTimeout(function() {
                            hora_actual();
                        }, 15000);
                    }
                    else
                    {
                       alert("Error. Favor de Refrescar Página");
                    }
                }
            });
        }

        hora_actual();

      function cargar_datos(numero) {
        tomar = 0;
        if(numero){
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
                            $("#id").val(data.data[0].id_empleado);
                            $("#departamento").val(data.data[0].departamento);
                            $( "#save" ).removeClass( "disabled" );
                            $( "#numero" ).prop('disabled', true);
                            $( "#nombre" ).prop('disabled', true);
                            $( "#departamento" ).prop('disabled', true);
                            $('#password').focus();
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
      }



      function guardar_checadas() {

        if(tomar === 0){

        console.log(tomar);

        if($('#numero').val() && $('#password').val()){
            tomar = 1;
                canvas.getContext("2d").drawImage(video, 0, 0, 320, 240);
                $.post('fotossalvar.php', {imagem:canvas.toDataURL()}, function(data){
                }).done(function(data) {
                    $.ajax({
                                url: "consulta/guardar_entrada",
                                type: "POST",
                                dataType: "json",
                                cache: true,
                                data: {'foto': data,
                                'num_empleado': $('#numero').val(),
                                'idempleado': $('#id').val(),
                                'password': $('#password').val()
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    tomar = 0;
                                    alert("Status: " + textStatus);
                                    alert("Error: " + errorThrown);
                                },
                                success: function (data) {
                                    tomar = 0;
                                    resultado = data;
                                    if (data.status && data.data[0].folio)
                                    {
                                        var mensaje = "";
                                        if(data.data[0].Entrada){
                                            mensaje = data.data[0].Entrada;
                                        }
                                        else
                                        {
                                            mensaje = data.data[0].Salida;
                                        }
                                        //alert(mensaje);

                                        swal({
                                          title: mensaje + " (" + data.data[0].tiempo + ")",
                                          text:  mensaje + " Capturada Correctamente. Folio: " + data.data[0].folio,
                                          timer: 2000,
                                          imageUrl: "assets/img/thumbs-up.jpg",
                                          showConfirmButton: false
                                        });
                                        get_ultimas_checadas();
                                        $("#texto").html("");
                                        $( "#save" ).addClass( "disabled" );
                                        $( "#numero" ).prop('disabled', false);
                                        $( "#numero" ).focus();
                                        $( "#password" ).prop('disabled', false);
                                        setTimeout(function(){ limpar(); tomar = 0; }, 1500);
                                    }
                                    else
                                    {
                                        sweetAlert("Oops...", data.data[0].error , "error");
                                        tomar = 0;
                                    }
                                }
                            });
                  });
            }
        }

      }

    document.getElementById("numero").addEventListener("keyup", function(e) {
        if(e.keyCode == 13){
             cargar_datos($('#numero').val());
        }
    });


    document.getElementById("password").addEventListener("keyup", function(e) {
        if(e.keyCode == 13){
             guardar_checadas();
        }
    });


});

 var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};



function limpar() {

        $("#nombre").val('');
        $("#numero").val('');
        $("#id").val('');
        $("#departamento").val('');
        $( "#save" ).addClass( "disabled" );
        $( "#numero" ).prop('disabled', false);
        $( "#nombre" ).prop('disabled', false);
        $('#password').val('');
        tomar = 0;
        setTimeout(function(){ $('#numero').focus(); }, 1000);

      }


        function get_ultimas_checadas(){
            $("#listado").empty();
            $.ajax({
                url: "consulta/get_ultimas_checadas",
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
                        $.each(data.data, function(i, item) {

                                $('#listado').append('<div><div class="col-md-2">' +item.id_entrada+ '</div><div class="col-md-7">' +item.nombre+ '</div><div class="col-md-3">' +item.fecha_modificacion+ '</div></div>');

                         });

                    }
                    else
                    {
                       alert("Error. Favor de Refrescar Página");
                    }
                }
            });
        }
