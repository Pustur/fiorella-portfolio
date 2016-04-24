<div>
    {!! Form::label('title', 'Titolo: ') !!}
    {!! Form::text('title') !!}
</div>
<div>
    {!! Form::label('place', 'Luogo: ') !!}
    {!! Form::text('place') !!}
</div>
<div>
    {!! Form::label('date', 'Data: ') !!}
    {!! Form::date('date') !!}
</div>
{!! Form::submit($submitText, ['class' => 'button button-primary']) !!}
