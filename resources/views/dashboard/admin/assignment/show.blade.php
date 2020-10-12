@extends('layouts.app')

@section('title', 'Assignment')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $assignment->title }}</h1>

            <div class="section-header-breadcrumb">
                <button class="btn text-right btn-primary" onclick="window.location = '{{ route('dashboard.admin.assignment.preview', $assignment) }}'">Preview</button>
                <button class="btn text-right btn-warning" onclick="window.location = '{{ route('dashboard.admin.assignment.edit', $assignment) }}'">Edit</button>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-success" id="timer-body" data-deadline="{{ $assignment->deadline }}">
                        <div style="font-size: xx-large" class="text-center" id="timer">DEADLINE TIMER</div>
                    </div>
                </div>
            </div>
            @livewire('assignment-detail-stats-card', compact('assignment'))

            @livewire('assignment-detail-statistic-card', compact('assignment'))

            @livewire('assignment-detail-submission-table', compact('assignment'))
        </div>
    </section>
    @livewire('assignment-detail-assign-score-modal', compact('assignment'))
@endsection

@push('scripts')
    <script>
        var d = new Date($('#timer-body').data('deadline'));
        var countDownDate = new Date(d).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

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
