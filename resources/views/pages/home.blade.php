<?php
    // Man this is lazy and non-laravel as fuck but i'm in a hurry...

    function monthToStr($num) {
        $num = intval($num);

        switch ($num) {
            case 1:
                $num = 'Gen';
                break;
            case 2:
                $num = 'Feb';
                break;
            case 3:
                $num = 'Mar';
                break;
            case 4:
                $num = 'Apr';
                break;
            case 5:
                $num = 'Mag';
                break;
            case 6:
                $num = 'Giu';
                break;
            case 7:
                $num = 'Lug';
                break;
            case 8:
                $num = 'Ago';
                break;
            case 9:
                $num = 'Sett';
                break;
            case 10:
                $num = 'Ott';
                break;
            case 11:
                $num = 'Nov';
                break;

            default:
                $num = 'Dic';
                break;
        }

        return $num;
    }
?>

@extends('master', [$title = 'Home'])

@section('meta')
    <meta name="description" content="Fiorella Giuliani Lanini è un'artista e pittrice, presenta le sue opere in questo spazio online.">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-77566858-1', 'auto');
        ga('send', 'pageview');
    </script>
@stop

@section('content')
    @if (session('emailSent'))
        <div class="email-sent">
            <div class="container">
                <button class="close" type="button">Chiudi</button>
                <b>Grazie per avermi contattata!</b><br>
                La tua email è stata ricevuta e risponderò appena possibile.<br><br>
                A presto, Fiorella
            </div>
        </div>
    @endif
    <header class="header">
        <div class="container">
            <h1 class="home-title">Fiorella Giuliani Lanini</h1>
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
                    <img class="img-responsive" src="/img/general/fiorella-giuliani-lanini.jpg" alt="Ritratto Fiorella Giuliani Lanini">
                </div>
                <div class="biography">
                    <p>Sin dai tempi della scuola amavo disegnare e i lavori di bricolage mi stimolavano l’estro creativo.</p>
                    <p>Frequentai poi diversi corsi: pittura su porcellana e su seta, mosaico, modellaggio della ceramica e creazione di gioielli in argento.</p>
                    <p>Decisi poi di provare la pittura su tela e così seguii dei corsi di pittura ad olio presso alcuni artisti ticinesi.</p>
                    <p>Pur prediligendo la pittura ad olio, con gli anni ho sperimentato anche altre tecniche ed altri materiali.</p>
                </div>
            </div>
        </div>
    </section>
    @if($shows->count())
        <section class="shows">
            <div class="container">
                <h2>Esposizioni</h2>
                <ul class="esposizioni">
                    @foreach($shows as $i => $show)
                        <li>
                            <?php $date = date_create_from_format('Y-m-d', $show->date); ?>
                            <div class="date">
                                <span class="day">{{ $date->format('d') }}</span>
                                <span class="month">{{ monthToStr($date->format('m')) }}</span>
                                <span class="year">{{ $date->format('Y') }}</span>
                            </div>
                            <div class="info">
                                <h3 class="title">{{ $show->title }}</h3>
                                <em class="place">{{ $show->place }}</em>
                            </div>
                            <div class="clearer"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif
    <section class="contact">
        <div class="container">
            <h2>Contatto</h2>
            <p class="info">Per qualsiasi domanda, o anche solo per una chiacchierata, puoi contattarmi usando il form sottostante o, se preferisci, all’email <a href="mailto:fiorelani64@gmail.com">fiorelani64@gmail.com</a></p>
            {!! Form::open(['method' => 'POST', 'route' => 'email', 'style' => 'text-align: center']) !!}
                <div>
                    {!! Form::label('nome', 'Nome: ', ['class' => 'sr-only']) !!}
                    {!! Form::text('name', null, ['id' => 'nome', 'placeholder' => 'Il tuo nome']) !!}
                </div>
                <div>
                    {!! Form::label('email', 'Email: ', ['class' => 'sr-only']) !!}
                    {!! Form::email('email', null, ['placeholder' => 'La tua email']) !!}
                </div>
                <div>
                    {!! Form::label('messaggio', 'Messaggio: ', ['class' => 'sr-only']) !!}
                    {!! Form::textarea('text', null, ['id' => 'messaggio', 'placeholder' => 'Messaggio']) !!}
                </div>
                {!! Form::submit('Invia messaggio', ['class' => 'button button-primary']) !!}
        	{!! Form::close() !!}
        </div>
    </section>
@stop

@section('footer')
    <script src="/js/app.min.js"></script>
    <script>
        $('#container').mixItUp({
            selectors: {
                target: '.work'
            },
            layout: {
                display: 'inline-block'
            }
        });

        $('a.work').featherlightGallery();

        var emailSent = $('.email-sent');
        emailSent.find('.close').on('click', function(e){
            emailSent.remove();
        });
    </script>
@stop
