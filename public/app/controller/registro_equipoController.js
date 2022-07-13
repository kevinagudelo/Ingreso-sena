angular
        .module('proyect')
        .controller('registro_equipoController', registro_equipoController);
registro_equipoController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function registro_equipoController($scope, databaseService, $state, $sessionStorage, $log) {
  if ($sessionStorage.data !== undefined) {
    $scope.name = $sessionStorage.data.nombre;
    $scope.canvas = "";
    $scope.Inputpropietario = "";
    $scope.carnetUsuario = "";
    $scope.input = "";
    $scope.idUser = "";

    $scope.cargar_datos = () => {
      databaseService.registroEquipo($scope.datos)
              .then(res => {
                $scope.Inputpropietario = res.data.data["0"].nombre;
                $scope.canvas = (res.data.data["0"].foto);
                $scope.idUser = (res.data.data["0"].id);
                if (res.data.data["0"].carnet !== null)
                {
                  $scope.carnetUsuario = (res.data.data["0"].carnet);
                }
              })
              .catch(err => {
                $log.info(err.data);
                $scope.input = (err.data.error.documento.message);
                toastr.error($scope.input);
              });

    };

    $scope.registro_equipo = () => {
      $scope.equipo.id = $scope.idUser;
      databaseService.registroEquipoTotal($scope.equipo)
              .then(res => {
                $state.go("dashboard");
                toastr.success("Equipo Registrado");
              })
              .catch(err => {
                $log.info(err.data.error);
                if (err.data.error.id !== undefined) {
                  $scope.input = (err.data.error.id.message);
                } else if (err.data.error.codigo !== undefined) {
                  $scope.input = (err.data.error.codigo.message);
                } else if (err.data.error.dispositivo.message !== undefined)
                {
                  $scope.input = (err.data.error.dispositivo.message);
                } else if (err.data.error.marca.message !== undefined)
                {
                  $scope.input = (err.data.error.marca.message);
                } else if (err.data.error.serie.message !== undefined)
                {
                  $scope.input = (err.data.error.serie.message);
                } else if (err.data.error.cargador.message !== undefined)
                {
                  $scope.input = (err.data.error.cargador.message);
                }
                $('#Modal').modal('show');
                toastr.error($scope.input);
              });
    };
    $scope.myFunc = function () {
      delete $sessionStorage.data;
      $state.go("index");
    };
  } else {
    $state.go('index');
  }



}


