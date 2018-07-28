$(document).ready(function () {

    $('#calTotal').submit(function () {
//        return true;
        var final = $('#totalLista').val();
        for (var i = 0; i < final; i++) {
            if ($('input[name=escogido' + i + ']').prop('checked')) { // si tiene checked
//                console.log('intento ' + i);
                if ($('input[name=cantidadDisponible' + i + ']').val() > 0) { // si es que hay mas de uno
                    if ($('input[name=CantidadCompra' + i + ']').val() > 0) { // si no esta vacio cantidad a comprar
                        if (parseInt($('input[name=CantidadCompra' + i + ']').val()) <= parseInt($('input[name=cantidadDisponible' + i + ']').val())) { // cantidad compra matyor a  disponible
                            return true
                        } else {
//                            console.log('este ' + $('input[name=CantidadCompra' + i + ']').val() + ' menor o igual a ' + $('input[name=cantidadDisponible' + i + ']').val());
                        }
//                        console.log('vacio cantidad a comprar' + i);
                    }
//                    console.log('vacio disponible' + i);
                }
//                console.log('checkeado ' + i);
            }
        }
        return false;
        // your code here
    });

    $('#calTotal').click(function () {
//        return true;
        var final = $('#totalLista').val();
        $('#TotalPagar').val(0);
        for (var i = 0; i < final; i++) {
            if ($('input[name=escogido' + i + ']').prop('checked')) { // si tiene checked
//                console.log('intento ' + i);
                if ($('input[name=cantidadDisponible' + i + ']').val() > 0) { // si es que hay mas de uno
                    if ($('input[name=CantidadCompra' + i + ']').val() > 0) { // si no esta vacio cantidad a comprar
                        if (parseInt($('input[name=CantidadCompra' + i + ']').val()) <= parseInt($('input[name=cantidadDisponible' + i + ']').val())) { // cantidad compra matyor a  disponible
                            console.log('confirmando' + i);
//                            return true;
                            var Suma = parseInt($('input[name=CantidadCompra' + i + ']').val()) * parseInt($('input[name=precio' + i + ']').val());
//                            var totalPagar = parseInt($('#totalApagar').val());
                            var totalPagar = parseInt($('#TotalPagar').val());
                            if (isNaN(totalPagar)) {
                                totalPagar = 0;
                                console.log('PASA NAN ');
                            }
                            var TotalFinal = Suma + totalPagar;
                            console.log('totalApagar' + TotalFinal);
                            $('#TotalPagar').val(TotalFinal);
                        } else {
//                            console.log('este ' + $('input[name=CantidadCompra' + i + ']').val() + ' menor o igual a ' + $('input[name=cantidadDisponible' + i + ']').val());
                        }
//                        console.log('vacio cantidad a comprar' + i);
                    }
//                    console.log('vacio disponible' + i);
                }
//                console.log('checkeado ' + i);
            }
        }
        return false;
        // your code here
    });



//        return true;
//    var final = $('#totalLista').val();
//    for (var i = 0; i < final; i++) {
//        $('#CantidadCompra' + i).on('keyup', function () {
//            if ($('input[name=escogido' + i + ']').prop('checked')) { // si tiene checked
////                console.log('intento ' + i);
//                if ($('input[name=cantidadDisponible' + i + ']').val() > 0) { // si es que hay mas de uno
//                    if ($('input[name=CantidadCompra' + i + ']').val() > 0) { // si no esta vacio cantidad a comprar
//                        if (parseInt($('input[name=CantidadCompra' + i + ']').val()) <= parseInt($('input[name=cantidadDisponible' + i + ']').val())) { // cantidad compra matyor a  disponible
////                            console.log('confirmando' + i);
//                           
//                        } else {
//                            console.log('este ' + $('input[name=CantidadCompra' + i + ']').val() + ' menor o igual a ' + $('input[name=cantidadDisponible' + i + ']').val());
//                        }
//                        console.log('vacio cantidad a comprar' + i);
//                    }
//                    console.log('vacio disponible' + i);
//                }
//                console.log('checkeado ' + i);
//            }
//        });
//    }
//        return false;
    // your code here


//    CantidadCompra0

});