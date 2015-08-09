@extends('master', [$title = "Modifica " . $work->title])

@section('content')
	{!! Form::model($work, ['method' => 'PATCH', 'route' => ['admin.works.update', $work->slug]]) !!}
		@include('partials.form-works')
	{!! Form::close() !!}

	@include('partials.errors')
@stop
