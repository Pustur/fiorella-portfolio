@extends('admin', [$title = "Aggiungi nuova esposizione"])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'),       'text' => 'Sezione amministrativa'],
		['link' => route('admin.shows.index'), 'text' => 'Esposizioni'],
		['link' => '',                         'text' => 'Aggiungi nuova esposizione']
	])

	<hr>

	<h3>Aggiungi nuova esposizione</h3>
	{!! Form::open(['route' => 'admin.shows.store']) !!}
		@include('partials.form-shows')
	{!! Form::close() !!}

	@include('partials.errors')
@stop
