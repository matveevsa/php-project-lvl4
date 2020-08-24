@extends('layouts.app')

@section('content')
<h1>Create new label</h1>
{{
    Form::open([
       'route' => 'labels.store',
       'class' => 'w-50'
    ])
 }}
   <div class="form-group">
      {{ Form::label('name', 'Label name') }}
      {{
         Form::text('name', $value = null, $attributes = [
            'class' => 'form-control',
            'placeholder' => 'New label'
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