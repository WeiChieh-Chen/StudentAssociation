@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a type="button" class="btn btn-warning" href="{{route('google.auth')}}">
                                    <i class="fa fa-btn fa-sign-in"></i> Google+
                                </a>                       
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                    @if(session()->has('errMail'))
                    <script>
                        alertify.set({
                            'delay' : 3000,
                            'labels': {
                                ok        : "重新登入",
                                cancel    : "取消"
                            },
                            'buttonFocus' : "ok"
                        });  
                        alertify.confirm('{{session('errMail')}}',function(ok){ 
                            if(ok){     
                                alertify.success("即將回到Google登入頁面...");
                                {{sleep(1)}}
                                window.location.href = "https://accounts.google.com/ServiceLogin";
                            }else {
                                alertify.error('已確認取消登入'); 
                            }
                        });
                    </script>
                    @elseif(session()->has('logout'))
                    <script>
                        alertify.log("{{session('logout')}}");
                        
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
