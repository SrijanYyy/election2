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
                <h5 class="card-title">Party's List in Election</h5>
                <hr>
                <div class="d-flex flex-wrap">
                    @foreach($leaders as $leader)
                    <div class="card text-center m-3" style="width: 18rem; border: 1px solid #F4C17C; border-radius: 10px;">
                        <div class="card-body" style="background: linear-gradient(135deg, #FFECD6, #FDE2CF); padding: 1.5rem;">
                            <img src="{{ $leader->logo }}" alt="{{ $leader->name }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; border: 3px solid #F4C17C;">
                            <h5 class="card-title mb-1" style="color: #333;">{{ $leader->name }}</h5>
                            <p class="card-text mb-3" style="color: #777; font-size: 0.9rem;">{{ $leader->party->name }}</p>

                            @if($hasVoted)
                            <!-- Disabled Button for Already Voted -->
                            <button class="btn text-white" style="border-radius: 20px; padding: 0.5rem 1rem; background-color: #dc3545; border: none;" disabled>
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
