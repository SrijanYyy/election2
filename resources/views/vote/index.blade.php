@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Party's in Election</span>
@endsection

@section('content')

<div class="row">
    <div class="col-xxl-12">
        @include('components.message-flash')

        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Flex container for heading and timer -->
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Party's List in Election</h5>
                    <!-- Timer will appear here -->
                    <div id="election-timer" style="font-size: 1rem; color: #333; font-weight: bold;"></div>
                </div>
                <hr>
                <div class="d-flex flex-wrap">
                    @foreach($leaders as $leader)
                    <div class="card text-center m-3" style="width: 18rem; border: 1px solid #f1f1f1; border-radius: 10px;">
                        <div class="card-body" style="background: radial-gradient( circle 993px at 0.5% 50.5%,  rgba(137,171,245,0.37) 0%, rgba(245,247,252,1) 100.2% ); padding: 1.5rem;">
                            <img src="{{ $leader->party->logo }}"  class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; border: 3px solid #f5f5f5;">
                            <h3 class="card-title mb-1" style="color: #333333;">{{ $leader->name }}</h3>
                            <p class="card-text mb-3" style="color: #0327f3; font-size: 0.9rem;">Party: {{ $leader->party->name }}</p>

                            @if($hasVoted)
                            <!-- Disabled Button for Already Voted -->
                            <button class="btn text-white" style="border-radius: 20px; padding: 0.5rem 1rem; background-color: #f5031b; border: none;" disabled>
                                Already Voted
                            </button>
                            @else
                            <!-- Voting Form -->
                            <form action="{{ route('voting.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="party_id" value="{{ $leader->party->id }}">
                                <input type="hidden" name="leader_id" value="{{ $leader->id }}">
                                <button type="submit" class="btn btn-warning text-white" style="border-radius: 20px; padding: 0.5rem 1rem;">
                                    Vote
                                </button>
                            </form>
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>

</script>
