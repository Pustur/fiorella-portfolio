@if(session()->has('flash-message'))
    <p class="panel panel-success padding">{{ session('flash-message') }}</p>
@endif
