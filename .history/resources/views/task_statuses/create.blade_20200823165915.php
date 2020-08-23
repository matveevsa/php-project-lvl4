@extends('layouts.app')

@section('content')
      <h1>Add New Task Status</h1>
      {{
         Form::open([
            'route' => 'task_statuses.store',
            'class' => 'w-50'
         ])
      }}
         <div class="form-group">
            {{ Form::label('name', 'Status name') }}
            {{
               Form::text('name', $value = null, $attributes = [
                  'class' => 'form-control',
                  'placeholder' => 'New task status'
               ])
            }}
         </div>
         {{Form::submit('Create', ['class' => 'btn btn-primary {{ @error['name'] }}'])}}
      {{Form::close()}}
@endsection