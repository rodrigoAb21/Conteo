$(function () {
    // Validacion de textos
    $("input[type='text']").blur(function () {
        if($(this).prop('required')){
            var cadena = $(this).val().trim();
            var x = cadena.length;
            if (x == 0 && x >= 255){
                $(this)[0].setCustomValidity("Es necesario rellenar este campo");
            } else{
                $(this)[0].setCustomValidity("");
                $(this).val(cadena);
            }
        }
    });



    // Validacion del formato de la imagen
    $("input[type='file']").blur(function () {
        var cadena = $(this).val().trim();
        var x = cadena.length;
        if (x != 0){
            var formato = /\.(jpg|jpeg|bmp|png)/;
            if (!formato.test(cadena) || x > 255){
                $(this).val("");
                alert("La imagen debe ser de formato jpg, jpeg, bmp, png");
            }
        }else{
            $(this).val("");
        }
    });

    // Validacion del email
    $("input[type='email']").blur(function () {
        var cadena = $(this).val().trim();
        var x = cadena.length;
        if (x != 0){
            var formato = /\w+@\w+\.[a-z]/;
            if (formato.test(cadena)){
                $(this)[0].setCustomValidity("");
                $(this).val(cadena);
            }else{
                $(this)[0].setCustomValidity("Debe ingresar un E-Mail valido");
            }
        } else {
            $(this).val("");
        }
    });
});