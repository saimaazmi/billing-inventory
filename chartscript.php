<!-- Charts -->
            <script>

                // Sales this month chart
                var months = [ "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"]

                var data = [
                  { y: '2019-01', a: 210, b: 90, c: 200},
                  { y: '2019-02', a: 165, b: 75, c: 200},
                  { y: '2019-03', a: 250, b: 50, c: 200},
                  { y: '2019-04', a: 375, b: 160, c: 200},
                  { y: '2019-05', a: 280, b: 65, c: 200},
                  { y: '2019-06', a: 390, b: 170, c: 200},
                  { y: '2019-07', a: 400, b: 75, c: 200},
                  { y: '2019-08', a: 315, b: 175, c: 200},
                  { y: '2019-09', a: 220, b: 85, c: 200},
                  { y: '2019-10', a: 345, b: 85, c: 200},
                  { y: '2019-11', a: 345, b: 85, c: 200},
                  { y: '2019-12', a: 360, b: 95, c: 200}
                ],
                config = {
                  data: data,
                  xkey: 'y',
                  ykeys: ['a', 'b', 'c'],
                  labels: ['Total clients', 'Total sales', 'Average'],
                  fillOpacity: 0.6,
                  hideHover: 'auto',
                  behaveLikeLine: true,
                  resize: true,
                  pointFillColors:['#ffffff'],
                  pointStrokeColors: ['#2da9e9'],
                  lineColors:['#2da9e9','#0ec8a2','#959595'],
                  barColors:['#2da9e9','#0ec8a2','#959595'],
                  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
                    var month = months[x.getMonth()];
                    return month;
                  },
                  dateFormat: function(x) {
                    var month = months[new Date(x).getMonth()];
                    return month;
                  }
                }

                config.element = 'area-chart';
                Morris.Area(config);
            </script>