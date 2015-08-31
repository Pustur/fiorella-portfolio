@extends('admin', [$title = $work->title])

@section('content')
@include('partials.breadcrumbs', $breadcrumbs = [
	['link' => route('admin.index'),       'text' => 'Sezione amministrativa'],
	['link' => route('admin.works.index'), 'text' => 'Lavori'],
	['link' => '',                         'text' => $work->title]
])

	<hr>

	<h3>{{ $work->title }}</h3>
	<p><b>Dimensioni:</b> {{ $work->size }}</p>
	<p><b>Tecnica:</b> {{ $work->technique->name }}</p>
	<a href="http://lorempixel.com/1000/750">
		<img class="full-width" src="http://lorempixel.com/1000/400" alt="image">
	</a>

	<hr>

	<div class="timestamps">
		<p>Creato: {{ $work->created_at->format('d/m/Y H:i:s') }} <em>({{ $work->created_at->diffForHumans() }})</em></p>
		@if($work->created_at != $work->updated_at)
			<p>Aggiornato: {{ $work->updated_at->format('d/m/Y H:i:s') }} <em>({{ $work->updated_at->diffForHumans() }})</em></p>
		@endif
	</div>

	<hr>

	<a class="button" href="{{ route('admin.works.edit', $work->slug) }}">Modifica</a>
	{!! Form::open(['method' => 'DELETE', 'route' => ['admin.works.destroy', $work->slug], 'class' => 'inline', 'onsubmit' => 'return confirm("Sei sicuro di voler eliminare questo elemento?");']); !!}
	{!! Form::submit('Elimina', ['class' => 'button button-danger']); !!}
	{!! Form::close(); !!}
@stop
