@extends('layouts.app')

@section('title', 'Assignment')

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
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Assignment Detail</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li>
                                    <b>Deadline : </b>
                                    <b class="float-right">{{ $assignment->deadline->format('d F Y - H:i') }}</b>
                                </li>
                                <li>
                                    <b>Status :</b>
                                    <div
                                        class="badge badge-{{ $assignment->submissionStatus(\Auth::id())['badge'] }} float-right">
                                        {{ $assignment->submissionStatus(\Auth::id())['value'] }}
                                    </div>
                                </li>
                                <li>
                                    <b>Score : </b>
                                    <b class="float-right">
                                        {{ optional($submission)->score ?? ' - ' }}
                                    </b>
                                </li>
                                @if(!is_null($submission))
                                    <li>
                                        <b>Submission : </b>
                                        <b class="float-right">
                                            <a href="{{ $submission->file_url }}" class="btn btn-primary"
                                               target="_blank">
                                                Download
                                            </a>
                                        </b>
                                    </li>
                                    <li>
                                        <b>Comment : </b>
                                        <p class="float-right">
                                            {{ $submission->comment ?? ' - ' }}
                                        </p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                @if(!$assignment->isComplete())
                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Submit / Resubmit Assignment</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.student.assignment.submit', $assignment) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="file-upload">File</label>
                                        <input type="file" id="file-upload" name="uploaded_file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment-text">Comment</label>
                                        <textarea name="comment" id="comment-text" cols="30" style="height: 100px"
                                                  class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
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
