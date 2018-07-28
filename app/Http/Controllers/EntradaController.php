<?php

namespace App\Http\Controllers;

use App\Entrada;
use App\Evento;
use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use Redirect;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $listaEventos = Evento::all()->orderBy('fechaInicio')->toArray();
        $listaEventos = Evento::orderBy('fechaInicio','desc')->get();
        return view('home', compact('listaEventos'));
    }
    
    public function eliminar() {
        $objRegistro = Registro::where([
                    ['evento_id', '=',Input::get('idEvento')],
                    ['usuario_id', '=', Auth::id()]])->first();
        Registro::destroy($objRegistro->id);
//        $objRegistro->de
        $listaEventos = Evento::all()->toArray();
        return Redirect::to('/');
    }

    
    public function pagar()
    {
        //
        $lista = Input::get('datos');
        foreach($lista as $dato) {
    // do stuff
            $checked = 'pagada' . $dato;
            $Ispagada = Input::get((string) $checked);
            if ($Ispagada != null) {
                $registro =  Registro::where('id',$dato) -> first();
                $registro->pagado = 1;
                $registro->save();
            }
            $asistida = 'asistida' . $dato;
            $isAsistida = Input::get((string) $asistida);
            if ($isAsistida != null) {
                $registro2 =  Registro::where('id',$dato) -> first();
                $registro2->asistido = 1;                
                $registro2->save();
            }
        }
        
        return Redirect::to('/');
    }
    
    public function gestionarEvento($id)
    {
        
// TODO hace este query para ver la tabla
//        select asistido, pagado, users.nombre, users.apellido, 
//        entradas.nombre, entradas.precio, entradas.cantidad from registros
//        join users on registros.usuario_id = users.id
//        join entradas on registros.entrada_id = entradas.id;         
            $lista = DB::table('registros')
            ->join('users', 'registros.usuario_id', '=', 'users.id')
            ->join('entradas', 'registros.entrada_id', '=', 'entradas.id')
            ->where('registros.evento_id', '=', $id)
            ->select('asistido', 'registros.id as id','registros.cantidad as cantidadComprada', 'pagado', 'users.nombre as usuarioNombre', 'users.apellido as apellido', 'entradas.nombre as entradaNombre', 'entradas.precio as precio', 'entradas.cantidad as cantidad')
            ->get();
        $listaEntradas = json_decode($lista, true);
//        $listaEntradas = Evento::all()->toArray();
        return view('gestionarEvento', compact('listaEntradas'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
