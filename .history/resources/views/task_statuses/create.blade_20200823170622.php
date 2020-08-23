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
                  'class' => 'form-control' . (@error('name') ? 'is-invalid : '',
                  'placeholder' => 'New task status'
               ])
            }}
         </div>
         {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
      {{Form::close()}}
@endsection