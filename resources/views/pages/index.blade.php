@extends('layouts.master')

@section('title', '資工系學會-蜘人血統控制板')

@section('content')
<style type="text/css">
    .bodymiddle{
        margin-right:2%;
        margin-left:2%;
    }
    
    .modal-body {
        margin-top:2%;
        margin-bottom:2%; 
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    p.ex {
        height: 100px;
        width: 100px;
    }
</style>
  <!--main content start-->
  
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="info-box" style="height: 750px;">
                  <center style="color:black;"><h1 style="padding-top: 350px;">歡迎來到<br>資工系學會 蜘人血統控制板</h1></center>
              </div>
          </div>
       </div>

  <!--main content end-->
@endsection