function borrar(valor) {
    console.log(valor);

    $.ajax({// hace el Ajax
        method: 'GET',
        url: '/EliminarEvento/' + valor,
        success: function (data) {
            //  Route::get('/EliminarEvento/{id}','EventoController@eliminarEvento');
//                $('.notas').html()(data);
//                console.log("pasoo");
            console.log(data);
            $("#"+ valor).empty();
            
            
            return;
            for (var i in data) {
                var obj = data[i];
                var myvar = '<div class="col-lg-4 col-md-6 mb-4">' +
                        '                            <div class="card h-100">' +
                        '                                <div class="card-body">' +
                        '                                    <h4 class="card-title">' +
                        '                                        <a href ={{"#flipFlop".$objNota["id"]}}    data-toggle="modal"  data-target=' + '"#flipFlop' + obj.id + '"' +
                        '                                           >' + obj.titulo + '</a>' +
                        '                                    </h4>' +
                        '                                    <p class="card-text">' + obj.descripcion + '</p>' +
                        '                                </div>' +
                        '                                <div class="card-footer">' +
                        '                                    <a href="#"  data-toggle="modal"  data-target=' + '"#flipFlop' + obj.id + '"' + ' >editar </a>' +
                        '                                    <a  href="#" id="borrar" onclick=\'borrar(' + obj.id + ')\' >Borrar</a>' +
                        '                                </div>' +
                        '                            </div>' +
                        '                        </div>' +
                        '<div class="modal fade" id=' + '"flipFlop' + obj.id + '"' + ' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
                        '                  <div class="modal-dialog" role="document">                                                                                                                 ' +
                        '                      <div class="modal-content">                                                                                                                            ' +
                        '                          <div class="modal-header">                                                                                                                         ' +
                        '                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">                                                                   ' +
                        '                                  <span aria-hidden="true">&times;</span>                                                                                                    ' +
                        '                              </button>                                                                                                                                      ' +
                        '                              <h4  contenteditable="true" class="modal-title" id=' + '"titulo' + obj.id + '"' + ' >' + obj.titulo + '</h4>                                   ' +
                        '                          </div>                                                                                                                                             ' +
                        '                          <textarea id=' + '"descripcion' + obj.id + '"' + '>' + obj.descripcion + '</textarea>                                                               ' +
                        '                          <div class="modal-footer">                                                                                                                         ' +
                        '                              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelarNuevo">Cancelar</button>                                      ' +
                        '                              <button type="button" class="btn btn-success" data-dismiss="modal" id="FinalizarNuevo" onclick=\'editar(' + obj.id + ')\'>Finalizar</button> ' +
                        '                          </div>                                                                                                                                             ' +
                        '                      </div>                                                                                                                                                 ' +
                        '                  </div>                                                                                                                                                     ' +
                        '              </div>                                                                                                                                                         ' +
                        '                                                                                                                                                                             ';
                var resultado = '<div class="col-lg-4 col-md-6 mb-4">' +
                        '                            <div class="card h-100">' +
                        '                                <div class="card-body">' +
                        '                                    <h4 class="card-title">' +
                        '                                        <a href="#">' + obj.titulo + '</a>' +
                        '                                    </h4>' +
                        '                                    <p class="card-text">' + obj.descripcion + '</p>' +
                        '                                </div>' +
                        '                            </div>' +
                        '                        </div>';
                $(".notas").append(myvar);
//                    $(".notas").append(resultado);
//myvar
            }

        },
        error: function (xhr) {
            console.log(xhr);
            //Do Something to handle error
        }
    });

}