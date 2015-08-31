@extends('admin', [$title = 'Tutti i lavori'])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'), 'text' => 'Sezione amministrativa'],
		['link' => '',                   'text' => 'Lavori']
	])

	<hr>

	<h3>Tutti i lavori</h3>
	@if($works->count())
		<ul class="admin-list">
			@foreach($works as $work)
				<li>
					<a href="{{ route('admin.works.show', $work->slug) }}">{{ $work->title }}</a>
				</li>
			@endforeach
		</ul>
	@else
		<p>Nessun lavoro da mostrare.</p>
	@endif

	<hr>

	<a class="button button-primary" href="{{ route('admin.works.create') }}">Aggiungi nuovo lavoro</a>
@stop
