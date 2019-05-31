@extends('layouts.form')

@section('content')
<body class='bg-img'>
<div class="create-auth container">
    <div class="row">
        <form class="col s12" action="{{ route('login') }}" method="post">
            <h5 class='titulo-form center-align'>Login de Usuários</h5>
            <div class="row">
                @csrf
                <div class="input-field col s12">
                    <input placeholder="ex: pessoa@email.com" id="email" name="email" class="validate" required value="{{ old('email') }}" type='email'>
                    <label for="email">Email</label>
                    @if ($errors->has('email'))
                        <span class="helper-text red-text">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" class="validate" required type='password' placeho>
                    <label for="password">Senha</label>
                    @if ($errors->has('password'))
                        <span class="helper-text red-text">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="row center-align">
                <button type="submit" class="btn btn-primary">Logar</button>
            </div>
        </form>
    </div>
</div>
@endsection
