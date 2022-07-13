angular
        .module('proyect')
        .controller('registro_usuController', registro_usuController);
registro_usuController.$inject = ['$scope', 'databaseService', '$state', '$sessionStorage'];
function registro_usuController($scope, databaseService, $state, $sessionStorage) {
  if ($sessionStorage.data !== undefined) {
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
        ev.preventDefault();
      }, false);

    })();
    $scope.input = "";
    $scope.aprendiz = {};
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
    $scope.ActualizarAprendiz = () => {
      databaseService.ActualizarAprendiz($scope.aprendiz)
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

  } else {
    $state.go('index');
  }

}