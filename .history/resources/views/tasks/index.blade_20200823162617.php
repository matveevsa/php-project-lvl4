@extends ('layouts.app')
@include('flash::message')
@section('content')
<h1 class="mb-5">Tasks</h1>
@can('crud-entity')
<a href="{{ route('tasks.create') }}" class="btn btn-primary">
  @lang('tasks.new_task')
</a>
@endcan
      <table class="table mt-2">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Status</th>
              <th scope="col">Name</th>
              <th scope="col">Creator</th>
              <th scope="col">Assignee</th>
              <th scope="col">Created at</th>
              @can('crud-entity')
                <th scope="col">Actions</th>
              @endcan
            </tr>
          </thead>
          <tbody>
          @foreach ($tasks as $task)
            <tr>
              <th scope="row">{{ $task->id }}</th>
              <td>{{ $task->status->name }}</td>
              <td>{{ $task->name }}</td>
              <td>{{ $task->creator->name }}</td>
              <td>{{ optional($task->assignee)->name }}</td>
              <td>{{ $task->created_at->format('d M Y') }}</td>
              @can('crud-entity')
                <td>
                  
                  <a
                    href="{{ route('tasks.edit', $task) }}"
                  >
                    @lang('common_interface.edit')
                  </a>
                </td>
              @endcan
            </tr>
          @endforeach
          </tbody>
        </table>

@endsection