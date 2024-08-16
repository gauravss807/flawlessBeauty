@include('admin.header')
@include('admin.sidebar')
@yield('content')

<!-- This section allows for extra script code specific to a page -->
@stack('script')

@include('admin.footer')