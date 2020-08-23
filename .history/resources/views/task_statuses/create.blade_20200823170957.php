@extends('layouts.app')

@section('content')
      <h1>Add New Task Status</h1>
      {{
         Form::open([
            'route' => 'task_statuses.store',
            'class' => 'w-50'
         ])
      }}
         <div class="form-group">
            {{ Form::label('name', 'Status name') }}
            {{
               Form::text('name', $value = null, $attributes = [
                  'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
            @error('name')
            <div class="invalid-feedback">The name field is required.</div>
            @enderror
         </div>
         {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection