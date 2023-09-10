<div id="signup-chart" style="min-width: 310px; height: 400px; margin: 0 auto; "></div>
        <script>
          Highcharts.chart('signup-chart', {
              chart: {
              type: 'column'
              },
              title: {
              text: 'Monthly Signups'
              },
              xAxis: {
              type: 'category',
              labels: {
                  rotation: -45,
                  style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                  }
              }
              },
              yAxis: {
              min: 0,
              title: {
                  text: 'Number of Signups'
              }
              },
              legend: {
              enabled: false
              },
              series: [{
              name: 'Signups',
              data: <?php echo json_encode($data); ?>,
              dataLabels: {
                  enabled: true,
                  rotation: -90,
                  color: '#FFFFFF',
                  align: 'right',
                  format: '{point.y:.1f}',
                  y: 10,
                  style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                  }
              }
              }]
          });
        </script>