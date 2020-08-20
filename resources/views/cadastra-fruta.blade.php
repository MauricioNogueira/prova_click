@extends('template')

@section('title', 'Cadastrar Frutas')

@section('content')
    <div class="container">
        <div class="title-page">
            <h1>Cadastro</h1>
        </div>
        
        <div>
            {!! Form::open(['route' => 'fruta.store']) !!}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('exception'))
                    <div class="alert alert-danger">
                        {{ session('exception') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('nome', 'Nome') !!}
                            {!! Form::text('nome', old('nome'), ['class' => 'form-control', 'id' => 'nome']); !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('quantidade', 'Quantidade') !!}
                            {!! Form::number('quantidade', old('quantidade'), ['class' => 'form-control', 'id' => 'quantidade']); !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('data_validade', 'Data de validade') !!}
                            {!! Form::date('data_validade', old('data_validade'), ['class' => 'form-control', 'id' => 'data_validade']); !!}
                        </div>
                    </div>
                </div>

                {!! Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'botao-salvar']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection