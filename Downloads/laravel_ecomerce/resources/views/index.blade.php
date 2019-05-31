@extends('layouts.home')

@section('content')

<body>
<section class='banner'>
    <div class="slider">
        <ul class="slides" style="height='500px';">
            <li>
                <img src="{{ asset('img/banner1.jpg') }}">
            </li>
            <li>
                <img src="{{ asset('img/banner2.jpg') }}">
            </li>
            <li>
                <img src="{{ asset('img/banner3.jpg') }}">
            </li>
            <li>
                <img src="{{ asset('img/banner4.jpg') }}">
            </li>
        </ul>
    </div>    
</section>
<section class='produtos'>
    <div class="row">
        <h4 class="center-align">Confira nossos destaques</h4>
        <br>
        <div class="col s12">
            @if(session()->get('success'))
                <div id="msg" class="msg msg-sucess">
                <span id="close" class="close">&times;</span>
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @foreach($produtos as $produto)
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ url('storage/img-produto/'.$produto->image) }}" width="160" height="240">
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ $produto->titulo }}</span>
                        <p>{{ $produto->descricao }}</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('produtos.show', $produto->id) }}" class='waves-effect waves-light btn light-green darken-2'>R${{ $produto->preco }}</a>
                    @if(Auth::check())
                        @if((Auth::id())==1)
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id)}}" method="post" class="excluir">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger red" type="submit" onclick="return confirm('Confirma a exclusão permanente do produto?')">Excluir</button>
                        </form>
                        <br>
                        @endif
                    @endif
                    <form action="{{ route('carrinho.store')}}" method="post" class="carrinho">
                            @csrf
                            @method('POST')
                            <input type="hidden" name='id' value="{{ $produto->id }}">
                            <button id="mar" class="btn blue" type="submit">Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(Auth::check())
    @if((Auth::id())==1)
    <div class="row center-align">
        <a class='butao waves-effect waves-light btn light-green darken-2' href="produtos/create">Cadastrar um produto</a>
    </div>
    @endif
    @endif
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</section>
<script>
    var fecha = document.getElementById("close");
    var div = document.getElementById("msg");
    fecha.onclick = function(){
        div.style.display = "none";
    }
</script>
@endsection