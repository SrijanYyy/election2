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
                <div id="results-message" class="alert alert-info text-center">
                    Voting results will be shown soon. Please wait...
                    <div id="timer"></div>
                </div>
                <div id="results-table" class="table-responsive" style="display: none;">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if the countdown end time is already saved in localStorage
    var countDownDate = localStorage.getItem('countDownDate');

    // If no end time is stored, set a new end time (for example: 10 minutes from now)
    if (!countDownDate) {
        countDownDate = new Date().getTime() + 10 * 60 * 1000; // 10 minutes from now
        localStorage.setItem('countDownDate', countDownDate);
    }

    var now = new Date().getTime();
    var distance = countDownDate - now;

    // If the countdown has not ended
    if (distance > 0) {
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            // Calculate minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the timer
            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

            // If the countdown is over
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("results-message").style.display = "none";
                document.getElementById("results-table").style.display = "block";
            }
        }, 1000);
    } else {
        // If the timer has already ended, directly show the results
        document.getElementById("results-message").style.display = "none";
        document.getElementById("results-table").style.display = "block";
    }
});
</script>
