{!! Form::label('title', 'Titolo: ') !!}
{!! Form::text('title') !!}

{!! Form::label('body', 'Descrizione: ') !!}
{!! Form::textarea('body') !!}

{!! Form::label('image', 'Immagine: ') !!}
{!! Form::text('image') !!}

{!! Form::submit($submitText) !!}