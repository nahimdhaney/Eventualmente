<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Eventos </title>
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/4-col-portfolio.css" rel="stylesheet">

        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 400px;
            }
        </style>

    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                                        @auth
                                        {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}} 
                                        @else
                                        Terrazas Eventos
                                        @endauth
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/home')}}">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categorias">Categorias</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="miseventos">Mis Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="eventosregistrados">Eventos a Asistir</a>
                        </li>
                        <!--{{ Auth::user()->name }}-->
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/logout')}}">
                                Logout
                            </a>            
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>        

        <!-- Page Content -->
        <div class="container">
            <!-- Page Heading -->
            <h1 class="my-4">Nuevo evento
            </h1>
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-block">
                            @auth
                            <form method="POST" action="{{url('agregar')}}" enctype="multipart/form-data" >                        
                                @else
                                <form action="{{route('login')}}" >
                                    @endauth
                                    {{csrf_field()}}
                                    <input type="hidden" name="metodo" value="CREAR">
                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input name="titulo" type="text" placeholder="titulo" class="form-control" required>
                                    </div>
                                    <div  class="form-group">       
                                        <label>Descripcion del evento</label>
                                        <textarea name="descripcion-evento" class="form-control" required>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input name="direccion" type="text" placeholder="Direccion" class="form-control" required>
                                    </div>
                                    <div class="form-group">       
                                        <label>Fecha Inicial</label>
                                        <input name="fechaInicial" type="date" placeholder="date" class="form-control date" required>
                                        <input name="horaInicial" type="time" placeholder="time" class="form-control time" value="08:56" >
                                    </div>
                                    <div class="form-group">       
                                        <label>Fecha Final</label>
                                        <input id="fechaFinal" name="fechaFinal" type="date" placeholder="date" class="form-control" required>
                                        <input id="horaFinal" name="horaFinal" type="time" placeholder="time" class="form-control" value="08:56">
                                    </div>
                                    <div class="form-group">       
                                        <label>Foto del evento</label>
                                        <input name="fotoEvento" type="file" placeholder="time" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Organizador</label>
                                        <input name="organizarTitulo" type="text" placeholder="Organizador" class="form-control" required>
                                    </div>
                                    <div class="form-group">       
                                        <label>Descripcion del Organizador</label>
                                        <textarea  name="descripcion-organizador" class="form-control" required>
                                        </textarea>
                                    </div>
                                    <div class="i-checks">
                                        @foreach($listaCategorias as $objCat)
                                        <input name={{"checkboxCustom".$objCat["id"]}} type="checkbox" value={{$objCat["id"]}} class="form-control-custom">
                                        <label for={{"checkboxCustom".$objCat["id"]}} >{{$objCat["nombre"]}}</label>
                                        @endforeach
                                    </div>
                                    <table class="table table-bordered table-hover" id="tab_logic">
                                        <thead>
                                            <tr >
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th class="text-center">
                                                    Nombre Entrada
                                                </th>
                                                <th class="text-center">
                                                    Precio
                                                </th>
                                                <th class="text-center">
                                                    Entradas Disponibles
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='addr0'>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <input type="text" name='name0'  placeholder='Nombre Entrada' class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="number"step="any" name='precio0' placeholder='precio' class="form-control" required/>
                                                </td>
                                                <td>
                                                    <input type="number" name='cantidad0' placeholder='Cantidad' class="form-control" required/>
                                                </td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">       
                                        <button onclick="return false;" class="btn btn-default" id="add_row" class="left">Agregar Entrada</button>
                                        <button onclick="return false;" id='delete_row' class="btn btn-default">Borrar Entrada</button>
                                    </div>
                                    <div id="map" style="position: relative;overflow: initial;" ></div>
                                    <div id="current">Nothing yet...</div>
                                    <script>

                                        function initMap() {
                                            var myLatLng = {lat: -17.715822, lng: -63.168786};
//                                            var myLatLng = {lat: -25.363, lng: 131.044};

                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 15,
                                                center: myLatLng,
                                            });

                                            var marker = new google.maps.Marker({
                                                position: myLatLng,
                                                map: map,
                                                draggable: true,
                                                title: 'Aqui sera la direccion del evento'
                                            });
                                            google.maps.event.addListener(marker, 'dragend', function (evt) {
                                                document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(6) + ' Current Lng: ' + evt.latLng.lng().toFixed(6) + '</p>';
                                                $('input[name=lat]').val(evt.latLng.lat().toFixed(6));
                                                $('input[name=long]').val(evt.latLng.lng().toFixed(6));
                                            });
                                            $('input[name=fotoEvento]').change(function () {
//                                                console.log(this.files[0].mozFullPath);
//                                                alert($('input[name=fotoEvento]').val());
//                                                $('input[name=fotoEvento]').val(this.files[0].mozFullPath);
                                            });
                                        }
                                    </script>
                                    <script async defer
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwITukHDHEyoWMQ-4N2Mja6d2TpPHXZxw&callback=initMap">
                                    </script>
                                    <input type="hidden" name="lat" value="CREAR">
                                    <input type="hidden" name="long" value="CREAR">
                                    <div class="form-group">       
                                        <input type="submit" value="Completar" class="btn btn-primary">
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                    <p class="m-0 text-center text-white"> TdeP &copy; Copyright 2017</p>
            </div>
            <!-- /.container -->
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/crearentrada.js"></script>
    </body>
</html>
