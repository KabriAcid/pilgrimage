@include('includes.head')
<body>
   @include('includes.header') 
  @section('nav')
    @include('includes.gen-nav')
  @show
     
   <div class="container-fluid mt-5">
   @include('flash-message')
   @yield('content')
   @include('includes.footer') 
   <!-- gen nav also include bar and headers -->
</body>
</html>