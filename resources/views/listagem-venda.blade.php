@extends('template')

@section('title', 'Listagem de vendas')

@section('content')
    <div class="container">
        <div class="title-page">
            <h1>Lista de vendas</h1>
        </div>

        <listagem route="{{ route('venda.vendidos') }}"></listagem>
    </div>
@endsection
