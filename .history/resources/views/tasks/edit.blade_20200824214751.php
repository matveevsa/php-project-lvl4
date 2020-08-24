@extends('layouts.app')

@section('content')

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
                  'class' => 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
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
                  'class' => 'form-control',
                  'placeholder' => 'Status',
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('label_id', 'Status') }}
            {{
               Form::select('status_id', $statuses, $task->status_id, [
                  'class' => 'form-control',
                  'placeholder' => 'Status',
               ])
            }}
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
         {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection