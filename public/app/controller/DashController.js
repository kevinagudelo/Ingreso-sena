angular
        .module('proyect')
        .controller('DashController', DashController);
DashController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function DashController($scope, databaseService, $state, $sessionStorage, $log) {
  if ($sessionStorage.data !== undefined) {
    $scope.myFunc = function () {
      delete $sessionStorage.data;
      $state.go("index");
    };
    $scope.name = $sessionStorage.data.nombre;
    $scope.Sendcodigo = function () {
      databaseService.codigo($scope.codigo)
              .then(res => {
                $sessionStorage.codigo = res.data.data[0];
                if (res.data.data[0].actived === false) {
                  $state.go("ingreso");
                } else {
                  $state.go("salida");
                }

              })
              .catch(err => {
                toastr.error(err.data.error.codigo.message);

              });
    };

  } else {
    $state.go('index');
  }


}

