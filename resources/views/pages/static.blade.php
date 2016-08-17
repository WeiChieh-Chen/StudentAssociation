@extends('layouts.master')
@section('title','投票區')
@section('pagename',$get->item)
@section('content')
<?php

    $getItems = array();
    $getVotes = array();

    foreach(range(1,10) as $i){
        if(!empty($get['optionName'.$i])){
            $getItems[] = $get['optionName'.$i];
            $getVotes[] = $get['vote'.$i];
        }
    }
?>
<canvas id="chart"></canvas>
<script>
    var ctx = document.getElementById("chart");
    var myNewChart = new Chart(ctx ,{
        type: 'bar',
        data: {
            labels : ['{!!implode("','",$getItems)!!}'],
            datasets : [{
                label: '投票人數',
                data:[{{implode(',', $getVotes)}}],
                backgroundColor: "rgb(0,0,89)",
                 borderWidth: 10
                
            }],

        },options: {
        }
    });
</script>
@endsection