@extends('layouts.app')

@section('content')
<h1>Edit label</h1>
{{
   Form::model($label, [
       'url' => route('labels.update', $label),
       'method' => 'PATCH',
       'class' => 'w-50'],
       )
}}
   <div class="form-group">
      {{ Form::label('name', 'Label name') }}
      {{
         Form::text('name', $value = null, [
            'class' => 'form-control',
            'placeholder' => 'New task status'
         ])
      }}
   </div>
   <div class="form-group">
      {{ Form::label('description', 'Label description') }}
      {{
         Form::textarea('name', $value = null, [
            'class' => 'form-control',
            'placeholder' => 'New task status'
         ])
      }}
   </div>
   {{Form::submit('Edit', ['class' => 'btn btn-primary'])}}
{{Form::close()}}
@endsection