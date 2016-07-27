@include('layouts.partials.header')
<body style="background-color: lightblue;">
    <div id="wrapper">
        <!-- container section start -->
        <section id="container">
            @include('layouts.partials.nevbar')
            <section id="main-content">
                <section class="wrapper">        
                    @yield('content')
                    @include('layouts.partials.footer')
                </section>
            </section>
        </section>
        <!-- container section start -->
    </div>
    
    </body>
</html>