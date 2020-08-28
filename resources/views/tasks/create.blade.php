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
         <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{
               Form::textarea('description', $value = null, [
                  'class' => 'form-control',
                  'placeholder' => 'Task description'
               ])
            }}
         </div>
         <div class="form-group">
            {{ Form::label('statuses', 'Status') }}
            {{
               Form::select('status_id', $statuses, 'Status', [
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
               Form::select('assigned_to_id', $users, 'Assignee', [
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
         {{Form::submit(__('common_interface.create'), ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection