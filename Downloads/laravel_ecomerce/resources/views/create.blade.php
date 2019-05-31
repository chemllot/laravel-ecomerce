@extends('layouts.form')

@section('content')
<body class='bg-img'>
<br>
<div class="create-product container">
    <div class="row">
        <form class="col s12" action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data">
            <h5 class='titulo-form center-align'>Cadastro de Produtos</h5>
            <div class="row">
                @csrf
                <div class="input-field col s12">
                    <input placeholder="Ex: Bolo Vegano" type="text" id="titulo" type="text" class="validate" name="titulo" value="{{ old('titulo') }}" required>
                    <label for="titulo">Título do Produto</label>
                    @if ($errors->has('titulo'))
                        <span class="helper-text red-text">{{ $errors->first('titulo') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder="Bolo vegano natural sem farinha" id="descricao" name="descricao" class="materialize-textarea" required>{{ old('descricao') }}</textarea>
                    <label for="descricao" class='text-area'>Descrição do Produto</label>
                    @if ($errors->has('descricao'))
                        <span class="helper-text red-text">{{ $errors->first('descricao') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Imagem do Produto</span>
                        <input type="file" name="image">
                        @if ($errors->has('image'))
                            <span class="helper-text red-text">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Ex: 4,60" id="preco" type="text" class="validate" name="preco" value="{{ old('preco') }}" required>
                    <label for="preco">Preço em R$</label>
                    @if ($errors->has('preco'))
                        <span class="helper-text red-text">{{ $errors->first('preco') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="categoria_id">
                        <option value="" disabled selected>Escolha uma categoria</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                    <label for="categoria_id">Categorias</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <p>
                        <label id="destaque">
                            <input type="checkbox" class="filled-in" name="destaque"/>
                            <span>Produto em destaque</span>
                        </label>
                    </p>
                </div>
            </div>
            <div class="row center-align">
                <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
            </div>
        </form>
    </div>
</div>
@endsection 