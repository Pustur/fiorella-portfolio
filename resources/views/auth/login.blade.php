@extends('admin', [$title = "Login"])

@section('content')
    {!! Form::open(['method' => 'POST', 'url' => '/auth/login']) !!}
        <div>
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', old('email')) !!}
        </div>
        <div>
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password') !!}
        </div>
        <div>
            {!! Form::checkbox('remember') !!}
            {!! Form::label('remember', 'Remember me', ['class' => 'inline']) !!}
        </div>
        {!! Form::submit('Login', ['class' => 'button-primary']) !!}
    {!! Form::close() !!}

    @include('partials.errors')
@stop
