<!DOCTYPE html>
<html lang="en">
<head>
    <title>Coming Soon</title>
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Miqdad" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">



</head>
<!-- [ offline-ui ] start -->
<div class="auth-wrapper offline">
    <div class="offline-wrapper">
        <img src="{{ asset('assets/images/maintance/sparcle-1.png') }}" alt="User-Image" class="img-fluid s-img-1">
        <img src="{{ asset('assets/images/maintance/sparcle-2.png') }}" alt="User-Image" class="img-fluid s-img-2">
        <div class="container off-main">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="text-center">
                        <div class="moon"></div>
                        <img src="{{ asset('assets/images/maintance/ship.svg') }}" alt="" class="img-fluid boat-img">
                    </div>
                </div>
            </div>
            <div class="row m-0 justify-content-center off-content">
                <div class="col-sm-12 p-0">
                    <div class="text-center">
                        <h1 class="text-white text-uppercase">Coming Soon</h1>
                        <h5 class="text-white font-weight-normal m-b-30">Fiturnya sek gorong mas :'</h5>
                        <button class="btn btn-primary mb-4" onclick="window.location.href='{{ url()->previous() }}'"><i class="feather icon-arrow-left mr-2" ></i>Back</button>
                    </div>
                </div>
                <div class="sark">
                    <img src="{{ asset('assets/images/maintance/sark.svg') }}" alt="" class="img-fluid img-sark">
                    <div class="bubble"></div>
                </div>
            </div>
        </div>
        <svg width="100%" height="70%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
            <title>Wave</title>
            <defs></defs>
            <path id="feel-the-wave" d="" />
        </svg>
        <svg width="100%" height="70%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wave">
            <title>Wave</title>
            <defs></defs>
            <path id="feel-the-wave-two" d="" />
        </svg>
    </div>
</div>
<!-- [ offline-ui ] end -->
<!-- Required Js -->
<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/jquery.wavify.js') }}"></script>


<script>
    $('#feel-the-wave').wavify({
        color: 'rgba(37, 54, 83, 0.93)',
        speed: .25
    });
    $('#feel-the-wave-two').wavify({
        color: 'rgba(37, 54, 83, .5)',
        speed: .35
    });
</script>
</body>
</html>
