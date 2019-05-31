@extends('layouts.page')

@section('content')

<body>
<section class='produtos'>
    <div class="row">
        <h4 class="center-align">Categorias</h4>
        <br>
        <div class="col s12">
            @if(session()->get('success'))
                <div id="msg" class="msg msg-sucess">
                <span id="close" class="close">&times;</span>
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @foreach($categorias as $categoria)
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ url('storage/img-categoria/'.$categoria->imagem_capa) }}" width="160" height="240">
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ $categoria->nome }}</span>
                        <p>{{ $categoria->descricao }}</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('categorias.show', $categoria->id) }}" class='waves-effect waves-light btn light-green darken-2'>Mais</a>
                    @if(Auth::check())
                        @if((Auth::id())==1)
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post" class="excluir">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger red" type="submit" onclick="return confirm('Tem certeza? isso vai excluir todos os produtos dessa categoria.')">Excluir</button>
                        </form>
                        @endif
                    @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(Auth::check())
    @if((Auth::id())==1)
    <div class="row center-align">
        <a class='butao waves-effect waves-light btn light-green darken-2' href="categorias/create">Cadastrar uma categoria</a>
    </div>
    @endif
    @endif
</section>
<script>
    var fecha = document.getElementById("close");
    var div = document.getElementById("msg");
    fecha.onclick = function(){
        div.style.display = "none";
    }
</script>
@endsection