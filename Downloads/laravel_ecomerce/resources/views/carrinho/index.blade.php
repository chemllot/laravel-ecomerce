@extends('layouts.page')
@section('content')
<div class="row">
    <div class='container'>
        <h4>Produtos</h4>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->titulo}}</td>
                        <td>{{$produto->descricao}}</td>
                        <td id="texto">{{$produto->preco}}</td>
                        <td>
                            <form action="{{ route('carrinho.destroy', $produto->id)}}" method="post" class="excluir">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger red" type="submit">Remover</button>
                            </form>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
        <br><br>
        <br><br>
    </div>
</div>
@endsection