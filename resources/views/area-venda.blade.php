@extends('template')

@section('title', 'Área de venda')

@section('content')
    <div class="container">
        <div class="title-page">
            <h1>Venda</h1>
        </div>
        
        <div>
            <select2 route="{{ route('fruta.list') }}" id="fruta" name="fruta"></select2>
        </div>
    </div>
@endsection