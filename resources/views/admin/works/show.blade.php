@extends('admin', [$title = $work->title])

@section('meta')
	<link rel="stylesheet" href="/css/sweetalert.min.css">
@stop

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
	<a href="/img/lavori/{{ $work->image }}">
		<img class="img-responsive" src="/img/lavori/thumbnail-{{ $work->image }}" alt="{{ $work->title }}">
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
	{!! Form::open(['method' => 'DELETE', 'route' => ['admin.works.destroy', $work->slug], 'class' => 'inline', 'id' => 'delete-form']); !!}
	{!! Form::submit('Elimina', ['class' => 'button button-danger', 'onclick' => 'return deleteElement();']); !!}
	{!! Form::close(); !!}
@stop

@section('footer')
	<script src="/js/sweetalert.min.js"></script>
	<script>
		function deleteElement(){
			swal({
				title: 'Sei sicuro?',
				text: 'Una volta eliminato questo elemento non sarà possibile recuperarlo!',
				type: 'warning',
				showCancelButton: true,
				cancelButtonText: 'Indietro',
				confirmButtonColor: '#b94744',
				confirmButtonText: 'Sì, eliminalo'
			}, function(){
				document.getElementById('delete-form').submit();
			});
			return false;
		}
	</script>
@stop
