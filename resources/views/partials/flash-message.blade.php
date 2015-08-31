@if(session()->has('flash-message'))
    <p class="panel panel-success padding" data-element="flash-message">{{ session('flash-message') }}</p>
@endif
