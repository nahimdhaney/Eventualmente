<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Evento;
use App\Categoria;
use App\Entrada;
use App\Registro;
use App\eventoCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use Storage;
use App\Quotation;
use DateTime;
use View;
use Redirect;
use Carbon\Carbon;

class EventoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//        Noche
//        Boda
//        Infantil
//        Deporte
//        Fiesta
//        Tecnologia
//        Conferencia    
        $listaCategorias = Categoria::all()->toArray();
        return view('crearevento', compact('listaCategorias'));
    }

    public function editarEvento($id) {
        $objevento = Evento::where('id', $id)->first();
//        $objRegistro = Registro::where([
//                    ['evento_id', '=', $id],
//                    ['usuario_id', '=', Auth::id()]])->first();
//        $listaEntradas = Evento::where('evento_id', Auth::id())->get();
//                    $table->integer('evento_id')->unsigned();
//            $table->integer('categoria_id')->unsigned();
        $listaEntradas = Entrada::where('evento_id', $id)->get();
        $listaCatSelect = eventoCategoria::where('evento_id', $id)->pluck('categoria_id');
        $listaCategorias = Categoria::all()->toArray();
        $objHora = $objevento->fechaInicio;
        $objInicial = substr($objHora, 11, 5);
        $objFinal = substr($objevento->fechaFin, 11, 5);
        $myDateTime = DateTime::createFromFormat('Y-m-d', $objHora);
//        $formattedweddingdate = $myDateTime->format('d-m-Y');
        $date = date_create('2000-01-01');
//        date_format($date, 'Y-m-d H:i:s');
//        return $objFinal;
//        return  date_format($date, 'H:i:s');
//        return view('verEvento', compact('objevento'));
        return View::make('editarEvento')->with(compact('objevento'))->with(compact('listaEntradas'))
                        ->with(compact('listaCategorias'))->with(compact('objInicial'))->with(compact('objFinal'))->with(compact('listaCatSelect'));
    }

    public function eliminarEvento($id) {
//        Nota::destroy($id);
//        evento_categorias;
//        eventoCategoria::destroy($ids);
        $objRegistros = eventoCategoria::where('evento_id', '=', $id)->get();
        // borra todos Registros de evntos categoria
        foreach ($objRegistros as $id2) {
            eventoCategoria::where('evento_id', $id2->evento_id)->delete();
        }
        // borra todos  las entradas para volverlas a crear
        $objEntra = Entrada::where('evento_id', '=', $id)->get();

        foreach ($objEntra as $id3) {
            Entrada::where('evento_id', $id3->evento_id)->delete();
        }
        Evento::destroy($id);
        $listaEventos = Evento::where('usuario_id', Auth::id())->get();
        return $listaEventos;
    }
    // Back
//    public function eliminarEvento($id) {
////        Nota::destroy($id);
////        evento_categorias;
////        eventoCategoria::destroy($ids);
//        $objRegistros = eventoCategoria::where('evento_id', '=', $id)->get();
//        // borra todos Registros de evntos categoria
//        foreach ($objRegistros as $id2) {
//            eventoCategoria::where('evento_id', $id2->evento_id)->delete();
//        }
//        // borra todos  las entradas para volverlas a crear
//        $objEntra = Entrada::where('evento_id', '=', $id)->get();
//
//        foreach ($objEntra as $id3) {
//            Entrada::where('evento_id', $id3->evento_id)->delete();
//        }
//        Evento::destroy($id);
//        $listaEventos = Evento::where('usuario_id', Auth::id())->get();
//        return Redirect::to('/');
//    }

