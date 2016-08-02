@include('layouts.partials.header')
<style>
body{
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
                    </div>
                    @include('layouts.partials.footer')
                </section>
            </section>
        </section>
        <!-- container section start -->
    </div>
    
        <!-- Modal -->
    <div class="modal fade" id="AddForm" tabindex = "-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">新增</h4>
                </div>
                @section('AddForm')
                @show
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditForm" tabindex = "-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">編輯</h4>
                </div>
                @section('EditForm')
                @show
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-sm" id="DelForm" tabindex = "-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">你確定要移除嗎？</h4>
                </div>
                @section('DelForm')
                @show
            </div>
        </div>
    </div>
    
    </body>
</html>