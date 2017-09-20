angular.module('Equipo_m',  ['ui.bootstrap'])
        .controller("equipo", function ($scope, $http) {


$scope.formulario = {
    'sucursal_o': "",
    'sucursal_a': "",
    'estado': "",
    'codigo': "",
    'observacion': "",
    'tipo': ""
}


$scope.sucursal = [];
$scope.estatus = [];
$scope.tipo = [];


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

$scope.llenar_tipo = function () {
    $http({
        url: 'consulta/llenar_tipo',
        method: "GET"
    }).success(function (data, status, headers, config) {
        if (data.status)
        {
            $scope.tipo = data.data;
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


$scope.guardar = function (){
    $.ajax({
         url: "consulta/guardar_equipo",
         type: "POST",
         dataType: "json",
         data: {codigo: $scope.formulario.codigo,
            estatus: $scope.formulario.estado,
            observacion: $scope.formulario.observacion,
            tipo: $scope.formulario.tipo,
            sucursal_o: $scope.formulario.sucursal_o,
            sucursal_a: $scope.formulario.sucursal_a},
         success: function (data) { 
            if (data.status)
            {
                location.reload();
            }
            else
            {
                alert(data.data[0].error);
            }
        }
    });
}

$scope.llenar_estatus();
$scope.llenar_tipo();
$scope.llenar_sucursal();
})