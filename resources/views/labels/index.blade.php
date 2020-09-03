@extends ('layouts.app')

@section('content')
  @include('flash::message')
  <h1 class="mb-5">Labels</h1>
  @can('create', App\Label::class)
    <a href="{{ route('labels.create') }}" class="btn btn-primary">
      @lang('labels.new_label')
    </a>
  @endcan
        <table class="table mt-2">
            <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Created at</th>
                  @can('create', App\Label::class)
                      <th scope="col">Actions</th>
                  @endcan
              </tr>
            </thead>
            <tbody>
            @foreach ($labels as $label)
              <tr>
                <th scope="row">{{ $label->id }}</th>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at->format('d M Y') }}</td>
                @can('create', $label)
                  <td>
                    <a
                      href="{{ route('labels.edit', $label) }}"
                    >
                      @lang('common_interface.edit')
                    </a>
                    <a
                      href="{{ route('labels.destroy', $label) }}"
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