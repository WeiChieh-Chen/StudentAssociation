@include('layouts.partials.header')
<body>
    <div id="wrapper">
        <!-- container section start -->
        <section id="container" class="">
            @include('layouts.partials.nevbar')
            @yield('title')
            @yield('content')
        </section>
        <!-- container section start -->
    </div>
    @include('layouts.partials.footer')
    </body>
</html>