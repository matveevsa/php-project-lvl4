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
                  'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
            @error('name')
               <div class="invalid-feedback">The name field is required.</div>
            @enderror
         </div>
         <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{
               Form::textarea('description', $value = null, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('statuses', 'Status') }}
            {{
               Form::select('status_id', $statuses, 'Status', $attributes = [
                  'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                  'placeholder' => 'Status'
               ])
            }}
            @error('name')
               <div class="invalid-feedback">The name field is required.</div>
            @enderror
         </div>
         <div class="form-group">
            {{ Form::label('assigned_to_id', 'Assignee') }}
            {{
               Form::select('assigned_to_id', $users, 'Assignee', $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'Assignee'
               ])
            }}
         </div>
         {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection