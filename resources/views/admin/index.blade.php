@extends('admin')

@section('content')
    <h3>Sezione amministrativa</h3>

    <hr>

    <p>Seleziona una sezione da gestire</p>
    <a class="button button-primary" href="{{ route('admin.works.index') }}">Lavori</a>
    <a class="button button-primary" href="{{ route('admin.shows.index') }}">Esposizioni</a>
@stop
