@extends('layouts.app')

@section('content')
<h1>Edit label</h1>
{{
   Form::model($label, [
       'url' => route('labels.store', $label),
       'method' => 'POST',
       'class' => 'w-50'],
       )
}}
   <div class="form-group">
      {{ Form::label('name', 'Label name') }}
      {{
         Form::text('name', $value = null, $attributes = [
            'class' => 'form-control',
            'placeholder' => 'New task status'
         ])
      }}
   </div>
   <div class="form-group">
      {{ Form::label('description', 'Label description') }}
      {{
         Form::textarea('name', $value = null, $attributes = [
            'class' => 'form-control',
            'placeholder' => 'New task status'
         ])
      }}
   </div>
   {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
{{Form::close()}}
@endsection