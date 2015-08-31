<ol class="breadcrumbs clearfix">
    @foreach($breadcrumbs as $breadcrumb)
        <li>
            @if($breadcrumb['link'])
                <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['text'] }}</a>
            @else
                {{ $breadcrumb['text'] }}
            @endif
        </li>
    @endforeach
</ol>
