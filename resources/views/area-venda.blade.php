@extends('template')

@section('title', 'Área de venda')

@section('content')
    <div class="container">
        <div class="title-page">
            <h1>Venda</h1>
        </div>

        <div>
            {!! Form::open(['route' => 'venda.store']) !!}
            {!! Form::close() !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::label('fruta', 'Nome da fruta') !!}
                <select2 route="{{ route('fruta.list') }}" id="fruta" name="fruta"></select2>
            </div>
        </div>
    </div>
@endsection