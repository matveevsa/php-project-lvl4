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
               'class' => 'form-control',
               'placeholder' => 'New task status'
            ])
         }}
         @error('name')
            <div class="invalid-feedback">
               @lang('validation.required', ['attribute' => 'name'])
            </div>
         @enderror
      </div>
      {{Form::submit(__('common_interface.update'), ['class' => 'btn btn-primary'])}}
   {{Form::close()}}
@endsection