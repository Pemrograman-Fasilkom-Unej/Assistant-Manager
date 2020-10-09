<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Student</h4>
                </div>
                <div class="card-body">
                    {{ $totalStudent }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Submitted</h4>
                </div>
                <div class="card-body">
                    {{ $totalSubmitted }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Unsubmitted</h4>
                </div>
                <div class="card-body">
                    {{ $totalUnsubmitted }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Formats</h4>
                </div>
                <div class="card-body">
                    @foreach($formats as $format)
                        <div class="badge badge-info">{{ $format }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
