@extends('master', [$title = 'Home'])

@section('content')
    <div class="container">
        <h1 class="home-title">Fiorella's Website</h1>
    </div>
    <section class="gallery">
        @if($works->count())
            <div class="clearfix container" data-columns>
                @foreach($works as $work)
                    <a class="work" href="#">
                        <img src="/img/works/thumbnail-{{ $work->image }}" alt="{{ $work->title }}">
                        <div class="work-overlay">
                            <h2>{{ $work->title }}</h2>
                            <div>{{ $work->technique->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="no-margin text-center">Spiacenti, nessun lavoro trovato :(</p>
        @endif
    </section>
@stop

@section('footer')
    <script src="/js/salvattore.min.js"></script>
@stop
