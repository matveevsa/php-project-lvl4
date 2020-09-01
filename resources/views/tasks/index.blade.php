@extends ('layouts.app')

@section('content')
  <h1 class="mb-5">Tasks</h1>
    <div class="d-flex">
    <div>
    {{
      Form::open([
        'route' => 'tasks.index',
        'class' => 'form-inline',
        'method' => 'get'
      ])
      }}
          {{
          Form::select('filter[status_id]', $statuses, $filter['status_id'] ?? null, [
              'class' => 'form-control mr-2',
              'placeholder' => 'Status',
          ])
          }}
          {{
          Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, [
              'class' => 'form-control mr-2',
              'placeholder' => 'Creator',
          ])
          }}
          {{
          Form::select('filter[assigned_to_id]]', $users, $filter['assigned_to_id'] ?? null, [
              'class' => 'form-control mr-2',
              'placeholder' => 'Assignee',
          ])
          }}
      {{Form::submit(__('common_interface.apply'), ['class' => 'btn btn-outline-primary mr-2'])}}
    {{Form::close()}}
      </div>
      @can('crud-entity')
          <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">
          @lang('tasks.new_task')
          </a>
      @endcan
    </div>
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
                    @can('task-delete', $task)
                      <a
                        href="{{ route('tasks.destroy', $task) }}"
                        data-confirm="{{ __('common_interface.confirm_delete') }}"
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