@extends('layouts.page')
@section('content')
<body style="background: rgb(249, 249, 249);">
            @if(session()->get('success'))
                <div class="msg msg-sucess">
                    {{ session()->get('success') }}
                </div>
            @endif
            </div>
    <div class="row box-product">
            <div class="col s12 m6 left-align img-show">
                <img class="responsive-img materialboxed" width="300" height="370" src="{{ asset('storage/img-produto/'.$produto->image) }}">
            </div>
            <div class="col s12 m6 right-align show-product">
                <h4 class='center-align'>{{ $produto->titulo }}</h4><br>
                <span>{{ $produto->descricao }}</span>
                <h5 class='center-align'>Valor </h5>
                <span class="preco"> R${{ $produto->preco }}</span><br><br>
                <button id="mar" class="btn blue" type="submit">Comprar</button>
            </div>
    </div>
@endsection
