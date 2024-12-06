@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Leaders</span>
@endsection

@section('content')
<div class="row">
  <div class="col-xxl-12">
    @include('components.message-flash')

    <!-- Table for Leaders -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Leaders</h5>
          <a href="{{ route('leaders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Leaders
          </a>
        </div>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Party</th>
              <th>Election</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($leaders as $leader)
              <tr>
                <td>{{ $leader->name }}</td>
                <td>{{ $leader->party->name ?? 'N/A' }}</td>
                <td>{{ $leader->election->name ?? 'N/A' }}</td>
                <td>
                  <a href="{{ route('leaders.edit', $leader->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('leaders.destroy', $leader->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
