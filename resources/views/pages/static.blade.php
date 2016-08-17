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
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                 ],
                borderWidth: 1        
            }],

        },options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend: {
                display: true,
                labels: {
                    fontColor: 'black'
                }
            },
            margins: {
                left: 20,
                right: 20,
            }
        }
    });
</script>
@endsection