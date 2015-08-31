@extends('admin', [$title = "Aggiungi nuovo lavoro"])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'),       'text' => 'Sezione amministrativa'],
		['link' => route('admin.works.index'), 'text' => 'Lavori'],
		['link' => '',                         'text' => 'Aggiungi nuovo lavoro']
	])

	<hr>

	<h3>Aggiungi nuovo lavoro</h3>
	{!! Form::open(['route' => 'admin.works.store', 'files' => true]) !!}
		@include('partials.form-works')
	{!! Form::close() !!}

	@include('partials.errors')
@stop

@section('footer')
	<script>
		$('#select2').select2({
			tags: true
		});
	</script>
@stop
