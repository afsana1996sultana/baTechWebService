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
                                <h4>Staff</h4>
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
                                <h5 class=" float-left">All Staff</h5>
                                <a href="{{ route('staff.create') }}" class=" btn btn-primary float-right btn-sm">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($staffs->isNotEmpty())
                                            @foreach($staffs as $key=> $item)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td><img src="{{ asset($item->image) }}" class="img-sm" alt="Staffpic" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                                    <td>{{ $item->name ?? "" }}</td>
                                                    <td>{{ $item->email ?? "" }}</td>
                                                    <td>{{ $item->phone ?? "" }}</td>
                                                    <td>{{ date('d M Y', strtotime($item->created_at)) ?? "" }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('staff.edit',$item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Staff"><i class="fa fa-edit text-white"></i></a>
                                                        <a href="{{ route('staff.delete',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure! you went to delete this item.?')" data-toggle="tooltip" data-placement="top" title="Delete Staff"><i class="fa fa-trash text-white"></i></a>
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
