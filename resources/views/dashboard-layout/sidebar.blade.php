<nav id="sidebar" class="sidebar-wrapper">

<!-- App brand starts -->
<div class="app-brand px-3 py-3 d-flex align-items-center">
  <a href="index.html">
  </a>
</div>
<!-- App brand ends -->

<!-- Sidebar profile starts -->
<div class="sidebar-user-profile">
  <h5 class="profile-name lh-lg mt-2 text-truncate">Election Management System</h5>
  <ul class="profile-actions d-flex m-0 p-0">
  </ul>
</div>
<!-- Sidebar profile ends -->

<!-- Sidebar menu starts -->
<div class="sidebarMenuScroll">
  <ul class="sidebar-menu">
    <li class="active current-page">
      <a href="{{route('dashboard')}}">
        <i class="bi bi-bar-chart-line"></i>
        <span class="menu-text">Dashboard</span>
      </a>
    </li>
    @if(auth()->user()->role =='admin')
    <div class="sidebarMenuScroll">
  <ul class="sidebar-menu">
    <li class="active current-page">
      <a href="{{route('users.index')}}">
        <i class="bi bi-people-fill"></i>
        <span class="menu-text">Users</span>
      </a>
   

  <ul class="sidebar-menu">
    <li class="active current-page">
        <a href="{{route('elections.index')}}">
          <i class="bi bi-box-seam"></i>
          <span class="menu-text">Elections</span>
        </a>
   

 
  <ul class="sidebar-menu">
    <li class="active current-page">
      <a href="{{route('partys.index')}}">
        <i class="bi bi-box-seam"></i>
        <span class="menu-text">Partys</span>
      </a>


  <ul class="sidebar-menu">
    <li class="active current-page">
      <a href="{{route('election_parties.index')}}">
        <i class="bi bi-flag"></i>
        <span class="menu-text">Election Parties</span>
      </a>

      <ul class="sidebar-menu">
        <li class="active current-page">
      <a href="{{route('leaders.index')}}">
        <i class="bi bi-person"></i>
        <span class="menu-text">Leader</span>
      </a>
      @endif 

    <ul class="sidebar-menu">
      <li class="active current-page">
        <a href="{{route('voting.index')}}">
          <i class="bi bi-box2"></i>
          <span class="menu-text">Voting</span>
        </a>

        <ul class="sidebar-menu">
          <li class="active current-page">
            <a href="{{route('vote.results')}}">
              <i class="bi bi-box2"></i>
              <span class="menu-text">Results</span>
            </a>
    

  </ul>
</div>
<!-- Sidebar menu ends -->

</nav>