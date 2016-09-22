@extends('layouts.master')
@section('title','投票區')
@section('pagename','投票區')
@section('content')
<script language="javascript">
var number = 0;
var datus = new Object();
var itemDatus = new Object();
datus = <?=$obtainArr?>;
itemDatus = <?=$itemCollect?>;

function getForm(arrIndex, trueId){
    $('#EdItems').val($('#item_'+arrIndex).children().html());
    $('#index').attr('action','{{route('vote.update')}}/'+trueId);

    itemDatus .forEach(function(item, key, array){
        if(item['itemId'] == trueId){
            key = item['itemOrder'];
            $("#optionEditForm").append("<div class='form-group'><label for='optionName"+key+"' class='col-sm-2 control-label'>項目 "+key+"</label><div class='col-sm-10'><input type='text' id='optionName"+key+"' class='form-control' name ='optionName"+key+"' value ="+item['optionName']+"></input><input type='file' name='fileName"+key+"'></div></div>");
        }
    });

}

function delIndex(trueID){
    $('#delIndex').attr('action','{{route('vote.delete')}}/'+trueID);
}

function subForm() {
    $('#addForm').attr('action','{{route('vote.store')}}/'+number).submit();
}

function insertItem(){
    number++;
    $("#optionAddForm").append("<div class='form-horizontal' id='item"+number+"'><label for='optionName"+number+"' class='col-sm-2 control-label'>項目 "+number+"</label><div class='col-sm-10'><input type='text' id='optionName"+number+"' class='form-control' name ='optionName"+number+"' placeholder = '項目名稱請慎寫，萬一打錯可是很麻煩的~'></input></div><div class='col-sm-10 col-sm-offset-2'><input type='file' name='fileName"+number+"'></div></div>");
}   

function removeItem(){
    $("#item"+number).remove();
    if(number > 0) number--;
}   
</script>
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>
<table class="tableStyle">
    <tr>
    <td class="col-sm-4">投票主題</td>
    <td class="col-sm-4">總投票人次</td>
    <td class="col-sm-2" style="text-align: left">附件名稱</td>    
    <td class="col-sm-2"></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">
        <td >{{$item->item}}</td>
        <td >{{is_null($votes[$item->id])?0:$votes[$item->id]}}</td>
        <td style="font-size: 13px; text-align: left">
        @foreach($itemCollect as $i => $row)
            @if(($itemCollect[$i]->itemId == $item->id) && !empty($row->fileName))
                    <a href="{{route('getFile').'/'.$row->fileName}}" ><i class="fa fa-download" aria-hidden="true"></i> {{$row->fileName}}</a> <項目{{$i+1}}><br>                
            @endif
        @endforeach
     
        </td>
        <td>
            <a role="button" class="button" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</a>
            <a role="button" class="button  button-secondary" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</a>
        </td>
    </tr>
    @endforeach
</table>
<center><?=$results->render()?></center>
@endsection
@section('AddForm')
    {!!Form::open(['class' => 'form-horizontal', 'id' => 'addForm' ,'method' => 'post' , 'route' => 'vote.store','files' => 'true'])!!}  {{--html is  enctype='multipart/form-data'--}}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('AddItems','投票名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('item',null,['id' => 'AddItems', 'class' => 'form-control' , 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div id="optionAddForm"></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <i class="fa fa-plus-square-o fa-2x" style="cursor: pointer" role="button" onclick="insertItem()" aria-hidden="true"></i>
                        <i class='fa fa-minus-square-o fa-2x' style="cursor: pointer" role="button" onclick="removeItem()" aria-hidden='true'></i>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default', 'onclick' => '$("#optionAddForm").empty();$("#AddItems").val("");number=0' ,'data-dismiss' => 'modal'])!!}
            {!!Form::button('儲存',['class' => 'btn btn-primary', 'onclick' => 'subForm()'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class' => 'form-horizontal','role' => 'form' ,'id' => 'index', 'method' => 'patch' ,'files' => 'true'])!!}
    <div class="modal-body">
                <div class="form-group">
                {!!Form::label('EdItems','投票項目',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('item',null,['class' => 'form-control', 'id' => 'EdItems'])!!}
                    </div>
                </div>        
                <div id="optionEditForm"></div>
        </div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default', 'onclick' => '$("#optionEditForm").empty()' ,'data-dismiss' =>'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class' => 'form-horizontal','role' => 'form','id' => 'delIndex' , 'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning' ,'data-dismiss' => 'modal' ])!!}          
            </center>
        </div>
    {!!Form::close()!!}
@endsection
