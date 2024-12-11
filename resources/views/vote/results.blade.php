@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Voting Results</span>
@endsection

@section('content')

<div class="row">
    <div class="col-xxl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">Voting Results</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Leader</th>
                                <th>Party</th>
                                <th>Total Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                            <tr>
                                <td>{{ $result->leader_name }}</td>
                                <td>{{ $result->party_name }}</td>
                                <td>{{ $result->total_votes }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No votes have been cast yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
