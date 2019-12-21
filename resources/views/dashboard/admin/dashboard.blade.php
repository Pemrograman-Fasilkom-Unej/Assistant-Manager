@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')

@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Sales Summary</h4>
                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <ul class="list-inline font-12 dl mr-3 mb-0">
                                <li class="list-inline-item text-info"><i class="fa fa-circle"></i> Iphone</li>
                                <li class="list-inline-item text-primary"><i class="fa fa-circle"></i> Ipad</li>
                            </ul>
                            <div class="dl">
                                <select class="custom-select">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-4">
                            <h1 class="mb-0 mt-4">$6,890.68</h1>
                            <h6 class="font-light text-muted">Current Month Earnings</h6>
                            <h3 class="mt-4 mb-0">1,540</h3>
                            <h6 class="font-light text-muted">Current Month Sales</h6>
                            <a class="btn btn-info mt-3 p-15 pl-4 pr-4 mb-3" href="javascript:void(0)">Last Month
                                Summary</a>
                        </div>
                        <!-- column -->
                        <div class="col-lg-8">
                            <div class="campaign ct-charts"></div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Info Box -->
                <!-- ============================================================== -->
                <div class="card-body border-top">
                    <div class="row mb-0">
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2"><span class="text-orange display-5"><i
                                                class="mdi mdi-wallet"></i></span></div>
                                <div><span>Wallet Balance</span>
                                    <h3 class="font-medium mb-0">$3,567.53</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2"><span class="text-cyan display-5"><i class="mdi mdi-star-circle"></i></span>
                                </div>
                                <div><span>Referral Earnings</span>
                                    <h3 class="font-medium mb-0">$769.08</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2"><span class="text-info display-5"><i
                                                class="mdi mdi-shopping"></i></span></div>
                                <div><span>Estimate Sales</span>
                                    <h3 class="font-medium mb-0">5489</h3></div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2"><span class="text-primary display-5"><i
                                                class="mdi mdi-currency-usd"></i></span></div>
                                <div><span>Earnings</span>
                                    <h3 class="font-medium mb-0">$23,568.90</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Email campaign chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Email Campaigns</h4>
                            <h5 class="card-subtitle">Overview of Email Campaigns</h5>
                        </div>
                        <div class="ml-auto align-items-center">
                            <div class="dl">
                                <select class="custom-select">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <div class="row mt-5">
                        <!-- column -->
                        <div class="col-lg-6">
                            <div id="visitor" style="height:290px; width:100%;" class="mt-3"></div>
                        </div>
                        <!-- column -->
                        <div class="col-lg-6">
                            <h1 class="display-6 mb-0 font-medium">45%</h1>
                            <span>Open Ratio for Campaigns</span>
                            <ul class="list-style-none">
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-cyan font-12"></i> Open Ratio <span
                                            class="float-right">45%</span></li>
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-info font-12"></i> Clicked Ratio
                                    <span class="float-right">14%</span></li>
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-orange font-12"></i> Un-Open Ratio
                                    <span class="float-right">25%</span></li>
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-primary font-12"></i> Bounced Ratio
                                    <span class="float-right">17%</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- column -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-6">
            <div class="card card-hover">
                <div class="card-body"
                     style="background:url(../../assets/images/background/active-bg.png) no-repeat top center;">
                    <div class="pt-3 text-center">
                        <i class="mdi mdi-file-chart display-4 text-orange d-block"></i>
                        <span class="display-4 d-block font-medium">368</span>
                        <span>Active Visitors on Site</span>
                        <!-- Progress -->
                        <div class="progress mt-5" style="height:4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 15%" aria-valuenow="15"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-orange" role="progressbar" style="width: 30%" aria-valuenow="30"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- Progress -->
                        <!-- row -->
                        <div class="row mt-4 mb-3">
                            <!-- column -->
                            <div class="col-4 border-right text-left">
                                <h3 class="mb-0 font-medium">60%</h3>Desktop
                            </div>
                            <!-- column -->
                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">28%</h3>Mobile
                            </div>
                            <!-- column -->
                            <div class="col-4 text-right">
                                <h3 class="mb-0 font-medium">12%</h3>Tablet
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                           class="waves-effect waves-light mt-3 btn btn-lg btn-info accent-4 mb-3">View More Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Email campaign chart -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Ravenue - page-view-bounce rate -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-lg-4">
            <div class="card bg-info text-white  card-hover">
                <div class="card-body">
                    <h4 class="card-title">Revenue Statistics</h4>
                    <div class="d-flex align-items-center mt-4">
                        <div class="" id="ravenue"></div>
                        <div class="ml-auto">
                            <h3 class="font-medium white-text mb-0">$351</h3><span class="white-text op-5">Jan 10  - Jan  20</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-lg-4">
            <div class="card bg-cyan text-white  card-hover">
                <div class="card-body">
                    <h4 class="card-title">Page Views</h4>
                    <h3 class="white-text mb-0"><i class="ti-arrow-up"></i> 6548</h3>
                </div>
                <div class="mt-3" id="views"></div>
            </div>
        </div>
        <!-- column -->
        <div class="col-lg-4">
            <div class="card  card-hover">
                <div class="card-body">
                    <h4 class="card-title">Bounce Rate</h4>
                    <div class="d-flex no-block align-items-center mt-4">
                        <div class="">
                            <h3 class="font-medium mb-0">56.33%</h3><span class="">Total Bounce</span></div>
                        <div class="ml-auto">
                            <div style="max-width:150px; height:60px;" class="mb-5">
                                <canvas id="bouncerate"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Ravenue - page-view-bounce rate -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Table -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Projects of the Month</h4>
                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <select class="custom-select">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle">
                            <thead>
                            <tr class="border-0">
                                <th class="border-0">Team Lead</th>
                                <th class="border-0">Project</th>
                                <th class="border-0">Team</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Weeks</th>
                                <th class="border-0">Budget</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-2"><img src="../../assets/images/users/d1.jpg" alt="user"
                                                               class="rounded-circle" width="45"/></div>
                                        <div class="">
                                            <h5 class="mb-0 font-16 font-medium">Hanna Gover</h5>
                                            <span>hgover@gmail.com</span></div>
                                    </div>
                                </td>
                                <td>Elite Admin</td>
                                <td>
                                    <div class="popover-icon">
                                        <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                        <a class="btn-circle btn btn-cyan text-white popover-item"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn-circle btn p-0 popover-item" href="javascript:void(0)"><img
                                                    src="../../assets/images/users/1.jpg" class="rounded-circle"
                                                    width="39" alt=""/></a>
                                        <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top"
                                       title="In Progress"></i></td>
                                <td>35</td>
                                <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-2"><img src="../../assets/images/users/d2.jpg" alt="user"
                                                               class="rounded-circle" width="45"/></div>
                                        <div class="">
                                            <h5 class="mb-0 font-16 font-medium">Daniel Kristeen</h5><span>Kristeen@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Elite Admin</td>
                                <td>
                                    <div class="popover-icon">
                                        <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                        <a class="btn-circle btn btn-primary text-white popover-item"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td><i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top"
                                       title="Active"></i></td>
                                <td>35</td>
                                <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-2"><img src="../../assets/images/users/d3.jpg" alt="user"
                                                               class="rounded-circle" width="45"/></div>
                                        <div class="">
                                            <h5 class="mb-0 font-16 font-medium">Julian Josephs</h5><span>Josephs@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Elite Admin</td>
                                <td>
                                    <div class="popover-icon">
                                        <a class="btn-circle btn btn-info" href="javascript:void(0)">SS</a>
                                        <a class="btn-circle btn btn-cyan text-white popover-item"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn-circle btn btn-orange text-white popover-item"
                                           href="javascript:void(0)">RP</a>
                                        <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td><i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top"
                                       title="Active"></i></td>
                                <td>35</td>
                                <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-2"><img src="../../assets/images/users/2.jpg" alt="user"
                                                               class="rounded-circle" width="45"/></div>
                                        <div class="">
                                            <h5 class="mb-0 font-16 font-medium">Jan Petrovic</h5>
                                            <span>hgover@gmail.com</span></div>
                                    </div>
                                </td>
                                <td>Elite Admin</td>
                                <td>
                                    <div class="popover-icon">
                                        <a class="btn-circle btn btn-orange text-white" href="javascript:void(0)">RP</a>
                                        <a class="btn-circle btn btn-outline-secondary" href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td><i class="fa fa-circle text-orange" data-toggle="tooltip" data-placement="top"
                                       title="In Progress"></i></td>
                                <td>35</td>
                                <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Table -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Comments</h4>
                </div>
                <div class="comment-widgets scrollable" style="height:560px;">
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row mt-0">
                        <div class="p-2"><img src="../../assets/images/users/1.jpg" alt="user" width="50"
                                              class="rounded-circle"></div>
                        <div class="comment-text w-100">
                            <h6 class="font-medium">James Anderson</h6>
                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">April 14, 2016</span> <span
                                        class="label label-rounded label-primary">Pending</span> <span
                                        class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img src="../../assets/images/users/4.jpg" alt="user" width="50"
                                              class="rounded-circle"></div>
                        <div class="comment-text active w-100">
                            <h6 class="font-medium">Michael Jorden</h6>
                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                            <div class="comment-footer ">
                                <span class="text-muted float-right">April 14, 2016</span>
                                <span class="label label-success label-rounded">Approved</span>
                                <span class="action-icons active">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-close"></i></a>
                                                    <a href="javascript:void(0)"><i
                                                                class="ti-heart text-danger"></i></a>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img src="../../assets/images/users/5.jpg" alt="user" width="50"
                                              class="rounded-circle"></div>
                        <div class="comment-text w-100">
                            <h6 class="font-medium">Johnathan Doeting</h6>
                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">April 14, 2016</span>
                                <span class="label label-rounded label-danger">Rejected</span>
                                <span class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img src="../../assets/images/users/1.jpg" alt="user" width="50"
                                              class="rounded-circle"></div>
                        <div class="comment-text w-100">
                            <h6 class="font-medium">James Anderson</h6>
                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">April 14, 2016</span> <span
                                        class="label label-rounded label-primary">Pending</span> <span
                                        class="action-icons">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>
                                                </span></div>
                        </div>
                    </div>
                    <!-- Comment Row -->
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img src="../../assets/images/users/4.jpg" alt="user" width="50"
                                              class="rounded-circle"></div>
                        <div class="comment-text active w-100">
                            <h6 class="font-medium">Michael Jorden</h6>
                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                            <div class="comment-footer ">
                                <span class="text-muted float-right">April 14, 2016</span>
                                <span class="label label-success label-rounded">Approved</span>
                                <span class="action-icons active">
                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)"><i class="icon-close"></i></a>
                                                    <a href="javascript:void(0)"><i
                                                                class="ti-heart text-danger"></i></a>
                                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->
                </div>
            </div>
        </div>
        <!-- column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Chats</h4>
                    <div class="chat-box scrollable position-relative" style="height:475px;">
                        <!--chat Row -->
                        <ul class="chat-list">
                            <!--chat Row -->
                            <li class="chat-item">
                                <div class="chat-img"><img src="../../assets/images/users/1.jpg" alt="user"></div>
                                <div class="chat-content">
                                    <h6 class="font-medium">James Anderson</h6>
                                    <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing
                                        &amp; type setting industry.
                                    </div>
                                </div>
                                <div class="chat-time">10:56 am</div>
                            </li>
                            <!--chat Row -->
                            <li class="chat-item">
                                <div class="chat-img"><img src="../../assets/images/users/2.jpg" alt="user"></div>
                                <div class="chat-content">
                                    <h6 class="font-medium">Bianca Doe</h6>
                                    <div class="box bg-light-info">It’s Great opportunity to work.</div>
                                </div>
                                <div class="chat-time">10:57 am</div>
                            </li>
                            <!--chat Row -->
                            <li class="odd chat-item">
                                <div class="chat-content">
                                    <div class="box bg-light-inverse">I would love to join the team.</div>
                                    <br>
                                </div>
                            </li>
                            <!--chat Row -->
                            <li class="odd chat-item">
                                <div class="chat-content">
                                    <div class="box bg-light-inverse">Whats budget of the new project.</div>
                                    <br>
                                </div>
                                <div class="chat-time">10:59 am</div>
                            </li>
                            <!--chat Row -->
                            <li class="chat-item">
                                <div class="chat-img"><img src="../../assets/images/users/3.jpg" alt="user"></div>
                                <div class="chat-content">
                                    <h6 class="font-medium">Angelina Rhodes</h6>
                                    <div class="box bg-light-info">Well we have good budget for the project</div>
                                </div>
                                <div class="chat-time">11:00 am</div>
                            </li>
                            <!--chat Row -->
                            <!-- <div id="someDiv"></div> -->
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-9">
                            <div class="input-field mt-0 mb-0">
                                <input type="text" id="textarea1" placeholder="Type and enter"
                                       class="form-control border-0">
                            </div>
                        </div>
                        <div class="col-3">
                            <a class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"><i
                                        class="fas fa-paper-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
@endsection

@section('js')

@endsection