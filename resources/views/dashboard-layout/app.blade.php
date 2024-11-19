<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Election Management System</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />
    @include('dashboard-layout.styles')
        
  </head>

  <body>
    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        @include('dashboard-layout.sidebar')
        <!-- Sidebar wrapper end -->

        <!-- App container starts -->
        <div class="app-container">

          <!-- App header starts -->
            @include('dashboard-layout.header')
          <!-- App header ends -->

          <!-- App hero header starts -->
          <div class="app-hero-header">
            @if(Request::is('dashboard'))
            <h5 class="fw-light">Welcome {{auth()->user()->name}}</h5>
            @endif
            <h3 class="fw-light mb-5">
                @yield('breadcrumb')
            </h3>
          </div>
          <!-- App Hero header ends -->

          <!-- App body starts -->
          <div class="app-body">

            @yield('content')           

          </div>
          <!-- App body ends -->

          <!-- App footer start -->
          @include('dashboard-layout.scripts')
          @yield('scripts')
            @include('dashboard-layout.footer')
          <!-- App footer end -->

        </div>
        <!-- App container ends -->

      </div>
      <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    
  </body>

</html>