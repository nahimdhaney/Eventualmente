<?php

namespace App\Http\Controllers;

use App\Registro;
use App\Evento;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    public function crear(Request $request) {
        if (empty(Auth::id())) {
            return redirect('login');
        }


        $numero2 = 0; // comienzo
        $no = 'escogido' . $numero2; 
        $idEntrada = Input::get((string) $no);// el ID de la entrada
        $total = Input::get('total'); // maximo
        while ($numero2 < $total) {
            if (!empty($idEntrada)) {
//                $entrada = new Entrada();
//                $n = ('name' . $numero2);
//                $entrada->nombre = Input::get((string) $n);
//                $entrada->precio = Input::get('precio' . $numero2);
//                $entrada->cantidad = Input::get('cantidad' . $numero2);
//                $entrada->evento_id = $evento->id;
//                $entrada->save();
//                
                $registro = new Registro();
                $registro->evento_id = Input::get('idEvento');
                $registro->usuario_id = Auth::id();
//                $registro->entrada_id = Input::get($no);
                $registro->entrada_id = $idEntrada;
                $registro->cantidad = Input::get('CantidadCompra' .$numero2 );
                                                               // CantidadCompra
                $registro->pagado = 0;
                $registro->asistido = 0;
//        return $registro;
                $registro->save();
            }
            $numero2++;
            $idEntrada = Input::get(('escogido' . $numero2));
        }
//        $registro = new Registro();
//        $registro->evento_id = Input::get('idEvento');
//        $registro->usuario_id = Auth::id();
//        $registro->entrada_id = Input::get('escogido');
//        $registro->pagado = 0;
//        $registro->asistido = 0;
////        return $registro;
//        $registro->save();
        return Redirect::to('/');
        //        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
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
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro $registro) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro $registro) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro $registro) {
        //
    }

}
