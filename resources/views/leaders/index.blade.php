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
              <th>Image</th>
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
                  <!-- Eye Button with no background -->
                  <button style="background:none; border:none; font-size: 1.5rem;" onclick="showLogo('{{ asset('storage/' . $leader->logo) }}')">👁️</button>
                </td>
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
@endsection
