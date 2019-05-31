<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Carrinho;

use App\Produto;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Carrinho::orderBy('id', 'ASC')->get();

        $produtos = Carrinho::all();

        return view('carrinho/index', compact('produtos'));
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
        $produto = Produto::findOrfail($request->input('id'));

        $insert['titulo'] = $produto->titulo;
        $insert['descricao'] = $produto->descricao;
        $insert['preco'] = $produto->preco;
        $insert['produto_id'] = $produto->id;

        $carrinho = Carrinho::create($insert);

        return redirect('/carrinho')->with('success', 'Produto Adicionado ao carrinho.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Carrinho::findOrFail($id);
        $produto->delete();

        return redirect('/carrinho')->with('success', 'Produto deletado do carrinho.');
    }
}
