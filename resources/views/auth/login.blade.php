@extends('layouts.logmaster')

@section('title','蜘人血統 登入')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row">
            <h1>歡迎進入系學會 蜘人血統控制板</h1>
            <p style="text-align:center">
                <div class="wrap">
                    <a type="button" class="btn-slide2" href="{{route('google.auth')}}">
                        {{-- <i class="fa fa-btn fa-sign-in"></i> Google --}}
                        <span class="circle2">
                            <i class="fa fa-sign-in"></i>
                        </span>
                        <span class="title2">登入</span>
                        <span class="title-hover2">進入本系統</span>
                    </a>
                </div>

            </p>
            @if(session()->has('errMail'))
            <script>
                alertify.set({
                    'delay' : 2000,
                    'labels': {
                        ok        : "重新登入",
                        cancel    : "取消"
                    },
                    'buttonFocus' : "ok"
                });  
                alertify.confirm('{{session('errMail')}}',function(ok){ 
                    if(ok){     
                        alertify.success("即將回到Google登入頁面...");
                        window.location.href = "https://accounts.google.com/logout";
                    }else {
                        alertify.error('已確認取消登入'); 
                    }   
                });
            </script>
            @elseif(session()->has('logout'))
            <script>
                alertify.set({
                    'delay' : 2000,
                    'labels': {
                        ok      : "登出Google",
                    }
                });
                alertify.log("{{session('logout')}}"); 
                alertify.alert('點選按鈕以登出帳號',function(){
                    window.location.href = "https://accounts.google.com/logout";
                });
            </script>
            @endif
        </div>
    </div>
</div>
@endsection
