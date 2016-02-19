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
            @else
                <div class="spacer"></div>
            @endif
            <div id="container" class="container gallery-container">
                @foreach($works as $i => $work)
                    <a class="work technique-{{ $work->technique->id }}" href="#" data-featherlight="#lightbox-{{ $i }}" style="background-image: url(/img/works/thumbnail-{{ $work->image }});">
                        <div class="work-overlay">
                            <h2>{{ $work->title }}</h2>
                            <div>{{ $work->technique->name }}</div>
                        </div>
                    </a>
                @endforeach
                @if(count($works)%3-2 == 0)
                    <div class="gap"></div>
                @endif
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
                    <p>Sin dai tempi della scuola amavo disegnare e i lavori di bricolage mi stimolavano l’estro creativo.<br><br>
Frequentai poi diversi corsi: pittura su porcellana e su seta, mosaico, modellaggio della ceramica e creazione di gioielli in argento.<br>
Decisi poi di provare la pittura su tela e così seguii dei corsi di pittura ad olio presso alcuni artisti ticinesi.<br><br>
Pur prediligendo la pittura ad olio, con gli anni ho sperimentato anche altre tecniche ed altri materiali.</p>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/featherlight.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
    <script>
        $('#container').mixItUp({
            selectors: {
                target: '.work'
            },
            layout: {
                display: 'inline-block'
            }
        });
    </script>
@stop
