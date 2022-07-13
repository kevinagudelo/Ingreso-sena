angular
        .module('proyect')
        .service('databaseadminService', databaseadminService);
databaseadminService.$inject = ['$http', '$httpParamSerializerJQLike'];

function databaseadminService($http, $httParamSerializerJQLike) {

  this.getEntradaSalida = () => {
    return $http.get('http://localhost/Ingreso-sena/public/server.php/EntradaSalida/entradasalida1');
  };

  this.registrousuario = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/EntradaSalida/crearusuario', $httParamSerializerJQLike(data));
  };

  this.modalentrada = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/EntradaSalida/modalentrada', $httParamSerializerJQLike(data));
  };
  this.modalsalida = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/EntradaSalida/modalsalida', $httParamSerializerJQLike(data));
  };
}
;