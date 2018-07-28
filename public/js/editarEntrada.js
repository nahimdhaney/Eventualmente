$(document).ready(function () {
    var i = parseInt($('input[name=ultimo]').val());
    $("#add_row").click(function () {
        $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input name='name" + i + "' type='text' placeholder='Nombre' class='form-control input-md'  />\n\
        </td><td><input  name='precio" + i + "' type='number'step='any' placeholder='precio'  class='form-control input-md'> \n\
        </td> <td><input  name='cantidad" + i + "' type='number'step='any' placeholder='cantidad'  class='form-control input-md'> \n\
        </td>");

        $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
        i++;
    });
    $("#delete_row").click(function () {
        var total = $('#totalEntrada'); // no puede ser mayor a total
//        alert(total.val())
        if (i > total.val()) {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
        }
    });


});