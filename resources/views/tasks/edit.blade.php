@extends('layouts.app')

@section('content')
   <h1>Update Task</h1>
      {{
          Form::model($task, [
            'url' => route('tasks.update', $task),
            'method' => 'PATCH',
            'class' => 'w-50'],
         )
      }}
         <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{
               Form::text('name', $value = $task->name, [
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
            {{ Form::label('description', 'Description') }}
            {{
               Form::textarea('description', $value = $task->description, [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('status_id', 'Status') }}
            {{
               Form::select('status_id', $statuses, $task->status_id, [
                  'class' => $errors->has('status_id') ? 'form-control is-invalid' : 'form-control',
                  'placeholder' => 'Status'
               ])
            }}
            @error('status_id')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
            @enderror
         </div>
         <div class="form-group">
            {{ Form::label('assigned_to_id', 'Assignee') }}
            {{
               Form::select('assigned_to_id', $users, $value = $task->assigned_to_id, [
                  'class' => 'form-control',
                  'placeholder' => 'Assignee'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('label_id', 'Labels') }}
            {{
               Form::select('label_id', $labels, null, [
                  'class' => 'form-control',
                  'placeholder' => 'Labels',
                  'multiple'
               ])
            }}
         </div>
         {{Form::submit(__('common_interface.update'), ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection