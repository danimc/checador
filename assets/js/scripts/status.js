angular.module('Estatus',  ['ui.bootstrap'])
        .controller("status", function ($scope, $http) {


$scope.informacion = [];
$scope.sucursal = [];
$scope.estatus = [];

$scope.formulario = {
    'sucursal': "",
    'estado': "",
    'codigo': "",
    'observacion': ""
}

$scope.bandera_disabled = true;

$( "#captura_codigo" ).keypress(function(e) {
    if ( e.which == 13 ) {
        $scope.buscar_codigo();
    }
});




$scope.llenar_estatus = function () {
    $http({
        url: 'consulta/llenar_estatus',
        method: "GET"
    }).success(function (data, status, headers, config) {
        if (data.status)
        {
            $scope.estatus = data.data;
        }
        else
        {

        }
    }).error(function (error, status, headers, config) {
        console.log(error);
    });
};

$scope.llenar_sucursal = function () {
    $http({
        url: 'consulta/llenar_sucursal',
        method: "GET"
    }).success(function (data, status, headers, config) {
        if (data.status)
        {
            $scope.sucursal = data.data;
        }
        else
        {

        }
    }).error(function (error, status, headers, config) {
        console.log(error);
    });
};

$scope.buscar_codigo = function () {
    $http({
        url: 'consulta/buscar_codigo',
        method: "GET",
        params: {codigo: $scope.formulario.codigo},
    }).success(function (data, status, headers, config) {
        if (data.status)
        {
            $scope.informacion = data.data;
            $scope.bandera_disabled = false;
            $scope.formulario.estado = data.data[0].id_estado;
            $scope.formulario.sucursal = data.data[0].id_sucursal_actual;
            $scope.formulario.observacion = data.data[0].observaciones;
        }
        else
        {
            $scope.bandera_disabled = true;
            $scope.formulario = {};
        }
    }).error(function (error, status, headers, config) {
        console.log(error);
    });
};



$scope.modificar = function (){
    $.ajax({
         url: "consulta/modificar_estatus_equipo",
         type: "POST",
         dataType: "json",
         data: {codigo: $scope.formulario.codigo,
            estatus: $scope.formulario.estado,
            sucursal_a: $scope.formulario.sucursal,
            observacion: $scope.formulario.observacion},
         success: function (data) { 
            if (data.status)
            {
                //location.reload();
            }
            else
            {
                alert(data.data[0].error);
            }
        }
    });
}


$scope.llenar_estatus();
$scope.llenar_sucursal();

})