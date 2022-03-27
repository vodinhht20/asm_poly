@extends('layouts.main')
@section('title')
    <title>welcome Poly App | Nơi trưng bài dự án sinh viên</title>
@endsection
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Bộ môn', 'Số lượn dự án'],
      ['Thiết kế website', 6],
    ]);

    var options = {
      chart: {
        title: 'Company Performance',
        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
<div id="columnchart_material" style="width: 800px; height: 500px;"></div>
@endsection
