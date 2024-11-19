@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Election Parties</span>
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
              <!-- Loop through existing elections -->
              

            
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
