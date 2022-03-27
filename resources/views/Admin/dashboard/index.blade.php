@extends('admin.layouts.main')
@section('title')
    <title>Dashboard | ASM</title>
@endsection
@section('content')
<div id="chart_div" style="width: 100%; height: 500px; padding-rignt: 10px; padding-left: 10px;"></div>
@endsection

@section('page-script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable(
      @json($dataArr)
    );

    var options = {
        title: 'Thống kê theo học kỳ và bộ môn',
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
  }
</script>
@endsection
