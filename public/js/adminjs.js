function justNumbers(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}


//function validation()
//{
//    var errorUsuario = false;
//    var usuario = document.getElementById("usuario").value;
//    console.log(usuario);
//
//    for (i = 0; i < usuario.length; i++) {
//        if (usuario < 6) {
//            console.log(usuario);
//            errorUsuario = true;
//        }
//    }
//
//}

