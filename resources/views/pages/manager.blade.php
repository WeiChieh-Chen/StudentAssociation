@extends('layouts.master')
@section('title','人員管理')
@section('pagename','人員管理')
@section('content')
<script language="javascript">
    var number = 0;
    function getForm(arrIndex,trueID){
        $('#EditName').val($('#item_'+arrIndex).children().html());
        $('#EditPhone').val($('#item_'+arrIndex).children().next().html());
        $('#EditStuID').val($('#item_'+arrIndex).children().next().next().html());
        $('#index').attr('action','{{route('manager.update')}}/'+trueID);
    }

    function delIndex(trueID){
        $('#delIndex').attr('action','{{route('manager.delete')}}/'+trueID);
    }
</script>
<button class="btn btn-success btn-lg" style="position: relative;left: 87%" data-toggle="modal" data-target="#AddForm">新增</button>

<table class="tableStyle">
    <tr>
        <td>人員姓名</td>
        <td>聯絡電話</td>
        <td>學號</td>
        <td></td>
    </tr> 
    @foreach($results as $key => $item)  
    <tr class="tableContent" id="item_{{$key}}">
        <td><?=$item->account?></td>
        <td><?=$item->phone?></td>
        <td><?=$item->studentID?></td>
        <td>
            <button class="btn btn-danger bnt-lg" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</button>
            <button class="btn btn-info bnt-lg" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</button>
        </td>
    </tr>
    @endforeach
</table>
<center><?=$results->render()?></center> 
@endsection
@section('AddForm')
    {!!Form::open([ 'class'=>'form-horizontal', 'method' => 'post', 'route' => 'manager.store'])!!}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('MemberName','人員姓名',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('account',null,['class' => 'form-control', 'id' => 'MemberName', 'placeholder' => '姓名'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('MemberPhone','聯絡電話',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('phone',null,['class' => 'form-control', 'id' => 'MemberPhone', 'placeholder' => '手機'])!!}
                    </div>
                </div>   
                <div class="form-group">
                    {!!Form::label('MemberStuID','學號',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('studentID',null,['class' => 'form-control', 'id' => 'MemberStuID', 'placeholder' => '學號'])!!}
                    </div>
                </div>           
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default', 'data-dismiss' => 'modal' ])!!}
            {!!Form::submit('儲存',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class'=>'form-horizontal', 'id' => 'index' ,'method' => 'patch'])!!}
        <div class="modal-body">
                 <div class="form-group">
                    {!!Form::label('EditName','人員姓名',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('account',null,['class' => 'form-control', 'id' => 'EditName', 'placeholder' => '姓名'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('EditPhone','聯絡電話',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('phone',null,['class' => 'form-control', 'id' => 'EditPhone', 'placeholder' => '手機'])!!}
                    </div>
                </div>   
                <div class="form-group">
                    {!!Form::label('EditStuID','學號',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('studentID',null,['class' => 'form-control', 'id' => 'EditStuID', 'placeholder' => '學號'])!!}
                    </div>
                </div>         
        </div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    </form>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class'=>'form-horizontal', 'id' => 'delIndex' ,'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning', 'data-dismiss' => 'modal' ])!!}           
            </center>
        </div>
    {!!Form::close()!!}
@endsection