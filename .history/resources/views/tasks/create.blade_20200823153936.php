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
            @error('name')
               <p>{{ $message }}</p>
            @enderror
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
               Form::select('status_id', $statuses, '1', $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Status'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('assigned_to_id', 'Assignee') }}
            {{
               Form::select('assigned_to_id', $users, '1', $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Assignee'
               ])
            }}
         </div>
         {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection