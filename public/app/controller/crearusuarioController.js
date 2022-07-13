angular.module('proyect').controller('crearusuarioController', crearusuarioController);
crearusuarioController.$inject = ['$scope', 'databaseadminService', '$state', '$sessionStorage'];
function crearusuarioController($scope, databaseService, $state, $sessionStorage) {
  if ($sessionStorage.data === undefined) {
    $state.go('index');
  }
  $scope.myFunc = function () {
    delete $sessionStorage.data;
    $state.go("index");
  };
  $scope.nuevoUsuario = {};
  $scope.errors = {};
  $scope.success = false;
  $scope.minUsuario = false;
  $scope.minNombre = false;
  $scope.minContrasena = false;

  $scope.enviar = () => {
    if ($scope.minUsuario == false && $scope.minNombre == false && $scope.minContrasena == false) {
      databaseService.registrousuario($scope.nuevoUsuario).then((response) => {
        $scope.nuevoUsuario = {};
        $scope.success = true;

        setTimeout(() => {
          $('#msgSuccess').fadeOut('slow', () => {
            $scope.$apply(() => {
              $scope.success = false;
            });
          });
        }, 2000);

      }, (response) => {
        Object.keys(response.data.error).forEach(key => {
          eval('delete $scope.nuevoUsuario.' + key);
          if (key == 'contrasena1') {
            delete $scope.nuevoUsuario.contrasena2;
          }
        });
        $scope.errors = response.data.error;
      });
    } else if ($scope.minUsuario == true || $scope.minuNombre == true || $scope.minContrasena == true) {
    }
  };

  $scope.deleteError = (error) => {
    $scope.usuario = $scope.nuevoUsuario.usuario;
    if ($scope.usuario) {
      if ($scope.usuario.length > 4) {
        $scope.minUsuario = false;
      } else {
        $scope.minUsuario = true;
      }
    } else {
      $scope.minUsuario = false;
    }
    $scope.nombre = $scope.nuevoUsuario.nombre;
    if ($scope.nombre) {
      if ($scope.nombre.length > 4) {
        $scope.minNombre = false;
      } else {
        $scope.minNombre = true;
      }
    } else {
      $scope.minNombre = false;
    }
    $scope.contrasena1 = $scope.nuevoUsuario.contrasena1;
    if ($scope.contrasena1) {
      if ($scope.contrasena1.length > 7) {
        $scope.minContrasena = false;
      } else {
        $scope.minContrasena = true;
      }
    } else {
      $scope.minContrasena = false;
    }
    eval('delete $scope.errors.' + error)
            ;
  };





}