@extends('master', [$title = 'Home'])

@section('content')
    <header class="header">
        <div class="container">
            <h1 class="home-title">Fiorella's Website</h1>
        </div>
    </header>
    <section class="gallery">
        @if($works->count())
            @if(count($usedTechniques) > 1)
                <div class="filters container">
                    <button class="filter" data-filter="all">Tutti</button>
                    @foreach($usedTechniques as $technique)
                        <button class="filter" data-filter=".technique-{{ $technique->id }}">{{ $technique->name }}</button>
                    @endforeach
                </div>
            @endif
            <div id="container" class="clearfix container" data-columns>
                @foreach($works as $i => $work)
                    <a class="work technique-{{ $work->technique->id }}" href="#" data-featherlight="#lightbox-{{ $i }}">
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
    <section class="about">
        <div class="container">
            <h2>Su di me</h2>
            <div class="about-me">
                <div class="portrait">
                    <img class="img-responsive" src="//placehold.it/400x400" alt="Ritratto Fiorella">
                </div>
                <div class="biography">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam doloremque veniam, ratione quas dolorem vero modi, sequi laudantium blanditiis amet porro consequatur. Doloremque quia maxime quibusdam numquam distinctio modi asperiores.</p>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    <script src="/js/salvattore.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/featherlight.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
    <script>
        $('#container').mixItUp({
            selectors: {
                target: '.work'
            },
            layout: {
                display: 'block'
            }
        });
    </script>
@stop
