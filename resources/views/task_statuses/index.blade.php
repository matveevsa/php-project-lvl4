@extends ('layouts.app')

@section('content')
  @include('flash::message')
  <h1 class="mb-5">Task Status</h1>
  @can('crud-entity')
    <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">
      @lang('task_statuses.new_status')
    </a>
  @endcan
      <table class="table mt-2">
          <thead>
            <tr>
              <th style="width: 16.66%" scope="col">#</th>
              <th style="width: 30%" scope="col">Name</th>
              <th style="width: 30%" scope="col">Created at</th>
              @can('crud-entity')
                <th scope="col">Actions</th>
              @endcan
            </tr>
          </thead>
          <tbody>
          @foreach ($statuses as $taskStatus)
            <tr>
              <th scope="row">{{ $taskStatus->id }}</th>
              <td>{{ $taskStatus->name }}</td>
              <td>{{ $taskStatus->created_at->format('d M Y') }}</td>
              @can('crud-entity')
                <td>
                  <a href="{{ route('task_statuses.edit', $taskStatus) }}">
                    @lang('common_interface.edit')
                  </a>
                  <a
                    href="{{ route('task_statuses.destroy', $taskStatus) }}"
                    data-confirm="{{ __('common_interface.confirm_delete') }}"
                    data-method="delete"
                    rel="nofollow"
                  >
                  @lang('common_interface.remove')
                  </a>
                </td>
              @endcan
            </tr>
          @endforeach
          </tbody>
        </table>
@endsection