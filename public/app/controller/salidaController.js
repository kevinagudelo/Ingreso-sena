angular
        .module('proyect')
        .controller('salidaController', salidaController);
salidaController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function salidaController($scope, databaseService, $state, $sessionStorage, $log) {
  if ($sessionStorage.codigo !== undefined) {
    if ($sessionStorage.data !== undefined) {
      $scope.myFunc = function () {
        delete $sessionStorage.data;
        $state.go("index");
      };
      $scope.name = $sessionStorage.data.nombre;
      $scope.salida = {};
      $scope.salidaPropietario = {};
      $scope.data = {};
      $scope.personajeingreso = {};
      $scope.personaje = "";
      $scope.data = $sessionStorage.codigo;
      $scope.codigo = $scope.data.codigo;
      $scope.marca = $scope.data.marca;
      $scope.serie = $scope.data.serie;
      $scope.cargador = $scope.data.cargador;
      $scope.salidaPropietario.id_codigo = $sessionStorage.codigo.equi_id;
      $scope.salida.id_codigo = $sessionStorage.codigo.equi_id;
      $scope.salidaPropietario.id_usuario = $sessionStorage.data.id;
      $scope.salida.id_usuario = $sessionStorage.data.id;
      $scope.propietario = $sessionStorage.codigo.nombre;
      $scope.canvas = $sessionStorage.codigo.foto;
      $scope.dispositivo = $sessionStorage.codigo.dispo_nombre;
      $scope.salidaPropietario.aprendiz_id = $sessionStorage.codigo.id;
      databaseService.DatosIngreso($scope.data)
              .then(res => {
                $scope.salida.id_equipo = res.data.data[0].reg_id;
                $scope.salidaPropietario.id_equipo = res.data.data[0].reg_id;
                $scope.hentrada = res.data.data[0].entrada;
                $scope.salida.aprendiz_id = res.data.data[0].id;
                $scope.personaje = (res.data.data[0].nombre);
                $scope.canvas2 = res.data.data[0].foto;
              });
      $scope.SalidaIngreso = function () {
        databaseService.InsertarSalida($scope.salida);
        $state.go('dashboard');
      };
      $scope.SalidaPropietario = function () {
        databaseService.InsertarSalida($scope.salidaPropietario);
        $state.go('dashboard');
      };
    } else {
      $state.go('index');
    }

  } else
  {
    $state.go('dashboard');
  }


}