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
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Election Parties</h5>
          <a href="{{ route('election_parties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Election Parties
          </a>
        </div>
        <hr>

        <div class="table-responsive">
          <table class="table align-middle table-hover m-0">
            <thead>
              <tr>
                <th>SN</th>
                <th>Election</th>
                <th>Parties</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($election_parties as $election)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $election->name }}</td>
                <td>
                  <button class="btn btn-sm btn-secondary view-parties-btn" data-election-id="{{ $election->id }}">
                    View Parties
                  </button>
                  <div id="parties-list-{{ $election->id }}" class="parties-list" style="display: none;">
                    <ul class="list-unstyled">
                      @foreach ($election->parties as $party)
                        <li>{{ $party->name }}</li>
                      @endforeach
                    </ul>
                    <button class="btn btn-sm btn-danger close-parties-btn" data-election-id="{{ $election->id }}">
                      Close
                    </button>
                  </div>
                </td>
                <td>{{ $election->created_at ? $election->created_at->format('d M, Y') : 'N/A' }}</td>
                <td>
                  <form action="{{ route('election_parties.destroy', $election->id) }}" method="POST" class="d-inline">
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
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Show the parties list when "View Parties" is clicked
    document.querySelectorAll('.view-parties-btn').forEach(button => {
        button.addEventListener('click', function () {
            const electionId = this.dataset.electionId;
            const partiesList = document.getElementById(`parties-list-${electionId}`);
            if (partiesList) {
                partiesList.style.display = 'block';
            }
        });
    });

    // Hide the parties list when "Close" is clicked
    document.querySelectorAll('.close-parties-btn').forEach(button => {
        button.addEventListener('click', function () {
            const electionId = this.dataset.electionId;
            const partiesList = document.getElementById(`parties-list-${electionId}`);
            if (partiesList) {
                partiesList.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
