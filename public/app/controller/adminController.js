angular.module('proyect').controller('adminController', adminController);
adminController.$inject = ['$scope', 'databaseadminService', '$state', '$sessionStorage'];
function adminController($scope, databaseService, $state, $sessionStorage) {
    if ($sessionStorage.data === undefined) {
        $state.go('index');
    }
    $scope.myFunc = function () {
        delete $sessionStorage.data;
        $state.go("index");
    };

    $scope.user = $sessionStorage.data.usuario;
    $scope.listado = [];
    $scope.reaload = false;
    $scope.filter = true;

    databaseService.getEntradaSalida().then((response) => {
        $scope.listado = response.data;
        $sessionStorage.listado = $scope.listado;
    }, (response) => {

    });
    $scope.filtrarfecha = function () {
        console.log($scope.data);
        const fechaInput = new Date($scope.data).toDateString();
            $scope.listado = $sessionStorage.listado.filter(equipo => {
                const fechaEquipo = new Date(equipo.entrada).toDateString();
                 if(fechaEquipo === fechaInput){
                     return equipo;
                }
            });
//        $scope.listado = [];
//        const fechaOrigin = new Date($scope.data);
//        $sessionStorage.listado.forEach(e => {
//            console.log($scope.listado);
//            let fecha = new Date(e.entrada);
////            console.log(fechaOrigin.getFullYear());
//            if (fechaOrigin.getFullYear() === fecha.getFullYear() && fechaOrigin.getMonth() === fecha.getMonth() && fechaOrigin.getDay() === fecha.getDay()) {
//                $scope.listado.push(e);
//            }
//        });
        $scope.filter = false;
        $scope.reload = true;


    };

    $scope.reloadRoute = function () {
        $scope.listado = $sessionStorage.listado;
        $scope.filter = true;
        $scope.reload = false;
    };

    $scope.mdlIngreso = function (id) {
        $scope.id = id;
        databaseService.modalentrada({id}).then((response) => {
            $scope.nombre = response.data[0].nombre;
            $scope.foto = response.data[0].foto;
            $scope.ficha = response.data[0].ficha;
            $scope.documento = response.data[0].documento;
            $scope.formacion = response.data[0].formacion;

        }, (response) => {

        });
    };
    $scope.mdlSalida = function (id) {
        $scope.id = id;
        databaseService.modalsalida({id}).then((response) => {
            console.log(response);
            $scope.nombreS = response.data[0].nombre;
            $scope.fotoS = response.data[0].foto;
            $scope.fichaS = response.data[0].ficha;
            $scope.documentoS = response.data[0].documento;
            $scope.formacionS = response.data[0].formacion;

        }, (response) => {

        });
    };
}

