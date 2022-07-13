angular
        .module('proyect')
        .controller('actualizar_usuController', actualizar_usuController);
actualizar_usuController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage'];
function actualizar_usuController($scope, databaseService, $state, $sessionStorage) {
  if ($sessionStorage.data !== undefined) {
    $scope.capturaFoto = false;
    $scope.cargarFoto = true;
    $scope.myFunc = function () {
      delete $sessionStorage.data;
      $state.go("index");
    };
    $scope.name = $sessionStorage.data.nombre;
    (function () {

      $scope.error = {};

      var streaming = false,
              video = document.querySelector('#video'),
              canvas = document.querySelector('#canvas'),
              photo = document.querySelector('#photo'),
              startbutton = document.querySelector('#startbutton'),
              width = 320,
              height = 0;

      navigator.getMedia = (navigator.getUserMedia ||
              navigator.webkitGetUserMedia ||
              navigator.mozGetUserMedia ||
              navigator.msGetUserMedia);

      navigator.getMedia(
              {
                video: true,
                audio: false
              },
              function (stream) {
                if (navigator.mozGetUserMedia) {
                  video.mozSrcObject = stream;
                } else {
                  var vendorURL = window.URL || window.webkitURL;
                  video.src = vendorURL.createObjectURL(stream);
                }
                video.play();
              },
              function (err) {
                console.log("An error occured! " + err);
              }
      );

      video.addEventListener('canplay', function (ev) {
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth / width);
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          streaming = true;
        }
      }, false);

      function takepicture() {

        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        $scope.aprendiz.foto = data;

      }

      startbutton.addEventListener('click', function (ev) {
        takepicture();
        $scope.capturaFoto = false;
        $scope.cargarFoto = true;
        ev.preventDefault();
      }, false);

    })();
    $scope.input = "";
    $scope.aprendiz = {};
    $scope.CargarImg = () => {
      $scope.capturaFoto = false;
      $scope.cargarFoto = true;
    };
    $scope.RegistroAprendiz = () => {
      databaseService.registroAprendiz($scope.aprendiz)
              .then(res => {
                $state.go("dashboard");
              })
              .catch(err => {
                if (err.data.error.documento !== undefined)
                {
                  $scope.input = err.data.error.documento.message;
                } else if (err.data.error.foto !== undefined) {
                  $scope.input = err.data.error.foto.message;
                }

                $('#Modal').modal('show');
              });

    };
//    $scope.aprendiz.foto = "";
//    $scope.aprendiz.name = "";
//    $scope.aprendiz.carnet = "";
//    $scope.input = "";
//    $scope.idUser = "";
//    $scope.aprendiz.ficha = "";
//    $scope.aprendiz.formacion = "";
    $scope.cargar_datos = () => {
      $scope.capturaFoto = true;
      $scope.cargarFoto = false;
      databaseService.registroEquipo($scope.datos)
              .then(res => {

                $scope.aprendiz.name = res.data.data["0"].nombre;
                $scope.aprendiz.foto = (res.data.data["0"].foto);
                $scope.aprendiz.id = (res.data.data["0"].id);
                $scope.aprendiz.documento = (res.data.data["0"].documento);
                if (res.data.data["0"].carnet !== null)
                {
                  $scope.aprendiz.carnet = (res.data.data["0"].carnet);
                }
                if (res.data.data["0"].ficha !== null)
                {
                  $scope.aprendiz.ficha = (res.data.data["0"].ficha);
                }
                if (res.data.data["0"].formacion !== null)
                {
                  $scope.aprendiz.formacion = (res.data.data["0"].formacion);
                }
              })
              .catch(err => {
                $scope.input = (err.data.error.documento.message);
                toastr.error($scope.input);
              });

    };
    $scope.ActualizarAprendiz = () => {
      databaseService.ActualizarAprendiz($scope.aprendiz)
              .then(res => {
                $state.go("dashboard");
                toastr.success("Se realizo la actualizacion");
              })
              .catch(err => {
                if (err.data.error.documento !== undefined)
                {
                  $scope.input = err.data.error.documento.message;
                } else if (err.data.error.foto !== undefined) {
                  $scope.input = err.data.error.foto.message;
                } else if (err.data.error.carnet !== undefined)
                {
                  $scope.input = err.data.error.carnet.message;
                }


                toastr.error($scope.input);
              });

    };

  } else {
    $state.go('index');
  }

}