@extends('admin', [$title = 'Tutte le esposizioni'])

@section('content')
	@include('partials.breadcrumbs', $breadcrumbs = [
		['link' => route('admin.index'), 'text' => 'Sezione amministrativa'],
		['link' => '',                   'text' => 'Esposizioni']
	])

	<hr>

	<h3>Tutte le esposizioni</h3>
	@if($shows->count())
		<ul class="admin-list">
			@foreach($shows as $show)
				<li>
					<a href="{{ route('admin.shows.show', $show->slug) }}">{{ $show->title }}</a>
				</li>
			@endforeach
		</ul>
	@else
		<p>Nessuna esposizione da mostrare.</p>
	@endif

	<hr>

	<a class="button button-primary" href="{{ route('admin.shows.create') }}">Aggiungi nuova esposizione</a>
@stop
