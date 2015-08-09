@extends('master', [$title = $work->title])

@section('content')
	<a href="{{ route('admin.works.index') }}">Torna a tutti i lavori</a>
	<h1>{{ $work->title }}</h1>
	<p>{!! nl2br(e($work->body)) !!}</p>
	<strong>{{ $work->image }}</strong>
	<hr>
	<div style="font-family: monospace;">
		<p>Created: {{ $work->created_at->format('d/m/Y H:i:s') }} <em>({{ $work->created_at->diffForHumans() }})</em></p>
		@if($work->created_at != $work->updated_at)
			<p>Updated: {{ $work->updated_at->format('d/m/Y H:i:s') }} <em>({{ $work->updated_at->diffForHumans() }})</em></p>
		@endif
	</div>
	<hr>
	<a href="{{ route('admin.works.edit', $work->slug) }}">Modifica</a>
	{!! Form::open(['method' => 'DELETE', 'route' => ['admin.works.destroy', $work->slug]]); !!}
	{!! Form::submit('Elimina'); !!}
	{!! Form::close(); !!}
@stop
