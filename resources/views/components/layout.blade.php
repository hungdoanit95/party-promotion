@include('components.header')
    @include('components.sidebar')
    <main id="main" class="main">
        @yield('content')
  </main><!-- End #main -->
@include('components.footer')