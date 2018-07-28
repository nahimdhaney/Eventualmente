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
            <div>
                <a href="/crearevento">
                    <h1 class="my-4"> Nuevo Evento
                    </h1>
                </a>              
            </div>
            <div class="row">

                @foreach($listaEventos as $objCat)
                <div id='{{$objCat["id"]}}' class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href={{"gestionarEvento/".$objCat["id"]}}><img class="card-img-top" src={{"fotos/".$objCat["id"].".jpg"}} alt="Sin Imagen"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href={{"gestionarEvento/".$objCat["id"]}} >{{$objCat["titulo"]}}</a>
                            </h4>
                            <div class= "small col-auto">                                
                                <a href={{"gestionarEvento/".$objCat["id"]}} > Gestionar    </a>
                                <a href={{"editarEvento/".$objCat["id"]}} > Editar </a>
                                <!--<a href={{"EliminarEvento/".$objCat["id"]}} > Eliminar </a>-->
                                <a href="#" id="borrar" onclick='borrar({{$objCat["id"]}})' >Borrar</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- /.row -->

                <!-- Pagination -->

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
            <script src="js/misEventos.js"></script>

    </body>

</html>
