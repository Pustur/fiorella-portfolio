@extends('master', [$title = "Crea nuovo lavoro"])

@section('content')
	{!! Form::open(['route' => 'admin.works.store']) !!}
		@include('partials.form-works')
	{!! Form::close() !!}

	@include('partials.errors')
@stop
