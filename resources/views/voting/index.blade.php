@extends('dashboard-layout.app')

@section('breadcrumb')
<span>Home</span> / <span class="menu-text">Voting</span>
@endsection

@section('content')

<div class="row">
  <div class="col-xxl-12">
    @include('components.message-flash')

    <div class="card shadow mb-4">
      <div class="card-body">
        <!-- Election List Header with Create Button -->
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title">Lets Vote</h5>
          <!-- Create Button -->
          
        </div>
        <hr>
        <div class="row">
            <!-- Coming Soon Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-warning">
                    <div class="card-body">
                        <h4 class="card-title">Federal Election</h4>
                        <p class="card-text text-warning display-4">Coming Soon</p>
                        <p class="card-text text-muted display-8 fw-bold">Opens on: <span id="open-date"><strong></strong></span></p>
                        <p class="card-text text-muted text-sm fw-bold">Opens in: <span id="timer"><strong></strong></span></p>

                    </div>
                </div>
            </div>
        
            <!-- Voting Open Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-success">
                    <div class="card-body">
                        <h4 class="card-title">Provincial Election</h4>
                        <p class="card-text text-success display-4">Voting is Open</p>
                        <a href="{{route('vote.index')}}" class="btn btn-success btn-lg mt-3">Vote Now</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
        // Check if the open date is already stored in localStorage
        let openDate = localStorage.getItem('openDate');

        if (!openDate) {
            // Set the open date to 30 days from now and save it in localStorage
            const newOpenDate = new Date();
            newOpenDate.setDate(newOpenDate.getDate() + 30);
            openDate = newOpenDate.toISOString();
            localStorage.setItem('openDate', openDate);
        }

        const openDateObj = new Date(openDate);
        document.getElementById('open-date').textContent = openDateObj.toISOString().split('T')[0];

        // Timer countdown
        const timerElement = document.getElementById('timer');
        const countdown = setInterval(function () {
            const now = new Date().getTime();
            const distance = openDateObj - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            timerElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;

            if (distance < 0) {
                clearInterval(countdown);
                timerElement.textContent = "Voting is Open";
            }
        }, 1000);
    });
        </script>
      </div>
    </div>
  </div>
</div>

@endsection
