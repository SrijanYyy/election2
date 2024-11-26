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
          <a href="{{ route('election_parties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Election Parties
          </a>
        </div>
        <hr>

        <!-- Election Table -->
        <div class="table-responsive">
          <table class="table align-middle table-hover m-0">
            <thead>
              <tr>
                <th>SN</th>
                <th>Election</th>
                <th>Parties</th>
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
                <td>
                  @if ($election_party->party)  <!-- Use 'party' instead of 'partys' -->
                    <ul class="list-unstyled">
                      <li>
                        <a href="javascript:void(0);" class="party-link" data-party-id="{{ $election_party->party->id }}">
                          {{ $election_party->party->name }}
                        </a>
                        <!-- Hidden Party Details -->
                        <div id="party-details-{{ $election_party->party->id }}" class="party-details border p-2 mt-2" style="display: none;">
                          <p><strong>Party Name:</strong> {{ $election_party->party->name }}</p>
                          <button class="btn btn-sm btn-secondary close-party-details" data-party-id="{{ $election_party->party->id }}">Close</button>
                        </div>
                      </li>
                    </ul>
                  @else
                    <p class="text-muted">No party associated with this election.</p>
                  @endif
                </td>
                <td>{{ $election_party->created_at ? $election_party->created_at->format('d M, Y') : 'N/A' }}</td>
                <td>{{ $election_party->updated_at ? $election_party->updated_at->format('d M, Y') : 'N/A' }}</td>
                <td>
                  <a href="{{ route('election_parties.edit', $election_party->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('election_parties.destroy', $election_party->id) }}" method="POST" class="d-inline">
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

          <!-- Pagination links -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript for Toggle Functionality -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Handle party link clicks
    document.querySelectorAll('.party-link').forEach(link => {
      link.addEventListener('click', function () {
        const partyId = this.dataset.partyId;
        const partyDetails = document.getElementById(`party-details-${partyId}`);
        if (partyDetails) {
          partyDetails.style.display = 'block';
        }
      });
    });

    // Handle close button clicks
    document.querySelectorAll('.close-party-details').forEach(button => {
      button.addEventListener('click', function () {
        const partyId = this.dataset.partyId;
        const partyDetails = document.getElementById(`party-details-${partyId}`);
        if (partyDetails) {
          partyDetails.style.display = 'none';
        }
      });
    });
  });
</script>
@endsection
