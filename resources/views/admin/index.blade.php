@extends('admin.layouts.master')


@section('main-content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">All Priented Information</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $information_backup ?? "" }}</h1>
                                </div>
                            </div>
                            <div id="sparkline-revenue"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">All Information</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $information ?? "" }}</h1>
                                </div>
                            </div>
                            <div id="sparkline-revenue1"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Products Type</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $categories ?? "" }}</h1>
                                </div>
                            </div>
                            <div id="sparkline-revenue2"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">All Products</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $products  ?? "" }}</h1>
                                </div>

                            </div>
                            <div id="sparkline-revenue3"></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">All User</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $users ?? "" }}</h1>
                                </div>
                            </div>
                            <div id="sparkline-revenue4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
