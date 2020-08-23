@extends('layouts.app')

@section('content')
      <h1>Add New Task</h1>
      {{
         Form::open([
            'route' => 'tasks.store',
            'class' => 'w-50'
         ])
      }}
         <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{
               Form::text('name', $value = null, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{
               Form::text('description', $value = null, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('statuses', 'Status') }}
            {{
               Form::select('statuses', $statuses, '1', $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Status'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('description', 'Assignee') }}
            {{
               Form::text('description', $value = null, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection