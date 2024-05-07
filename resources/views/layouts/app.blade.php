<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Restapi Arneva
    </title>

    @include('layouts.partials.head')
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('layouts.partials.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">

        @yield('content')

    </div>
  </main>

  <!--   Core JS Files   -->
  @include('layouts.partials.foot')
</body>

</html>
