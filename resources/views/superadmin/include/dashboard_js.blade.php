@section('js')
    <script src="{{ asset('assets/dashboard/') }}/vendor/graph/chart.min.js"></script>
    <script>
        $(function ($) {
          'use strict';
          /*====  Line chart for home > chart page =====*/
          var chartLine1 = document.getElementById("lineChart2");
          var lineChart = new Chart(chartLine1, {
            type: 'line',
            data: {
              labels: [],
              datasets: [{
                label: "Charge Volume",
                fill: false,
                lineTension: 0.4,
                borderColor: '#00B9F1',
                backgroundColor: '#00B9F1',
                pointBorderColor: '#fff',
                pointBackgroundColor: '#00B9F1',
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [],
              }]
            },
            options: {
              // showLines: false,
              scales: {
                yAxes: [{
                  ticks: {
                    // reverse: true,
                    beginAtZero: false,
                    autoSkip:false,
                    legend: {
                      position: 'right',
                    },
                    callback: function(value) {
                       var ranges = [
                          { divider: 1e6, suffix: 'M' },
                          { divider: 1e3, suffix: 'k' }
                       ];
                       function formatNumber(n) {
                          for (var i = 0; i < ranges.length; i++) {
                             if (n >= ranges[i].divider) {
                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                             }
                          }
                          return n;
                       }
                       // return formatNumber(value);
                       return '$' + formatNumber(value);
                    }
                  }
                }],
                xAxes: [{
                  ticks: {
                    autoSkip:false,
                  }
                }]
              },
              responsive: true,
              animation: {
                animateScale: true
              }
            },
          });

          ajax_linechart(lineChart);


          function ajax_linechart(chart){
            $.ajax({
              url:"{{route('superadmin.dashboard.linechart')}}",
              method:"POST",
              data:{
                "_token":"{{csrf_token()}}"
              },
              dataType:"json",
              success:function(res){
                
                //console.log(res);
                chart.data.labels = res.labels;
                chart.data.datasets[0].data = res.sum;
                chart.update(); 
              }
            });
          }

          /*====  End line chart =====*/
          /*====  Start Bar chart > chart js =====*/
          var chartPageBar = document.getElementById("ChartPageBar");
          Chart.defaults.global.animation.duration = 800;
          var chart1 = new Chart(chartPageBar, {
            type: 'bar',
            data: {
              labels: [],
              datasets: []
            },
            options: {
              legend: {
                labels: {
                  usePointStyle: true
                }
              },
              layout: {
                 padding: {
                    left: 10
                 }
              },
              scales: {
                  yAxes: [{
                     ticks: {
                        callback: function(value) {
                           var ranges = [
                              { divider: 1e6, suffix: 'M' },
                              { divider: 1e3, suffix: 'k' }
                           ];
                           function formatNumber(n) {
                              for (var i = 0; i < ranges.length; i++) {
                                 if (n >= ranges[i].divider) {
                                    return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                 }
                              }
                              return n;
                           }
                           return formatNumber(value);
                           // return '$' + formatNumber(value);
                        }
                     }
                  }]
              },
            }
          });

          var bg_colors=['#00B9F1','#00cc99','#4186AF','#FFBD59','#EB4444'];
          ajax_chart(chart1);


          function ajax_chart(chart){
            $.ajax({
              url:"{{route('superadmin.dashboard.barchart1')}}",
              method:"POST",
              data:{
                "_token":"{{csrf_token()}}"
              },
              dataType:"json",
              success:function(res){
                console.log(res);
                chart.data.labels = res.labels;
                for(var i=0;i<res.sum.length;i++){
                  chart.data.datasets.push({});
                  chart.data.datasets[i].label = res.label[i];
                  chart.data.datasets[i].fill= false;
                  chart.data.datasets[i].lineTension= 0.3;
                  chart.data.datasets[i].backgroundColor= bg_colors[i];
                  chart.data.datasets[i].borderColor= bg_colors[i];
                  chart.data.datasets[i].pointBorderColor= bg_colors[i];
                  chart.data.datasets[i].pointBackgroundColor= "#fff";
                  chart.data.datasets[i].pointHoverBackgroundColor= bg_colors[i];
                  chart.data.datasets[i].pointHoverBorderColor= bg_colors[i];
                  chart.data.datasets[i].data = res.sum[i];
                }
                chart.update(); 
              }
            });
          }









      var barChart2 = document.getElementById("barChart2");
          Chart.defaults.global.animation.duration = 800;
          var mychart = new Chart(barChart2, {
            type: 'bar',
            data: {
              labels: [],
              datasets: []
            },
            options: {
              legend: {
                labels: {
                  usePointStyle: true
                }
              },
              layout: {
                 padding: {
                    left: 10
                 }
              },
              scales: {
                  yAxes: [{
                     ticks: {
                        callback: function(value) {
                           var ranges = [
                              { divider: 1e6, suffix: 'M' },
                              { divider: 1e3, suffix: 'k' }
                           ];
                           function formatNumber(n) {
                              for (var i = 0; i < ranges.length; i++) {
                                 if (n >= ranges[i].divider) {
                                    return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                 }
                              }
                              return n;
                           }
                           // return formatNumber(value);
                           return '$' + formatNumber(value);
                        }
                     }
                  }]
              },
            }
          });


          ajax_chart2(mychart);


          function ajax_chart2(chart){
            var label=["Billed","Paid"];
            $.ajax({
              url:"{{route('superadmin.dashboard.barchart2')}}",
              method:"POST",
              data:{
                "_token":"{{csrf_token()}}"
              },
              dataType:"json",
              success:function(res){
                //console.log(res);
                chart.data.labels = res.labels;
                for(var i=0;i<res.sum.length;i++){
                  chart.data.datasets.push({});
                  chart.data.datasets[i].label = label[i];
                  chart.data.datasets[i].fill= false;
                  chart.data.datasets[i].lineTension= 0.3;
                  chart.data.datasets[i].backgroundColor= bg_colors[i];
                  chart.data.datasets[i].borderColor= bg_colors[i];
                  chart.data.datasets[i].pointBorderColor= bg_colors[i];
                  chart.data.datasets[i].pointBackgroundColor= "#fff";
                  chart.data.datasets[i].pointHoverBackgroundColor= bg_colors[i];
                  chart.data.datasets[i].pointHoverBorderColor= bg_colors[i];
                  chart.data.datasets[i].data = res.sum[i];
                }
                chart.update(); 
              }
            });
          }
        });


    </script>
    <!-- <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            let data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Client', 8],
                ['Staff', 2],
                ['Activity', 4],
                ['Report', 2],
                ['Setting', 8]
            ]);
            const options = {
                title: 'Pie Chart',
                is3D: true
            };
            const chart1 = new google.visualization.PieChart(document.querySelector('.piechart1'));
            const chart2 = new google.visualization.PieChart(document.querySelector('.piechart2'));
            const chart3 = new google.visualization.PieChart(document.querySelector('.piechart3'));
            chart1.draw(data, options);
            chart2.draw(data, options);
            chart3.draw(data, options);
        }
    </script> -->
@endsection