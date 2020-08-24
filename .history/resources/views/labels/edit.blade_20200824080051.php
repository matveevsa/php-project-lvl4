@extends('layouts.app')

@section('content')
<h1>Edit Task Status</h1>
{{
   Form::model($label, [
       'url' => route('labels.update', $taskStatus),
       'method' => 'PATCH',
       'class' => 'w-50'],
       )
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
   {{Form::submit('Edit', ['class' => 'btn btn-primary'])}}
{{Form::close()}}
@endsection