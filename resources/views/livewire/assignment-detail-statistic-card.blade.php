@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/chart.min.css') }}">
@endpush

<div class="row">
    <div class="col-lg-8 col-md-8 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Submission Statistics per Days</h4>
                <div class="card-header-action">

                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/js/chart.min.js') }}"></script>
    <script>
        var statistics_chart = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(statistics_chart, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabel) !!},
                datasets: [{
                    label: 'Submission',
                    data: {!! json_encode($chartValue) !!},
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
        });
    </script>
@endpush
