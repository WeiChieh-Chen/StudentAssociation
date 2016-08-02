@extends('layouts.master')
@section('title','日誌紀錄')
@section('content')
<br><br>
<table class="tableStyle">
    <tr>
        <td>登入帳號</td>
        <td>登入時間</td>
        <td>登入IP</td>
        <td>登出時間</td>
    </tr>
    @foreach($results as $item)
    <tr class="tableContent">
        <td><?=$item->logInAC?></td>
        <td><?=$item->logInTime?></td>
        <td><?=$item->IP?></td>
        <td><?=$item->logOutTime?></td>
    </tr>
    @endforeach
</table>
<center><?=$results->render()?></center>
@endsection