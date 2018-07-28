<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Eventos </title>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/4-col-portfolio.css" rel="stylesheet">
        <link href="../css/verEvento.css" rel="stylesheet">

        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 400px;
            }
        </style>

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../js/crearentrada.js"></script>
        <script src="../js/verEvento.js"></script>



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
                            <a class="nav-link" href="../categorias">Categorias</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="../miseventos">Mis Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../eventosregistrados">Eventos a Asistir</a>
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
            <h1 class="my-4">{{$objevento["titulo"]}}
            </h1>
            <div class="row">
                <div class="col-md-8">
                    <img class="img-fluid" src={{"../fotos/".$objevento["id"].".jpg"}} alt="">
                </div>
                <div class="col-md-4">
                    <h3 class="my-3">Descripcion del evento</h3>
                    <p> {{$objevento["descripcion"]}} </p>
                    <h3 class="my-3">¿Cuando?</h3>
                    <ul>
                        <li>Desde las {{$objevento["fechaInicio"]}}</li>
                        <li>Hasta las {{$objevento["fechaFin"]}}</li>
                    </ul>
                </div>
            </div>
            <div>
                <h3 class="my-3">Organiza: </h3>
                <h4 class="my-3"> {{$objevento["nombreOrganizador"]}}</h4>
                <p> {{$objevento["descripcionOrganizador"]}} </p>
                <h3 class="my-3"> ¿Donde?</h3>
                <p> {{$objevento["Direccion"]}} </p>
            </div>
            <div id="map" style="position: relative;overflow: initial;" ></div>
            <!--<div id="current">Nothing yet...</div>-->
            <input type="hidden" name="lat" value={{$objevento["latitud"]}}>
            <input type="hidden" name="long" value={{$objevento["longitud"]}}>
            <script>
                function initMap() {
                    var lati = Number($('input[name=lat]').val());
//                    lat: , lng:
                    var long = Number($('input[name=long]').val());
                    var myLatLng = {lat: lati, lng: long};

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: myLatLng,
                    });

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
//                         draggable: true,
                        title: 'El Evento es aqui'
                    });
//                google.maps.event.addListener(marker, 'dragend', function(evt){
//                document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
//                });

                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwITukHDHEyoWMQ-4N2Mja6d2TpPHXZxw&callback=initMap">
            </script>
            <!-- /.row -->
            <!--            <h3 class="my-3"> Entradas Disponibles </h3>
                        @auth
                        <form method="POST" action="{{url('registrarme')}}" enctype="multipart/form-data" >                        
                            @else
                            <form action="{{route('login')}}" >
                                @endauth
            
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                Seleccionar Entrada
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
                                        @foreach($listaEntradas as $objEnt)
                                        <tr id='addr0'>
                                            <td>
                                                <input name="escogido" type="radio" value={{$objEnt["id"]}} class="form-control-custom ">
                                                <label for={{"checkboxCustom".$objEnt["id"]}} ></label>                        
                                            </td>
                                            <td>
                                                <input type="text" name='name0'  placeholder='Nombre Entrada' value={{$objEnt["nombre"]}} class="form-control" readonly/>
                                            </td>
                                            <td>
                                                <input type="number"step="any" name='precio0' value={{$objEnt["precio"]}} class="form-control" readonly/>
                                            </td>
                                            <td>
                                                <input type="number" name='cantidad0' value={{$objEnt["cantidad"]}} placeholder='Cantidad' class="form-control" readonly/>
                                            </td>   
                                        </tr>
                                        @endforeach
                                    <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                                <input type="submit" value="Completar" class="btn btn-primary">
                                <BR>
                            </form>-->
            <br>
            <div>
                @if( empty($objRegistro['id']))
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    Registrarme
                </button>
                @else
                @auth
                <form method="POST" action="{{url('eliminar')}}" enctype="multipart/form-data" >                        
                    {{csrf_field()}}
                    <input type="hidden" name="idEvento" value={{$objevento["id"]}}>
                    <input type="submit" value="Eliminar Registro" class="btn btn-primary btn-lg" />                        
                    </button>
                </form>

                @endauth
                @endif
            </div>
            <br>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Entradas Disponibles</h4>
                        <button type="button" class="close" data-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        @auth
                        <form id="miform" method="POST" action="{{url('registrarme')}}" enctype="multipart/form-data" >                        
                            @else
                            <form action="{{route('login')}}" >
                                @endauth
                                {{csrf_field()}}
                                <input type="hidden" name="idEvento" value={{$objevento["id"]}}>
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                Seleccionar Entrada
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
                                            <th class="text-center">
                                                Cantidad
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{ $a = 0 }} 
                                        @foreach($listaEntradas as $objEnt)
                                        <tr id='addr0'>
                                            <td>
                                                <input name={{'escogido'.$a}} type="checkbox" value={{$objEnt["id"]}} class="form-control-custom ">
                                                <!--<label for={{"checkboxCustom".$objEnt["id"]}} ></label>-->                        
                                            </td>
                                            <td>
                                                <input type="text" name='name0'  placeholder='Nombre Entrada' value={{$objEnt["nombre"]}} class="form-control" readonly/>
                                            </td>
                                            <td>
                                                <input type="number"step="any" name={{'precio'.$a}} value={{$objEnt["precio"]}} class="form-control" readonly/>
                                            </td>
                                            <td>
                                                <input type="number" name={{'cantidadDisponible'.$a}}  value={{$objEnt["cantidad"]}} placeholder='Cantidad' class="form-control" readonly/>
                                            </td>   
                                            <td>
                                                <input type="number" name={{'CantidadCompra'.$a}} placeholder='Cantidad a comprar' class="form-control"/>
                                            </td>   
                                            {{ $a++ }} 
                                        </tr>
                                        @endforeach
                                    <input type="hidden" id="totalLista" name={{"total"}} value={{$a}} placeholder='Cantidad' class="form-control" required/>
                                    <!--<tr id='addr1'></tr>-->
                                    </tbody>
                                </table>
                                <div class="form-group form-group-sm">       
                                    <label>Total a Pagar :</label>
                                    <input type="text" id="TotalPagar" name="TotalPagar" class="form-control form-control-sm" readonly>
<!--                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
                                        Registrarme
                                    </button>-->
                                </div>
                                <div class="in">
                                    <input type="button" id="calTotal" value="Calcular Total" class="btn btn-primary">
                                    <input type="submit"  value="Aceptar" class="btn btn-danger hidden" >
    <!--                                <input type="text" value="Total a Pagar" class="form-control">-->
                                </div>
                                <BR>
                            </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                          
                    </div>
                </div>
            </div>
        </div>





        <!-- /.container -->
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">TdeP Copyright &copy; 2017</p>
            </div>
            <!-- /.container -->
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
