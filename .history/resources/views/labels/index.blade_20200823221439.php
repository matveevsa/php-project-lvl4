@extends ('layouts.app')
@include('flash::message')
@section('content')
<h1 class="mb-5">Labels</h1>
@can('crud-entity')
<a href="{{ route('labels.create') }}" class="btn btn-primary">
  @lang('labels.new_task')
</a>
@endcan
      <table class="table mt-2">
          <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Created at</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($labels as $label)
            <tr>
              <th scope="row">{{ $label->id }}</th>
              <td>{{ $label->name }}</td>
              <td>{{ $label->name }}</td>
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
                  @can('task-delete', $task)
                    <a
                      href="{{ route('tasks.destroy', $task) }}"
                      data-confirm="Вы уверены?"
                      data-method="delete"
                      rel="nofollow"
                    >
                    @lang('common_interface.remove')
                    </a>
                  @endcan
                </td>
              @endcan
            </tr>
          @endforeach
          </tbody>
        </table>

@endsection