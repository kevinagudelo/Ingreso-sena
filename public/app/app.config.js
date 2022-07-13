angular.module('proyect').config(['$stateProvider', '$urlRouterProvider', '$httpProvider', function ($stateProvider, $urlRouterProvider, $httpProvider) {
    $urlRouterProvider.otherwise('/');
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $stateProvider.state('index', {
      url: '/',
      controller: 'indexController',
      templateUrl: 'app/template/inicio-session.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/indexController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('registro_equipo', {
      url: '/registro_equipo',
      controller: 'registro_equipoController',
      templateUrl: 'app/template/registro_equipo.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/headerController.js',
                  'app/controller/registro_equipoController.js'

                ]
              }]);
          }]
      }
    });
    $stateProvider.state('registro_aprendiz', {
      url: '/registro_aprendiz',
      controller: 'registro_usuController',
      templateUrl: 'app/template/registro_aprendiz.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/registro_usuController.js',
                  'app/controller/headerController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('dashboard', {
      url: '/dashboard',
      controller: 'DashController',
      templateUrl: 'app/template/dashboard.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/DashController.js',
                  'app/controller/headerController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('ingreso', {
      url: '/ingreso',
      controller: 'ingresoController',
      templateUrl: 'app/template/ingreso.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/ingresoController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('salida', {
      url: '/salida',
      controller: 'salidaController',
      templateUrl: 'app/template/salida.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/salidaController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('gestion', {
      url: '/gestion',
      controller: 'GestionController',
      templateUrl: 'app/template/gestion.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/GestionController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('actualizar', {
      url: '/actualizar_usuController',
      controller: 'actualizar_usuController',
      templateUrl: 'app/template/actualizar_aprendiz.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'app/controller/actualizar_usuController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('Admin', {
      url: '/admin',
      controller: 'adminController',
      templateUrl: 'app/template/Admin.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'css/css_admin.css',
                  'js/adminjs.js',
                  'app/controller/adminController.js'
                ]
              }]);
          }]
      }
    });
    $stateProvider.state('CrearUsuario', {
      url: '/crearusuario',
      controller: 'crearusuarioController',
      templateUrl: 'app/template/crear_usuario.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
            return $ocLazyLoad.load([{
                serie: true,
                files: [
                  'css/css_admin.css',
                  'js/adminjs.js',
                  'app/controller/crearusuarioController.js'

                ]
              }]);
          }]
      }
    });
  }]);