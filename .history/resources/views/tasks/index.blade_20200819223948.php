@extends ('layouts.app')
@include('flash::message')
@section('content')
<h1 class="mb-5">Tasks</h1>
@can('crud-task')
<a href="{{ route('task.create') }}" class="btn btn-primary">
  @lang('task.new_task')
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
              @can('crud-task')
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
              <td>{{ optional($task->assignee->name }}</td>
              <td>{{ $task->created_at->format('d M Y') }}</td>
              @can('crud-task')
                <td>
                  <a
                    {{-- href="{{ route('task.destroy', $task) }}" --}}
                    data-confirm="Вы уверены?"
                    data-method="delete"
                    rel="nofollow"
                  >
                  @lang('common_interface.remove')
                  </a>
                  <a
                    {{-- href="{{ route('task.edit', $task) }}" --}}
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