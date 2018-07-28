<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $listaCategorias = Categoria::all()->toArray();
        return view('categorias', compact('listaCategorias'));
    }

    
    public function verCategoria($id) {
//        $listaEntradas = Evento::where('evento_id', Auth::id())->get();
        
        $lista = DB::table('eventos')
            ->join('evento_categorias', 'eventos.id', '=', 'evento_categorias.evento_id')
            ->where('evento_categorias.categoria_id', '=', $id)
            ->select('eventos.*')
            ->get();
        $listaEventos = json_decode($lista, true);
//select e.* from eventos e
//join evento_categorias c 
//where c.evento_id = e.id
//and c.categoria_id = '1'        
        
//        return view('verEvento', compact('objevento'));
        return view('verCategoria', compact('listaEventos'));
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
