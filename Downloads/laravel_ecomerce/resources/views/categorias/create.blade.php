@extends('layouts.form')
@section('content')
<body class='bg-img'>
<br>
<div class="create-product container">
    <div class="row">
        <form class="col s12" action="{{ route('categorias.store') }}" method="post" enctype="multipart/form-data">
            <h5 class='titulo-form center-align'>Cadastro de Categorias</h5>
            <div class="row">
                @csrf
                <div class="input-field col s12">
                    <input placeholder=" " type="text" id="nome" type="text" class="validate" name="nome" value="{{ old('nome') }}" required>
                    <label for="nome">Nome da Categoria</label>
                    @if ($errors->has('nome'))
                        <span class="helper-text red-text">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder=" " id="descricao" name="descricao" class="materialize-textarea" required>{{ old('descricao') }}</textarea>
                    <label for="descricao" class='text-area'>Descrição da Categoria</label>
                    @if ($errors->has('descricao'))
                        <span class="helper-text red-text">{{ $errors->first('decricao') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Imagem de Capa</span>
                        <input type="file" name="imagem_capa">
                        @if ($errors->has('imagem_capa'))
                            <span class="helper-text red-text">{{ $errors->first('imagem_capa') }}</span>
                        @endif
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            <div class="row center-align">
                <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
            </div>
                
        </form>
    </div>
        
</div>
@endsection