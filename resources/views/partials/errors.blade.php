@if($errors->any())
    <ul class="panel panel-danger form-errors">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
