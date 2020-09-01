@extends('layouts.app')

@section('content')
   <h1>Edit Task Status</h1>
   {{
      Form::model($taskStatus, [
         'url' => route('task_statuses.update', $taskStatus),
         'method' => 'PATCH',
         'class' => 'w-50'],
         )
   }}
      <div class="form-group">
         {{ Form::label('name', 'Status name') }}
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
      <div>
         {{Form::submit(__('common_interface.update'), ['class' => 'btn btn-primary'])}}
         <a class="btn btn-outline-primary" href="{{ route('task_statuses.index') }}">
            {{ __('common_interface.cancel') }}
         </a>
      </div>
   {{Form::close()}}
@endsection