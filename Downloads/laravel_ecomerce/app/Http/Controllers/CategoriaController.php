<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;

use App\Produto;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        $categorias = Categoria::orderBy('id', 'ASC')->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            if((Auth::id())==1){
                return view('categorias.create');
            }else{
                return view('auth/login');
            }
        }else{
            return view('auth/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required',
            'imagem_capa' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $request->imagem_capa->extension();
 
        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        $path = Storage::putFileAs('img-categoria', $request->file('imagem_capa'), $nameFile);

        $insert = array();

        $insert['nome'] = $request->input('nome');
        $insert['descricao'] = $request->input('descricao');
        $insert['imagem_capa'] = "$nameFile";

        $categoria = Categoria::create($insert);
        return redirect('/categorias')->with('success', 'Categoria cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        $produtos = Produto::all()->where('categoria_id', $id);

        return view('categorias.show', compact('categoria'), compact('produtos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
            if((Auth::id())==1){
                $categoria = Categoria::findOrFail($id);

                return view('categorias.edit', compact('categoria'));
            }else{
                return view('auth/login');
            }
        }else{
            return view('auth/login');
        }
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
        $validatedData = $request->validate([
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required',
        ]);
        $insert = array();

        $insert['nome'] = $request->input('nome');
        $insert['descricao'] = $request->input('descricao');

        Categoria::whereId($id)->update($insert);
        return redirect('/categorias')->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if(Auth::check()){
            if((Auth::id())==1){
                $categoria = Categoria::findOrFail($id);

                $produtos = Produto::all()->where('categoria_id', $id);

                foreach($produtos as $produto){
                    $deletar = Produto::findOrFail($produto->id);
                    $image = str_replace(' ', '', $deletar->image);
                    Storage::disk('public')->delete('img-produto/'.$image);
                    $deletar->delete();
                }
                $img = str_replace(' ', '', $categoria->imagem_capa);
                Storage::disk('public')->delete('img-categoria/'.$img);
                $categoria->delete();

                return redirect('/categorias')->with('success', 'Categoria deletada com sucesso.');
            }
        }
    }
}
