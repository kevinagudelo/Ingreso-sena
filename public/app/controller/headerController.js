
angular
        .module('proyect')
        .controller('headerController', headerController);
headerController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage', '$log'];
function headerController($scope, databaseService, $state, $sessionStorage, $log) {
  $log.info('hola');
  $scope.user = $sessionStorage.data.usuario;
  $scope.myFunc = function () {
    $log.info('hi friend');
    delete $sessionStorage.data;
    $state.go("index");
  };
}

