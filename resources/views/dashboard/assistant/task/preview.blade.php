<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assistant Manager - PREVIEW - {{ request()->title }} </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dropzone.min.css') }}">
    <style>
        .navigation-wizard {
            pointer-events: none;
            cursor: default;
            text-decoration: none;
        }
    </style>
</head>
<div class="auth-wrapper maintance">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong>THIS IS A PREVIEW</strong>.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>{{ request()->title }}</h2>
                        <p>{!! request()->description !!}</p>
                        <p>
                            <strong>Format Pengumpulan : </strong>
                            @foreach(request()->datatypes as $type)
                                <span class="pcoded-badge badge badge-primary">{{ $type }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="card-footer bg-c-green" id="timer-body">
                        <div class="counter text-center">
                            <h4 id="timer" class="text-white m-0">Deadline Time</h4>
                        </div>
                    </div>
                </div>
            </div>

            @if(now()->isBefore(request()->deadline))

                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pengumpulan Tugas</h5>
                        </div>
                        <div class="card-body">
                            <div class="bt-wizard" id="form-wizard">
                                <ul class="nav nav-pills nav-fill mb-3">
                                    <li class="nav-item">
                                        <a href="#progress-t-tab1" class="nav-link has-ripple active navigation-wizard"
                                           data-toggle="tab">
                                            Identitas
                                            <span class="ripple ripple-animate"
                                                  style="height: 252.469px; width: 252.469px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -102.234px; left: 65.7655px;"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#progress-t-tab2" class="nav-link has-ripple navigation-wizard"
                                           data-toggle="tab">
                                            Upload File
                                            <span class="ripple ripple-animate"
                                                  style="height: 263.141px; width: 263.141px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -113.571px; left: -49.0393px;"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#progress-t-tab3" class="nav-link has-ripple navigation-wizard"
                                           data-toggle="tab">
                                            Selesai
                                            <span class="ripple ripple-animate"
                                                  style="height: 240.875px; width: 240.875px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -104.438px; left: -41.0469px;"></span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="bar" class="bt-wizard progress mb-3" style="height:6px">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 33.3333%;"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="progress-t-tab1">
                                        <form>
                                            <div class="form-group row">
                                                <label for="progress-t-name" class="col-sm-3 col-form-label">NIM</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nim-input"
                                                           placeholder="Masukan NIM">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="progress-t-tab2">
                                        <form action="" class="dropzone" enctype="multipart/form-data" id="drop-file"
                                              method="post">
                                            @csrf
                                        </form>

                                        <div class="form-group mt-2">
                                            <label for="description">Keterangan</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                      maxlength="32"
                                                      placeholder="Keterangan pada tugas anda (tidak wajib)"></textarea>
                                        </div>

                                        <button class="col-12 mb-4 btn btn-primary text-white" id="btn---upload">
                                            Upload
                                        </button>
                                    </div>
                                    <div class="tab-pane" id="progress-t-tab3">
                                        <form class="text-center">
                                            <i class="feather icon-check-circle display-3 text-success"></i>
                                            <h5 class="mt-3">Pengumpulan Tugas Berhasil</h5>
                                            <p>Terima kasih telah mengumpulkan tugas.</p>
                                        </form>
                                    </div>
                                    <div class="row justify-content-between btn-page">
                                        <div class="col-sm-6">
                                            <a href="#!" class="btn btn-primary button-previous disabled text-white">Previous</a>
                                        </div>
                                        <div class="col-sm-6 text-md-right">
                                            <a href="#!" class="btn btn-primary button-next text-white">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/jquery.bootstrap.wizard.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('dist/js/dropzone.js') }}"></script>
<script>
    var nim = "";
    var status = true;

    var drop = Dropzone.options.dropFile = {
        url: '{{ route('task.upload', ['token' => uniqid()]) }}',
        autoProcessQueue: false,
        paramName: 'upload_file',
        maxFiles: 1,
        maxFilesize: 10,
        acceptedFiles: "{{ implode(', ', request()->datatypes) }}",
        addRemoveLinks: true,
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                notify("Upload maksimal 1 file", "danger");
            });
            this.on("sending", function (file, xhr, formData) {
                formData.append("id", nim);
                formData.append("comment", $('#description').val());
            });
        },
        accept: function (file, done) {
            done();
        },
        success: (file, response, xhr) => {
            if (response.status === "success") {
                $('.button-next').removeClass('disabled');
                notify(response.message, "success");
            } else {
                notify(response.message, "danger");
            }
        },
        removedFile: (file) => {
            console.log(file);
        },
        error: (file, errorMessage, xhr) => {
            notify(errorMessage, "danger");
            $('#description').removeAttr('readonly');
            $('#btn---upload').removeClass('disabled');
        }
    };

    $('#form-wizard').bootstrapWizard({
        withVisible: false,
        'nextSelector': '.button-next',
        'previousSelector': '.button-previous',
        'firstSelector': '.button-first',
        'lastSelector': '.button-last',
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#form-wizard .progress-bar').css({
                width: $percent + '%'
            });

            if (index === 1) {
                $('.button-next').addClass('disabled');
                $('.button-previous').addClass('disabled');
            }

            if (index === 2) {
                $('.button-previous').addClass('disabled');
            }
        },
        onNext: function (tab, navigation, index) {
            if (index === 1) {
                notify('Fungsi ini tidak berfungsi di halaman <em>Preview<em>.', 'danger');
                return false;
            }

            if (index >= 2) {
                return false;
            }
        }
    });

    function notify(message, type) {
        $.notify({
            message: message
        }, {
            type: type,
            allow_dismiss: false,
            label: 'Cancel',
            className: 'btn-xs btn-inverse',
            placement: {
                from: 'top',
                align: 'right'
            },
            delay: 2500,
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            },
            offset: {
                x: 30,
                y: 30
            }
        });
    };

    $('#btn---upload').click(function () {
        var myDropzone = Dropzone.forElement(".dropzone");
        // myDropzone.processQueue();
        notify("Upload dimulai silahkan tunggu hingga selesai", "primary");
        $('#description').attr('readonly', 'readonly');
        $(this).addClass('disabled');
    });
</script>

<script>
    // Set the date we're counting down to
    var d = new Date("{{ request()->deadline }}");
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
            $('#timer-body').removeClass('bg-c-green').addClass('bg-c-red');
        }
    }, 1000);

    $(document).ready(function () {
        $('.navigation---link').addClass('disabled');
    });
</script>
</html>
