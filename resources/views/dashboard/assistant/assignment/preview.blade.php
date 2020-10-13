@extends('layouts.app')

@section('title', $assignment->title . ' - Assignment Detail')

@push('styles')
    {{--    <link rel="stylesheet" href="{{ asset('dist/css/dropzone.min.css') }}">--}}
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $assignment->title }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-success" id="timer-body" data-deadline="{{ $assignment->deadline }}">
                        <div style="font-size: xx-large" class="text-center" id="timer">DEADLINE TIMER</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            {!! $assignment->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{--    <script src="{{ asset('dist/js/dropzone.min.js') }}"></script>--}}
    <script>
        var d = new Date($('#timer-body').data('deadline'));
        var countDownDate = new Date(d).getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = "<b>" + days + "</b> Hari : <b>" + hours + "</b> Jam : <b>" +
                minutes + "</b> Menit : <b>" + seconds + "</b> Detik ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                $('#timer').text("Waktu Habis");
                $('#timer-body').removeClass('bg-success').addClass('bg-danger');
            }
        }, 1000);
    </script>
@endpush
