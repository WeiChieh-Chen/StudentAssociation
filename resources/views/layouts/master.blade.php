@include('layouts.partials.header')
<style>
    body {
        background-color: lightblue;
    }
</style>
<body>
    <div id="wrapper">
        <!-- container section start -->
        <section id="container">
            @include('layouts.partials.nevbar')
            <section id="main-content">
                <section class="wrapper">
                    <div style="min-height:750px;">
                        @yield('content')
                        @include('layouts.partials.modalForm')
                    </div>
                </section>
            </section>
        @include('layouts.partials.footer')
        </section>
    </div>
    <!-- container section start -->
</body>

</html>