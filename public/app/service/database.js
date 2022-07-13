angular
        .module('proyect')
        .service('databaseService', databaseService);
databaseService.$inject = ['$http', '$httpParamSerializerJQLike'];

function databaseService($http, $httParamSerializerJQLike) {

  this.logi = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Login', $httParamSerializerJQLike(data));
  };
  this.registroAprendiz = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Nuevo', $httParamSerializerJQLike(data));
  };
  this.ActualizarAprendiz = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/ActualizarAprendiz', $httParamSerializerJQLike(data));
  };
  this.registroEquipo = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/RegistroEquipo', $httParamSerializerJQLike(data));
  };
  this.registroEquipoTotal = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/RegistroEquipo2', $httParamSerializerJQLike(data));
  };
  this.codigo = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Codigo', $httParamSerializerJQLike(data));
  };
  this.datosEntrada = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Entrada', $httParamSerializerJQLike(data));
  };
  this.PersonaEntrada = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Entrada', $httParamSerializerJQLike(data));
  };
  this.Dispositivo = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/Dispositivo', $httParamSerializerJQLike(data));
  };
  this.ConsultaDato = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/ConsultaDato', $httParamSerializerJQLike(data));
  };
  this.InsertarEntrada = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/InsertarEntrada', $httParamSerializerJQLike(data));
  };
  this.DatosIngreso = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/DatosIngreso', $httParamSerializerJQLike(data));
  };
  this.InsertarSalida = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/InsertarSalida', $httParamSerializerJQLike(data));
  };
  this.ActualizarUsuario = (data) => {
    return $http.post('http://localhost/Ingreso-sena/public/server.php/Usuario/ActualizarUsuario', $httParamSerializerJQLike(data));
  };
}
;

