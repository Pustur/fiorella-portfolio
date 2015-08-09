@extends('master')

@section('content')
	<h1>Pagina non trovata :(</h1>
	<p>La pagina che hai cercato non esiste</p>
	<a href="{{ URL::previous() }}">Torna alla pagina precedente</a> oppure <a href="{{ route('home') }}">Vai alla home</a>
@stop
