@extends('master', [$title = 'Home'])

@section('content')
    <header>
        <div class="container">
            <h1 class="home-title">Fiorella's Website</h1>
        </div>
    </header>
    <section class="gallery">
        @if($works->count())
            <div class="clearfix container" data-columns>
                @foreach($works as $i => $work)
                    <a class="work" href="#" data-featherlight="#lightbox-{{ $i }}">
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
    <section class="lightboxes">
        @foreach($works as $i => $work)
            <div id="lightbox-{{ $i }}">
                <a href="/img/works/{{ $work->image }}" target="_blank">
                    <img src="/img/works/{{ $work->image }}" alt="{{ $work->title }}">
                </a>
                <h2>{{ $work->title }}</h2>
                <p>Tecnica usata: <strong>{{ $work->technique->name }}</strong></p>
                <p>Dimensioni: <strong>{{ $work->size }}</strong></p>
            </div>
        @endforeach
    </section>
@stop

@section('footer')
    <script src="/js/salvattore.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/featherlight.min.js"></script>
@stop
