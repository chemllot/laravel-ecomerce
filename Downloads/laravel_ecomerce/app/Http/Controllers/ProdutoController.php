<?php

namespace App\Http\Controllers;

use App\Produto;

use App\Categoria;

use App\Carrinho;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use File;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::orderBy('id', 'ASC')->get();

        $produtos = Produto::all()->where('destaque', 1);

        foreach ($produtos as $produto){
            $str = $produto->descricao;
            if(strlen($str)>=39){
                $newstr = substr($str, 0, 39);
                $produto->descricao = $newstr.'...';
            }
        }

        return view('index', compact('produtos'));
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
                $categorias = Categoria::all();
                return view('create', compact('categorias'));
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
        $categoria_id = $request->input('categoria_id');

        $validatedData = $request->validate([
            'titulo' => 'required|min:3|max:120',
            'descricao' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'preco' => 'required',
            'categoria_id' => 'required',
        ]);
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $request->image->extension();
 
        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        $path = Storage::putFileAs('img-produto', $request->file('image'), $nameFile);

        $insert = array();

        $insert['categoria_id'] = $categoria_id;
        $insert['titulo'] = $request->input('titulo');
        $insert['descricao'] = $request->input('descricao');
        $insert['image'] = "$nameFile";
        $insert['preco'] =  $request->input('preco');
        if(($request->destaque)==true){
            $insert['destaque'] = true;
        }else{
            $insert['destaque'] = false;
        }

        $produto = Produto::create($insert);
        return redirect('/')->with('success', 'Produto cadastrado com sucesso.');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        return view('show', compact('produto'));
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
                $produto = Produto::findOrFail($id);

                $categorias = Categoria::all();

                return view('edit', compact('produto'), compact('categorias'));
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
        if(Auth::check()){
            if((Auth::id())==1){
                $categoria_id = $request->input('categoria_id');
                $validatedData = $request->validate([
                    'titulo' => 'required|min:3|max:120',
                    'descricao' => 'required',
                    'preco' => 'required',
                    'categoria_id' => 'required'
                ]);
                $insert['categoria_id'] = $categoria_id;
                $insert['titulo'] = $request->input('titulo');
                $insert['descricao'] = $request->input('descricao');
                $insert['preco'] =  $request->input('preco');
                if(($request->destaque)==true){
                    $insert['destaque'] = true;
                }else{
                    $insert['destaque'] = false;
                }
                Produto::whereId($id)->update($insert);
                return redirect('/')->with('success', 'Produto atualizado com sucesso.');
            }
        }
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
                $produto = Produto::findOrFail($id);
                $image = str_replace(' ', '', $produto->image);
                Storage::disk('public')->delete('img-produto/'.$image);

                $carrinhoItens = Carrinho::all()->where('produto_id', $produto->id);

                foreach($carrinhoItens as $carrinhoIten){
                    $deletar = Carrinho::findOrFail($carrinhoIten->id);
                    $deletar->delete();
                }
                $produto->delete();

                return redirect('/')->with('success', 'Produto deletado com sucesso.');
            }else{
                return view('auth/login');
            }
        }else{
            return view('auth/login');
        }
    }
}