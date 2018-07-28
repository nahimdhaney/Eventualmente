$(document).ready(function () {
    var i = 1;
    $("#add_row").click(function () {
        $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input name='name" + i + "' type='text' placeholder='Nombre' class='form-control input-md'  />\n\
        </td><td><input  name='precio" + i + "' type='number'step='any' placeholder='precio'  class='form-control input-md'> \n\
        </td> <td><input  name='cantidad" + i + "' type='number'step='any' placeholder='cantidad'  class='form-control input-md'> \n\
        </td>");

        $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
        i++;
    });
    $("#delete_row").click(function () {
        
        if (i > 1) {
            $("#addr" + (i - 1)).html('');
            i--;
        }
    });


});