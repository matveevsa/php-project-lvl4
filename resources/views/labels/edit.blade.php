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
            'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'New task status'
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
            'placeholder' => 'New task status'
         ])
      }}
      @error('description')
         <div class="invalid-feedback">
            {{ $message }}
         </div>
      @enderror
   </div>
   {{Form::submit(__('common_interface.update'), ['class' => 'btn btn-primary'])}}
{{Form::close()}}
@endsection