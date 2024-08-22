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
                                <h4>Category List</h4>
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
                                <h5 class=" float-left">All Category</h5>
                                <a href="{{ route('category.create') }}" class=" btn btn-primary float-right btn-sm">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th width="15%">SL</th>
                                            <th width="10%">Category Name</th>
                                            <th width="10%">Status</th>
                                            <th width="10%" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $key=> $item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $item->name ?? "" }}</td>
                                                    <td>
                                                        @if($item->status == 1)
                                                            <span class="badge rounded-pill alert-success">Active</span>
                                                        @else
                                                            <span class="badge rounded-pill alert-danger">Disable</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if(Auth::user()->user_role == 1)
                                                            <a href="{{ route('category.edit',$item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Category"><i class="fa fa-edit text-white"></i></a>
                                                        @endif
                                                        @if(Auth::user()->user_role == 1)
                                                            <a href="{{ route('category.delete',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure! you went to delete this item.?')" data-toggle="tooltip" data-placement="top" title="Delete Category"><i class="fa fa-trash text-white"></i></a>
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
