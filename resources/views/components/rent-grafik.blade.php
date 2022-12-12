<div>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js"></script>
    <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sekarang', '1 hari yang lalu', '2 hari yang lalu', '3 hari yang lalu', '4 hari yang lalu', '5 hari yang lalu', '6 hari yang lalu', '7 hari yang lalu'],
            datasets: [{
                label: 'Pemasukan',
                data: [8, 7, 6, 5, 4, 3, 2, 1],
                // data: [{{ $data['sekarang'] }}, {{ $data['satuhari'] }}, {{ $data['duahari'] }}, {{ $data['tigahari'] }}, {{ $data['empathari'] }}, {{ $data['limahari'] }}, {{ $data['enamhari'] }}, {{ $data['tujuhhari'] }}],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>    
</div>