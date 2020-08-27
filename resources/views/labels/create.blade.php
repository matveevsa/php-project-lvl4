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
         Form::text('name', $value = null, [
            'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'New label'
         ])
      }}
      @error('name')
         <div class="invalid-feedback">
            {{ $message }}
         </div>
      @enderror
   </div>
   <div class="form-group">
      {{ Form::label('description', 'Label description') }}
      {{
         Form::textarea('description', $value = null, [
            'class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Label description'
         ])
      }}
      @error('description')
         <div class="invalid-feedback">
            {{ $message }}
         </div>
      @enderror
   </div>
   {{Form::submit(__('common_interface.create'), ['class' => 'btn btn-primary'])}}
{{Form::close()}}
@endsection