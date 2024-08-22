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
                        <h2 class="pageheader-title"> </h2>
                        <p class="pageheader-text"></p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <h4>Product List</h4>
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class=" float-left">All Product</h5>
                                <a href="{{ route('product.create') }}" class=" btn btn-primary float-right btn-sm">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="20%">Product Name</th>
                                            <th width="10%">Category</th>
                                            <th width="10%">Model No</th>
                                            <th width="5%">Price</th>
                                            <th width="5%">Qty</th>
                                            <th width="10%">Warranty</th>
                                            <th width="10%">Buy Date</th>
                                            <th width="15%">Note</th>
                                            <th width="10%" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($products->isNotEmpty())
                                            @foreach($products as $key=> $item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $item->name ?? "" }}</td>
                                                    <td>{{ $item->category->name ?? "" }}</td>
                                                    <td>{{ $item->model_no ?? "N/A" }}</td>
                                                    <td>{{ $item->price ?? "N/A" }}</td>
                                                    <td>{{ $item->qty ?? "N/A" }}</td>
                                                    <td>{{ $item->warranty ?? "N/A" }}</td>
                                                    <td>{{ $item->purchase_date ?? "N/A" }}</td>
                                                    <td>{{ $item->note ?? "N/A" }}</td>
                                                    <td class="text-center">
                                                        @if(Auth::user()->user_role == 1)
                                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Product"><i class="fa fa-edit text-white"></i></a>
                                                        @endif
                                                        @if(Auth::user()->user_role == 1)
                                                            <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure! you went to delete this item.?')" data-toggle="tooltip" data-placement="top" title="Delete Product"><i class="fa fa-trash text-white"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