//    public function agregar($titulo,$desc) {
    public function verMisEventos() {
        $listaEventos = Evento::where('usuario_id', Auth::id())->get();
        return view('miseventos', compact('listaEventos'));
    }

    public function EditarMisEventos() {
        $listaEventos = Evento::where('usuario_id', Auth::id())->get();
        return view('editareventos', compact('listaEventos'));
    }

    public function verEvento($id) {
        $objevento = Evento::where('id', $id)->first();
        $objRegistro = Registro::where([
                    ['evento_id', '=', $id],
                    ['usuario_id', '=', Auth::id()]])->first();
//        $listaEntradas = Evento::where('evento_id', Auth::id())->get();
//        $listaEntradas = Entrada::where('evento_id', $id)->get();
//        $listaEntradas = DB::raw('e.id as id, evento_id,precio,nombre,(cantidad - COALESCE(vendidas, 0)) as cantidad')
//                ->from(DB::raw('entradas e'))
//                ->join('registros', 'eventos.id', '=', 'registros.evento_id')
//                ->where('registros.usuario_id', '=', Auth::id())
//                ->select('eventos.*')
//                ->get();
        $listaEntradas = DB::select("select e.id as id, evento_id,precio,nombre,(cantidad - COALESCE(vendidas, 0)) as cantidad from entradas e
        left join (select sum(cantidad) as vendidas, entrada_id from 
        registros r 
        group by r.entrada_id) a on e.id = a.entrada_id
        where evento_id = " . $id . "");
        $listaEntradas = json_encode($listaEntradas);
        $listaEntradas = json_decode($listaEntradas, true);
//        return $objevento;
//        return $listaEntradas;
//select e.id as id, evento_id,precio,nombre,(cantidad - COALESCE(vendidas, 0)) as cantidad from entradas e
//left join (select count(*) as vendidas, entrada_id from 
//left join (select count(*) as vendidas, entrada_id from 
//registros r 
//group by r.entrada_id) a on e.id = a.entrada_id
//        return view('verEvento', compact('objevento'));
        return View::make('verEvento')->with(compact('objevento'))->with(compact('objRegistro'))->with(compact('listaEntradas'));
    }

    public function verEventosRegistrados() {
        //
        $lista = DB::table('eventos')
                ->join('registros', 'eventos.id', '=', 'registros.evento_id')
                ->where('registros.usuario_id', '=', Auth::id())
                ->select('eventos.*','registros.id as idRegistro')
                ->get();
        $listaEventos = json_decode($lista, true);
//        select eventos.* from eventos
//        join registros on 
//        eventos.id = registros.evento_id
//        where registros.usuario_id = '2'  
//        return $listaEventos;
        return view('eventosRegistrados', compact('listaEventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('nueva');
        //
    }

    public function crear(Request $request) {
        // crear Evento
//        $prueba = Input::get('sdjflkms1');
        $evento = Input::get('titulo');
//        $eventoUltimo = DB::table('eventos')->orderBy('updated_at', 'desc')->first(); // obtiene la ultima 
//        return $eventoUltimo->id;
//        return "Termina";
//        $file = $request->file('fotoEvento');
//        Input::file('fotoEvento')->move("img");
//        return;
        $evento = new Evento();
        $evento->titulo = Input::get('titulo');
        $evento->usuario_id = Auth::id();
        $evento->descripcion = Input::get('descripcion-evento');
        $evento->Direccion = Input::get('direccion');

        $fecha = new DateTime(Input::get('fechaInicial'));
        $porciones = explode(":", Input::get('horaInicial'));
        $fecha->setTime($porciones[0], $porciones[1]);
        $fecha2 = new DateTime(Input::get('fechaFinal'));
        $porciones = explode(":", Input::get('horaFinal'));
        $fecha2->setTime($porciones[0], $porciones[1]);
        $evento->fechaInicio = $fecha->format('Y-m-d H:i:s'); //    fechaInicial  horaInicial
        $evento->fechaFin = $fecha2->format('Y-m-d H:i:s'); // fecha Final / Hora final 
        $evento->nombreOrganizador = Input::get('organizarTitulo');  // fecha Final / Hora final 
        $evento->descripcionOrganizador = Input::get('descripcion-organizador');  // fecha Final / Hora final
        $evento->latitud = Input::get('lat');
        $evento->longitud = Input::get('long');
        $evento->save();
        $file = Input::file('fotoEvento');
        $destinationPath = public_path() . '/fotos/';
//        $filename = $file->getClientOriginalName();
        Input::file('fotoEvento')->move($destinationPath, $evento->id . ".jpg");
//        $->save();
        // TODO categorias
        $numero = 1;
        $eventoUltimo = DB::table('eventos')->orderBy('updated_at', 'desc')->first(); // obtiene la ultima 
        $mayor = DB::table('categorias')->orderBy('updated_at', 'desc')->first(); // obtiene la ultima 
        while ($numero < $mayor->id) {
            $checked = 'checkboxCustom' . $numero;
            $checkBox = Input::get((string) $checked);
            if ($checkBox != null) {
                $eventoCategoria = new eventoCategoria();
                $eventoCategoria->evento_id = $eventoUltimo->id;
                $eventoCategoria->categoria_id = $checkBox;
                $eventoCategoria->save();
            }
            $numero++;
        }
        // entradas
//        $numero2 = 0;
//        $no = 'name' . $numero2;
//        $nombre = Input::get((string) $no);
//        while (!empty($numero2)) {
//            $entrada = new Entrada();
//            $n = ('name' . $numero2);
//            $entrada->nombre = Input::get((string) $n);
//            $entrada->precio = Input::get('precio' . $numero2);
//            $entrada->cantidad = Input::get('cantidad' . $numero2);
//            $entrada->evento_id = $eventoUltimo->id;
//            $entrada->save();
//            $numero2++;
//        }
//            $table->integer('evento_id')->unsigned();
//            $table->integer('categoria_id')->unsigned();        
// horaFinal
//            $table->integer('usuario_id')->unsigned();
//            $table->string('titulo',100);
//            $table->point('latitud');
//            $table->point('longitud');
//            $table->string('descripcion',500);
//            $table->date('fechaInicio');
//            $table->date('fechaFin');   
//            $table->string('nombreOrganizador',100);
//            $table->string('descripcionOrganizador',800);
//            $table->string('Direccion',500);                
        //        $listaNotas = Nota::all()->toArray();
        //  return $listaNotas;
        // genera las entradas
        $numero2 = 0;
        $no = 'name' . $numero2;
        $nombre = Input::get((string) $no);
        while (!empty($nombre)) {
            $entrada = new Entrada();
            $n = ('name' . $numero2);
            $entrada->nombre = Input::get((string) $n);
            $entrada->precio = Input::get('precio' . $numero2);
            $entrada->cantidad = Input::get('cantidad' . $numero2);
            $entrada->evento_id = $eventoUltimo->id;
            $entrada->save();
            $numero2++;
            $nombre = Input::get(('name' . $numero2));
        }
        return Redirect::to('/');
    }

    public function editar(Request $request) {

        $objRegistros = eventoCategoria::where('evento_id', '=', Input::get('EventoID'))->get();
        // borra todos Registros de evntos categoria
        foreach ($objRegistros as $id) {
            eventoCategoria::where('evento_id', $id->evento_id)->delete();
        }
        // borra todos  las entradas para volverlas a crear
//        $objEntra = Entrada::where('evento_id', '=', Input::get('EventoID'))->get();
//        foreach ($objEntra as $id) {
//            Entrada::where('evento_id', $id->evento_id)->delete();
//        }
        // editar
        $evento = Evento::where('id', Input::get('EventoID'))->first();
        $evento->titulo = Input::get('titulo');
        $evento->usuario_id = Auth::id();
        $evento->descripcion = Input::get('descripcion-evento');
        $evento->Direccion = Input::get('direccion');

        $fecha = new DateTime(Input::get('fechaInicial'));
        $porciones = explode(":", Input::get('horaInicial'));
        $fecha->setTime($porciones[0], $porciones[1]);
        $fecha2 = new DateTime(Input::get('fechaFinal'));
        $porciones = explode(":", Input::get('horaFinal'));
        $fecha2->setTime($porciones[0], $porciones[1]);
        $evento->fechaInicio = $fecha->format('Y-m-d H:i:s'); //    fechaInicial  horaInicial
        $evento->fechaFin = $fecha2->format('Y-m-d H:i:s'); // fecha Final / Hora final 
//        $evento->fechaFin = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
//        return $evento;
        $evento->nombreOrganizador = Input::get('organizarTitulo');  // fecha Final / Hora final 
        $evento->descripcionOrganizador = Input::get('descripcion-organizador');  // fecha Final / Hora final
        $evento->latitud = Input::get('lat');
        $evento->longitud = Input::get('long');
        $evento->save();
        $file = Input::file('fotoEvento');
        if ($file != null) {
            $destinationPath = public_path() . '/fotos/';
            Input::file('fotoEvento')->move($destinationPath, $evento->id . ".jpg");
        }
        $numero = 1;
        $mayor = DB::table('categorias')->orderBy('updated_at', 'desc')->first(); // obtiene la ultima 



        while ($numero <= $mayor->id) {
            $checked = 'checkboxCustom' . $numero;
            $checkBox = Input::get((string) $checked);
            if ($checkBox != null) {
                $eventoCategoria = new eventoCategoria();
                $eventoCategoria->evento_id = $evento->id;
                $eventoCategoria->categoria_id = $checkBox;
                $eventoCategoria->save();
            }
            $numero++;
        }
//        $numero2 = 0;
        $numero2 = Input::get('totalEntrada');
        $no = 'name' . $numero2;
        $nombre = Input::get((string) $no);

//        foreach ($objEntra as $id) {
//            Entrada::where('evento_id', $id->evento_id)->delete();
//        }


        while (!empty($nombre)) {
            $entrada = new Entrada();
            $n = ('name' . $numero2);
            $entrada->nombre = Input::get((string) $n);
            $entrada->precio = Input::get('precio' . $numero2);
            $entrada->cantidad = Input::get('cantidad' . $numero2);
            $entrada->evento_id = $evento->id;
            $entrada->save();
            $numero2++;
            $nombre = Input::get(('name' . $numero2));
        }
        //        $objEntra = Entrada::where('evento_id', '=', Input::get('EventoID'))->get();


        return Redirect::to('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento) {
        //
    }

}
