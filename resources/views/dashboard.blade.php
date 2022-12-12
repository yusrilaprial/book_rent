@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
<h1>Welcome, {{ Auth::user()->username }}</h1>
    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal-bookmark"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Books</div>
                        <div class="card-count">{{ $book_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Category</div>
                        <div class="card-count">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Users</div>
                        <div class="card-count">{{ $user_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mt-4 col-12">
            <h2>#Rent Grafik</h2>
            <canvas id="myChart"></canvas>
        </div>
        <div class="mt-4 col-12">
            <h2>#New Rent Log</h2>
            <x-rent-log-table :rentlogs='$rentlogs'/>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["7 Hari Lalu", "6 Hari Lalu", "5 Hari Lalu", "4 Hari Lalu", "3 Hari Lalu", "2 Hari Lalu", "1 Hari Lalu", "Hari Ini"],
				datasets: [{
					label: 'Jumlah Rental Buku',
					data: [{{ $tujuhhari }}, {{ $enamhari }}, {{ $limahari }}, {{ $empathari }}, {{ $tigahari }}, {{ $duahari }}, {{ $satuhari }}, {{ $sekarang }}],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
    </script>
@endsection