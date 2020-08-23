@extends ('layouts.app')
@include('flash::message')
@section('content')
<h1 class="mb-5">Tasks</h1>

      <table class="table mt-2">
          <thead>
            <tr>
              <th style="width: 16.66%" scope="col">#</th>
              <th style="width: 30%" scope="col">Status</th>
              <th style="width: 30%" scope="col">Name</th>
              <th style="width: 30%" scope="col">Creator</th>
              <th style="width: 30%" scope="col">Creator</th>
              <th style="width: 30%" scope="col">Created at</th>
              @can('crud-status')
                <th scope="col">Actions</th>
              @endcan
            </tr>
          </thead>
          <tbody>
          @foreach ($tasks as $task)
            <tr>
              <th scope="row">{{ $task->id }}</th>
              <td>{{ $task->name }}</td>
              <td>{{ $task->created_at->format('d M Y') }}</td>
              @can('crud-status')
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