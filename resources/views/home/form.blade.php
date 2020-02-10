<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assistant Manager - @yield('title') </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dropzone.min.css') }}">

</head>
<div class="auth-wrapper maintance">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto blanditiis culpa
                            dolores eius est harum labore minima nam nesciunt nobis numquam praesentium provident, quis
                            ratione sequi temporibus vero voluptatem voluptates.
                        </div>
                    </div>
                    <div class="card-footer bg-c-red" id="timer-body">
                        <div class="counter text-center">
                            <h4 id="timer" class="text-white m-0">Waktu Habis</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Pengumpulan Tugas</h5>
                    </div>
                    <div class="card-body">
                        <div class="bt-wizard" id="form-wizard">
                            <ul class="nav nav-pills nav-fill mb-3">
                                <li class="nav-item">
                                    <a href="#progress-t-tab1" class="nav-link has-ripple active" data-toggle="tab">
                                        Identitas
                                        <span class="ripple ripple-animate" style="height: 252.469px; width: 252.469px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -102.234px; left: 65.7655px;"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#progress-t-tab2" class="nav-link has-ripple" data-toggle="tab">
                                        Upload File
                                        <span class="ripple ripple-animate" style="height: 263.141px; width: 263.141px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -113.571px; left: -49.0393px;"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#progress-t-tab3" class="nav-link has-ripple" data-toggle="tab">
                                        Selesai
                                        <span class="ripple ripple-animate" style="height: 240.875px; width: 240.875px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -104.438px; left: -41.0469px;"></span>
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

                                    <div class="bar--upload progress-bar bg-success" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 0%;"></div>
                                    <div class="percent--upload mb-4"></div>
                                    <button class="col-12 mb-4 btn btn-primary text-white" id="btn---upload">Upload</button>
                                </div>
                                <div class="tab-pane" id="progress-t-tab3">
                                    <form class="text-center">
                                        <i class="feather icon-check-circle display-3 text-success"></i>
                                        <h5 class="mt-3">Registration Done! . .</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing</p>
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Subscribe
                                                Newslatter</label>
                                        </div>
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
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/jquery.bootstrap.wizard.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/plugins/dropzone-amd-module.min.js') }}"></script>--}}
<script src="{{ asset('dist/js/dropzone.js') }}"></script>
<script>
    var nim = "";
    var status = true;

    var drop = Dropzone.options.dropFile = {
        url: '{{ route('task.upload', ['token' => $task->token]) }}',
        autoProcessQueue: false,
        paramName: 'upload_file',
        maxFiles: 1,
        maxFilesize: 10,
        acceptedFiles: "{{ $task->file_type_format }}",
        addRemoveLinks: true,
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                alert("No more files please!");
            });
            this.on("sending", function (file, xhr, formData) {
                formData.append("id", nim);
            });
        },
        accept: function (file, done) {
            console.log(file);
            done();
        },
        success: (response) => {
            console.log(response);
        },
        uploadprogress(file, progress, bytesSent) {
            console.log(progress);
        },
        removedFile: (file) => {
            console.log(file);
        },
        error: (file, errorMessage, xhr) => {
            console.log(file);
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

            if(index == 1){
                $('.button-next').addClass('disabled');
                $('.button-previous').addClass('disabled');
            }
        },
        onNext: function (tab, navigation, index) {
            if (index == 1) {
                if (!$('#nim-input').val()) {
                    $('#nim-input').focus();
                    $('.form-1').addClass('was-validated');
                    return false;
                } else {
                    $.post({
                        url: '{{ route('task.check', ['token' => $task->token]) }}',
                        data: {
                            'id': $('#nim-input').val(),
                            '_token': '{{ csrf_token() }}'
                        },
                        async: false,
                        success: (response) => {
                            console.log(response);
                            if (response.status === "success") {
                                nim = response.data.student.nim;
                                status = true;
                            } else {
                                status = false;
                            }
                        }
                    });
                }
                if (status === false) {
                    return false;
                }
                return true;
            }

            if (index == 2) {

            }
        }
    });

    $('#btn---upload').click(function(){
        var myDropzone = Dropzone.forElement(".dropzone");
        myDropzone.processQueue();
    });
</script>
</html>
