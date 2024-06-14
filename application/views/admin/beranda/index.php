<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tgl', 'Sales', 'Expenses','jos', 'gandos'],
          ['01/01/22',  1000,      400, 300, 400],
          ['02/01/22',  1170,      460, 330, 440],
          ['03/01/22',  660,       1120, 500, 600],
          ['04/01/22',  1030,      540, 360, 490],
          ['05/01/22',  1030,      540, 360, 490],
          ['06/01/22',  1030,      540, 360, 490],
          ['07/01/22',  1030,      540, 360, 490],
          ['08/01/22',  1030,      540, 360, 490],
          ['09/01/22',  1030,      540, 360, 490],
          ['10/01/22',  1030,      540, 360, 490],
          ['11/01/22',  1030,      540, 360, 490],
          ['12/01/22',  1030,      540, 360, 490],
          ['13/01/22',  1030,      540, 360, 490],
          ['14/01/22',  1030,      540, 360, 490],
          ['15/01/22',  1030,      540, 360, 490],
          ['16/01/22',  1030,      540, 360, 490],
          ['17/01/22',  1030,      540, 360, 490],
          ['18/01/22',  1030,      540, 360, 490],
          ['19/01/22',  1030,      540, 360, 490],
          ['20/01/22',  1030,      540, 360, 490],
          ['21/01/22',  1030,      540, 360, 490],
          ['22/01/22',  1030,      540, 360, 490],
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>