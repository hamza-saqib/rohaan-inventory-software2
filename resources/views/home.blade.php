@extends('layouts.app')

@section('title-meta')
    <title>{{ config('app.name') }} | Home</title>

    <meta name="description" content="this is description">
@endsection

@section('other-css')
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            @include('partials.header')
        </div>
        <div class="wrapper wrapper-content">
            {{-- <div class="row">


                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">Today</span>
                            <h5>Total Users</h5>
                        </div>
                        <div class="ibox-content">
                            <a href="{{ route('users.index') }}">
                                <h1 class="no-margins">{{ $totalUsers }}</h1>
                                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                <small>Total # of website users</small>
                            </a>
                        </div>
                    </div>
                </div>


            </div> --}}
            <h1>Forms</h1>
            <div class="row">
                <a href="{{ route('locations.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Location</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('measurements.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">UOM</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('vendors.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Suplier</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('products.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Item</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('product-categories.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Item Category</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('issue-inventories.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Issue Inventory</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('recieve-inventories.create') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span> Create New</span>
                                    <h2 class="font-bold">Inventory Reciept</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <h1>Reports</h1>
            <div class="row">
            <a href="{{ route('reports.products.ledger') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>By Product</span>
                                    <h2>Item Ledger Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
            <a href="{{ route('reports.products.negative') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>By Product</span>
                                    <h2>Negative Items Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('reports.issue.product') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Issue Inventory</span>
                                    <h2>Item Monthly Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.issue-inventories.category') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Issue Inventory</span>
                                    <h2>Category Wise Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.product') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Item Monthly Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.supplier') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Supplier Monthly Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.recieve-inventories.supplier') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Supplier Sales Tax Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.recieve-inventories.purchaseregister') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Purchase Register Sale Tax Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.recieve-inventories.categorywise') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Category Wise Summary Sales Tax Register Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reports.recieve-inventories.category') }}">
                    <div class="col-lg-3">
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    <span>Inventory Receipt</span>
                                    <h2>Category Wise Purchase Summary Report</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
            </div>
            {{-- <div class="row">
                @if ($paymentIn > $paymentOut)
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h5>Profit</h5>
                            <h2>{{$paymentIn-$paymentOut}} Rs.</h2>
                            <div id="sparkline1"></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h5>Loss</h5>
                            <h2>{{$paymentIn-$paymentOut}} Rs.</h2>
                            <div id="sparkline3"></div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h5 class="m-b-md">Payment In</h5>
                            <h2 class="text-navy">
                                <i class="fa fa-play fa-rotate-270"></i> {{$paymentIn}}
                            </h2>
                            <small>All Payments</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h5 class="m-b-md">Payment Out</h5>
                            <h2 class="text-danger">
                                <i class="fa fa-play fa-rotate-90"></i> {{$paymentOut}}
                            </h2>
                            <small>All Payments</small>
                        </div>
                    </div>
                </div>




            </div> --}}
        </div>

    </div>
    {{-- <div class="small-chat-box fadeInRight animated">

        <div class="heading" draggable="true">
            <small class="chat-date pull-right">
                02.19.2015
            </small>
            Small chat
        </div>

        <div class="content">

            <div class="left">
                <div class="author-name">
                    Monica Jackson <small class="chat-date">
                        10:02 am
                    </small>
                </div>
                <div class="chat-message active">
                    Lorem Ipsum is simply dummy text input.
                </div>

            </div>
            <div class="right">
                <div class="author-name">
                    Mick Smith
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    Lorem Ipsum is simpl.
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Alice Novak
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    Check this stock char.
                </div>
            </div>
            <div class="right">
                <div class="author-name">
                    Anna Lamson
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    The standard chunk of Lorem Ipsum
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Mick Lane
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    I belive that. Lorem Ipsum is simply dummy text.
                </div>
            </div>


        </div>
        <div class="form-chat">
            <div class="input-group input-group-sm"><input type="text" class="form-control"> <span
                    class="input-group-btn"> <button class="btn btn-primary" type="button">Send
                    </button> </span></div>
        </div>

    </div> --}}
    {{-- <div id="small-chat">

        <span class="badge badge-warning pull-right">5</span>
        <a class="open-small-chat">
            <i class="fa fa-comments"></i>

        </a>
    </div> --}}
    {{-- <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-3">

                <li class="active"><a data-toggle="tab" href="#tab-1">
                        Notes
                    </a></li>
                <li><a data-toggle="tab" href="#tab-2">
                        Projects
                    </a></li>
                <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
            </ul>

            <div class="tab-content">


                <div id="tab-1" class="tab-pane active">

                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                        <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                    </div>

                    <div>

                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">

                                    There are many variations of passages of Lorem Ipsum available.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                </div>
                                <div class="media-body">
                                    The point of using Lorem Ipsum is that it has a more-or-less normal.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    Mevolved over the years, sometimes by accident, sometimes on purpose (injected
                                    humour and the like).
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>

                                <div class="media-body">
                                    Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                </div>
                                <div class="media-body">

                                    All the Lorem Ipsum generators on the Internet tend to repeat.
                                    <br>
                                    <small class="text-muted">Today 4:21 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                </div>
                                <div class="media-body">
                                    Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..",
                                    comes from a line in section 1.10.32.
                                    <br>
                                    <small class="text-muted">Yesterday 2:45 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                    <br>
                                    <small class="text-muted">Yesterday 1:10 pm</small>
                                </div>
                            </a>
                        </div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                </div>
                                <div class="media-body">
                                    Uncover many web sites still in their infancy. Various versions have.
                                    <br>
                                    <small class="text-muted">Monday 8:37 pm</small>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

                <div id="tab-2" class="tab-pane">

                    <div class="sidebar-title">
                        <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                    </div>

                    <ul class="sidebar-list">
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.

                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.

                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.

                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-right">NEW</span>
                                <h4>The generated</h4>
                                <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Business valuation</h4>
                                It is a long established fact that a reader will be distracted.

                                <div class="small">Completion with: 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Contract with Company </h4>
                                Many desktop publishing packages and web page editors.

                                <div class="small">Completion with: 48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9 hours ago</div>
                                <h4>Meeting</h4>
                                By the readable content of a page when looking at its layout.

                                <div class="small">Completion with: 14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-primary pull-right">NEW</span>
                                <h4>The generated</h4>
                                <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                There are many variations of passages of Lorem Ipsum available.
                                <div class="small">Completion with: 22%</div>
                                <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                            </a>
                        </li>

                    </ul>

                </div>

                <div id="tab-3" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-gears"></i> Settings</h3>
                        <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                    </div>

                    <div class="setings-item">
                        <span>
                            Show notifications
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example">
                                <label class="onoffswitch-label" for="example">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Disable Chat
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox"
                                    id="example2">
                                <label class="onoffswitch-label" for="example2">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Enable history
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example3">
                                <label class="onoffswitch-label" for="example3">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Show charts
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example4">
                                <label class="onoffswitch-label" for="example4">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Offline users
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example5">
                                <label class="onoffswitch-label" for="example5">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Global search
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example6">
                                <label class="onoffswitch-label" for="example6">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>
                            Update everyday
                        </span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                    id="example7">
                                <label class="onoffswitch-label" for="example7">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <h4>Settings</h4>
                        <div class="small">
                            I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                            And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                            since the 1500s.
                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the
                            like).
                        </div>
                    </div>

                </div>
            </div>

        </div>



    </div> --}}
@endsection


@section('custom-script')
    <script>
        $(document).ready(function() {

            $('.summernote').summernote();

        });

        var edit = function() {
            $('.click2edit').summernote({
                focus: true
            });
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };
    </script>
@endsection
