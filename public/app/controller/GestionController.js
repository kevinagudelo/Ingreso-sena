angular
        .module('proyect')
        .controller('GestionController', GestionController);
GestionController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function GestionController($scope, databaseService, $state, $sessionStorage, $log) {
  if ($sessionStorage.data !== undefined) {
    $scope.myFunc = function () {
      delete $sessionStorage.data;
      $state.go("index");
    };
    $scope.usuario = {};
    $scope.usuario.id = $sessionStorage.data.id;
    $scope.name = $sessionStorage.data.nombre;
    $scope.ActualizarUsuario = function () {
      databaseService.ActualizarUsuario($scope.usuario)
              .then(res => {
                toastr.success("Se ha realizado el cambio");
                $state.go("dashboard");

              })
              .catch(err => {
                toastr.error(err.data.error.contra.message);

              });
    };

  } else {
    $state.go('index');
  }


}