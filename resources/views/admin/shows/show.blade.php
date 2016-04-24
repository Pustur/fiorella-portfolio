@extends('admin', [$title = $show->title])

@section('meta')
	<link rel="stylesheet" href="/css/sweetalert.min.css">
@stop

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'),       'text' => 'Sezione amministrativa'],
		['link' => route('admin.shows.index'), 'text' => 'Esposizioni'],
		['link' => '',                         'text' => $show->title]
	])

	<hr>

	<h3>{{ $show->title }}</h3>
	<p><b>Luogo:</b> {{ $show->place }}</p>
	<p><b>Data:</b> {{ date_create_from_format('Y-m-d', $show->date)->format('d/m/Y') }}</p>

	<hr>

	<div class="timestamps">
		<p>Creato: {{ $show->created_at->format('d/m/Y H:i:s') }} <em>({{ $show->created_at->diffForHumans() }})</em></p>
		@if($show->created_at != $show->updated_at)
			<p>Aggiornato: {{ $show->updated_at->format('d/m/Y H:i:s') }} <em>({{ $show->updated_at->diffForHumans() }})</em></p>
		@endif
	</div>

	<hr>

	<a class="button" href="{{ route('admin.shows.edit', $show->slug) }}">Modifica</a>
	{!! Form::open(['method' => 'DELETE', 'route' => ['admin.shows.destroy', $show->slug], 'class' => 'inline', 'id' => 'delete-form']); !!}
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
