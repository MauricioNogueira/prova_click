@extends('template')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="title-page">
            <h1>Dashboard</h1>
        </div>

        <dashboard route-total-ganho="{{ route('venda.receita') }}" fruit-route="{{ route('fruta.list') }}"></dashboard>
    </div>
@endsection
