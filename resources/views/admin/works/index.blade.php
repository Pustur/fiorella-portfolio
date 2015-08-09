@extends('master', [$title = "Tutti i lavori"])

@section('content')
	@if($works->count())
		<ul>
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
	<a href="{{ route('admin.works.create') }}">Aggiungi nuovo lavoro</a>
@stop
