$("#document").ready(function () {
 
});

intento = 1;

function log()
{
    usuario = $("#login_username").val();
    pass = $("#login_pass").val();

    if(usuario.length > 0 && pass.length > 0)
    {
	    $.ajax({
	        url: "autenticacion/login",
	        type: "POST",
	        dataType: "json",
	        cache: true,
	        data: {'usuario': usuario, 'pass': pass},
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	            alert("Status: " + textStatus);
	            alert("Error: " + errorThrown);
	        },
	        success: function (data) {
	            if (data.status)
	            {
    				window.location.href = "principal";
	            }
	            else
	            { 
    				$(".alert").show();
	            	$("#texto").html("Usuario o contraseña incorrecto");
	            }
	        }
	    });
    }
    else
    {
    	$(".alert").show();
    	$("#texto").html("Ingrese un usuario y una contraseña");
    }
}