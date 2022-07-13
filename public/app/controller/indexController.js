

angular
        .module('proyect')
        .controller('indexController', indexController);
indexController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function indexController($scope, databaseService, $state, $sessionStorage, $log) {

//

//  var pass = '123456';
  $scope.input = '';
//  $scope.login = function () {
//    if ($scope.datos.user === user && $scope.datos.password === pass) {
//      console.log('pasa');
//      $state.go("dashboard");
//    } else {

//    }
//  };



  if ($sessionStorage.data === undefined) {

    $scope.datos = {};

    $scope.login = () => {
      databaseService.logi($scope.datos)
              .then(res => {
                $log.info(res);
                if (res.data.bol) {
                  $sessionStorage.data = res.data.data[0];
                  if ($sessionStorage.data.rol === "1") {
                    $state.go("dashboard");
                  } else if ($sessionStorage.data.rol === "2") {
                    $state.go("Admin");
                  }
                }
              })
              .catch(err => {
                $scope.input = 'Usuario y/o contraseña incorrectos';
                toastr.info($scope.input);
                $log.error(err);
                delete $scope.datos;
              });
    };
  }
}
