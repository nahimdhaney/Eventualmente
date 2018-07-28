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

        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 400px;
            }
        </style>

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../js/crearentrada.js"></script>



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
            <!--<h1 class="my-4">-->
            <div class="row">
                <div class="col-md-8">

                </div>

                @auth
                <form method="POST" action="{{url('pagar')}}" enctype="multipart/form-data" >                        
                    @else
                    <form action="{{route('login')}}" >
                        @endauth
                        {{csrf_field()}}
                        <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                                <tr >
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th class="text-center">
                                        Usuario
                                    </th>
                                    <th class="text-center">
                                        Nombre Entrada
                                    </th>
                                    <th class="text-center">
                                        Precio
                                    </th>
                                    <th class="text-center">
                                        Entradas Compradas
                                    </th>
                                    <th class="text-center">
                                        Total A pagar 
                                    </th>
                                    <th class="text-center">
                                        Pagadas
                                    </th>
                                    <th class="text-center">
                                        Asistencia
                                    </th>
                                    <!--  asistido, pagado, users.nombre as usuarioNombre, users.apellido as apellido-->
                                    <!--, entradas.nombre as entradaNombre, entradas.precio as precio, entradas.cantidad as cantidad-->
                                </tr>
                            </thead>
                            <tbody>
                                {{ $a = 0 }} 
                                @foreach($listaEntradas as $objEnt)
                                <tr id='addr0'>
                                    <td>
                                        {{$objEnt["id"]}}
                                    </td>
                                    <td>
                                        {{$objEnt["usuarioNombre"]}} 
                                        {{$objEnt["apellido"]}}
                                    </td>
                            <input type="hidden" name={{'datos['.$a.']'}} value={{$objEnt["id"]}} />
                            <td>
                                <input type="text" name='name0'  placeholder='Nombre Entrada' value={{$objEnt["entradaNombre"]}} class="form-control" readonly/>
                            </td>
                            <td>
                                <input type="number"step="any" name='precio0' value={{$objEnt["precio"]}} class="form-control" readonly/>
                            </td>
                            <td>
                                <input type="number" name='cantidad0' value={{$objEnt["cantidadComprada"]}} placeholder='Cantidad' class="form-control" readonly/>
                            </td>  
                            <td>
                                <input type="text" name='Totalbs0' value={{$objEnt["cantidadComprada"]*$objEnt["precio"].'Bs'}} placeholder='Cantidad' class="form-control" readonly/>
                            </td>  
                            <td>
                                @if($objEnt['pagado'] == 1)
                                <input name={{'pagada'.$objEnt["id"]}} type="checkbox" class="form-control-custom " checked>                                        
                                @else
                                <input name={{'pagada'.$objEnt["id"]}} type="checkbox"  class="form-control-custom ">
                                @endif
                            </td>
                            <td>
                                @if($objEnt['asistido'] == 1)
                                <input name={{'asistida'.$objEnt["id"]}} type="checkbox" class="form-control-custom " checked>
                                @else
                                <input name={{'asistida'.$objEnt["id"]}} type="checkbox" class="form-control-custom ">
                                @endif
                            </td>
                            </tr>
                            {{ $a++ }} 
                            @endforeach
                        <!--<tr id='addr1'></tr>-->
                            </tbody>
                        </table>
                        <input type="submit" value="Aceptar" class="btn btn-primary">
                        <BR>
                    </form>
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
