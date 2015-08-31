@extends('admin', [$title = "Modifica lavoro"])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'),                   'text' => 'Sezione amministrativa'],
		['link' => route('admin.works.index'),             'text' => 'Lavori'],
		['link' => route('admin.works.show', $work->slug), 'text' => $work->title],
		['link' => '',                                     'text' => 'Modifica']
	])

	<hr>

	<h3>Modifica lavoro</h3>
	{!! Form::model($work, ['method' => 'PATCH', 'route' => ['admin.works.update', $work->slug], 'files' => true]) !!}
		@include('partials.form-works')
	{!! Form::close() !!}

	@include('partials.errors')
@stop

@section('footer')
	<script src="/js/app.min.js"></script>
	<script>
		$('#select2').select2({
			tags: true
		});
	</script>
@stop
