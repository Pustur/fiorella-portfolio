<div>
    {!! Form::label('title', 'Titolo: ') !!}
    {!! Form::text('title') !!}
</div>
<div>
    {!! Form::label('size', 'Dimensione: ') !!}
    {!! Form::text('size') !!}
</div>
<div>
    {!! Form::label('technique_id', 'Tecnica: ') !!}
    {!! Form::select('technique_id', $techniqueList, (isset($work->technique->id) ? $work->technique->id : null), ['id' => 'select2']) !!}
</div>
<div>
    {!! Form::label('imageFile', 'Immagine: ') !!}
    {!! Form::file('imageFile') !!}
</div>
{!! Form::submit($submitText, ['class' => 'button button-primary']) !!}
