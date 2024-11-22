@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Election Parties</span>
{{-- @endsection --}}
@endsection

@section('content')

<div class="row">
  <div class="col-xxl-12">
    @include('components.message-flash')

    <div class="card shadow mb-4">
      <div class="card-body">
        <!-- Election List Header with Create Button -->
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Election Parties</h5>
          <!-- Create Button -->
          <a href="{{ route('election_parties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Election Parties
          </a>
        </div>
        <hr>

        <!-- Election Table -->
        <div class="table-responsive">
          <table class="table align-middle table-hover m-0" id="dataTable">
            <thead>
              <tr>
                <th>SN</th> <!-- Serial Number Column Header -->
                <th>Election</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($election_parties as $election_party)
              <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $election_party->election->name }}</td>
                <td>{{ $election_party->created_at ? $election_party->created_at->format('d M, Y') : 'N/A' }}</td>
                <td>{{ $election_party->updated_at ? $election_party->updated_at->format('d M, Y') : 'N/A' }}</td>
                <td>
                  <a href="{{ route('election_parties.show', $election_party->id) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ route('election_parties.edit', $election_party->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('election_parties.destroy', $election_party->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          <!-- Pagination links -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
