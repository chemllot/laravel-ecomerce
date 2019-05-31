@extends('layouts.form')

@section('content')
<body class='bg-img'>
<br>
<div class="create-product container">
    <div class="row">
        <form class="col s12" action="{{ route('categorias.update', $categoria->id) }}" method="post">
            <h5 class='titulo-form center-align'>Cadastro de Categorias</h5>
            <div class="row">
                @csrf
                @method('PATCH')
                <div class="input-field col s12">
                    <input placeholder=" " type="text" id="nome" type="text" class="validate" name="nome" value="{{ $categoria->nome }}" required>
                    <label for="nome">Nome da Categoria</label>
                    @if ($errors->has('nome'))
                        <span class="helper-text red-text">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder=" " id="descricao" name="descricao" class="materialize-textarea" required>{{ $categoria->descricao }}</textarea>
                    <label for="descricao" class='text-area'>Descrição da Categoria</label>
                    @if ($errors->has('descricao'))
                        <span class="helper-text red-text">{{ $errors->first('decricao') }}</span>
                    @endif
                </div>
            </div>
            <div class="row center-align">
                <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
            </div>
        </form>
    </div>
</div>
@endsection