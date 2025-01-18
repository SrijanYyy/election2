@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Party's</span>
@endsection

@section('content')

<div class="row">
  <div class="col-xxl-12">
    @include('components.message-flash')

    <div class="card shadow mb-4">
      <div class="card-body">
        <!-- Election List Header with Create Button -->
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Party's List</h5>
          <!-- Create Button -->
          <a href="{{ route('partys.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Party
          </a>
        </div>
        <!-- Search Bar -->
        <form method="GET" action="{{ route('partys.index') }}" class="mb-3 d-flex mt-3">
          <input 
            type="text" 
            id="search-bar" 
            name="search" 
            class="form-control w-25" 
            placeholder="Search parties..." 
            value="{{ request('search') }}">
        </form>

        <hr>

        <!-- Election Table -->
        <div class="table-responsive">
          @if($partys->isEmpty())
            <p class="text-center">No parties found.</p>
          @else
          <table class="table align-middle table-hover m-0" id="dataTable">
            <thead>
              <tr>
                <TH>S.N.</TH>
                <th>Name</th>
                <th>Description</th>
                <th>Logo</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($partys as $party)
              <td>{{ $loop->iteration }}</td> <!-- Serial Number Column -->

                <td>{{ $party->name }}</td>
                <td>{{ $party->description }}</td>
                <td>
                  <!-- Eye Button with no background -->
                  <button style="background:none; border:none; font-size: 1.5rem;" onclick="showLogo('{{ asset('storage/' . $party->logo) }}')">👁️</button>
                </td>
                <td class="d-flex align-items-center">
                  <!-- Actions: Edit & Delete Icons with gap and larger size -->
                  <a href="{{ route('partys.edit', $party->id) }}" class="text-warning me-3" title="Edit" style="font-size: 1.5rem;">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="{{ route('partys.destroy', $party->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete it?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0" title="Delete" style="font-size: 1.5rem;">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </form>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- Pagination Links -->
          <div class="mt-3 d-flex justify-content-center">
            {{ $partys->links() }}
          </div>
          @endif

          <!-- Logo Modal -->
          <div id="logoModal"
            style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.3);">
            <img id="logoImage" src="" alt="Logo" style="max-width:100%; max-height:400px;">
            <button onclick="closeLogo()" style="margin-top:10px;">❌ Close</button>
          </div>

          <script>
            function showLogo(logoUrl) {
              document.getElementById('logoImage').src = logoUrl;
              document.getElementById('logoModal').style.display = 'block';
            }

            function closeLogo() {
              document.getElementById('logoModal').style.display = 'none';
            }
          </script>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
