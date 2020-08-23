@extends('layouts.app')

@section('content')
{{ dd($task) }}
      {{
          Form::model($taskStatus, [
       'url' => route('task_statuses.update', $taskStatus),
       'method' => 'PATCH',
       'class' => 'w-50'],
       )
      }}
         <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{
               Form::text('name', $value = $task->name, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{
               Form::text('description', $value = $task->description, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('statuses', 'Status') }}
            {{
               Form::select('statuses', $statuses, $task->status_id, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Status'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('assigned_to_id', 'Assignee') }}
            {{
               Form::text('assigned_to_id', $value = $task->assigned_to_id, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection