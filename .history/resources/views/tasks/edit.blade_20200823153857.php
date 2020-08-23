@extends('layouts.app')

@section('content')

      {{
         Form::open([
            'route' => 'tasks.update',
            'class' => 'w-50'
         ])
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
            {{ Form::label('description', 'Assignee') }}
            {{
               Form::text('description', $value = $task->assigned_to_id, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection