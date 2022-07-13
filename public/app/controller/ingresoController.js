angular
        .module('proyect')
        .controller('ingresoController', ingresoController);
ingresoController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function ingresoController($scope, databaseService, $state, $sessionStorage, $log) {
  if ($sessionStorage.codigo !== undefined) {
    if ($sessionStorage.data !== undefined) {
      $scope.myFunc = function () {
        delete $sessionStorage.data;
        $state.go("index");
      };
      $scope.entrada = {};
      $scope.data = {};
      $scope.name = $sessionStorage.data.nombre;
      $scope.data = $sessionStorage.codigo;
      $scope.codigo = $scope.data.codigo;
      $scope.marca = $scope.data.marca;
      $scope.serie = $scope.data.serie;
      $scope.cargador = $scope.data.cargador;
      $scope.entrada.id_equipo = $scope.data.equi_id;
      $scope.entrada.id_usuario = $sessionStorage.data.id;
      $scope.dispositivo = $scope.data.dispo_nombre;
      $scope.canvas = $scope.data.foto;
      $scope.propietario = $scope.data.nombre;

//      delete $sessionStorage.codigo;

      $scope.consultaUsuario = function () {
        databaseService.ConsultaDato($scope.ingreso)
                .then(res => {
                  $scope.entrada.id_aprendiz = res.data.data[0].id;
                  databaseService.InsertarEntrada($scope.entrada);
                  $state.go('dashboard');
                }).catch(err => {
          $scope.input = (err.data.error.documento.message);
          toastr.error($scope.input);
        });
        ;
      };

    } else {
      $state.go('index');
    }

  } else
  {
    $state.go('dashboard');
  }


}
