@extends('admin', [$title = "Modifica esposizione"])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'),                   'text' => 'Sezione amministrativa'],
		['link' => route('admin.shows.index'),             'text' => 'Esposizioni'],
		['link' => route('admin.shows.show', $show->slug), 'text' => $show->title],
		['link' => '',                                     'text' => 'Modifica']
	])

	<hr>

	<h3>Modifica esposizione</h3>
	{!! Form::model($show, ['method' => 'PATCH', 'route' => ['admin.shows.update', $show->slug]]) !!}
		@include('partials.form-shows')
	{!! Form::close() !!}

	@include('partials.errors')
@stop
