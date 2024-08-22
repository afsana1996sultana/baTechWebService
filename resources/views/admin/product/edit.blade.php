@extends('admin.layouts.master')

@section('main-content')

<style>
    .form-group.from_group_mobile {
        display: flex;
    }

    .form-group.from_group_mobile label {
        width: 200px;
    }

    @media (max-width: 576px) {
        .form-group.from_group_mobile label {
            width: 215px;
        }
        input#mobile_number {
    height: 35px;
}
    }
</style>

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
                            <h4>Product</h4>
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
                <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <h5 class=" float-left">Product Update</h5>
                            <a href="{{ route('product.index') }}" class=" btn btn-sm btn-primary float-right">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.update', $products->id) }}" method="post" id="basicform" data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="name">Product Name <small class="text-danger">*</small></label>
                                            <input id="name" type="text" name="name" value="{{ $products->name }}" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="category_id">Category Name <small class="text-danger">*</small></label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                @if($categories->isNotEmpty())
                                                    <option disabled selected>--Select Category--</option>
                                                    @foreach($categories as $item)
                                                        <option value="{{ $item->id }}" {{ $products->category_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name ?? 'Null' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="model_no">Model No </label>
                                            <input id="model_no" type="text" name="model_no" value="{{ $products->model_no }}" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="price">Purchase Price </label>
                                            <input id="price" type="text" name="price" value="{{ $products->price }}" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="qty">Quantity </label>
                                            <input id="qty" type="text" name="qty" value="{{ $products->qty }}" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="warranty">Warranty</label>
                                            <input id="warranty" type="text" name="warranty" value="{{ $products->warranty }}" required="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="purchase_date">Purchase Data</label>
                                            <input id="purchase_date" type="date" name="purchase_date" value="{{ $products->purchase_date }}" value="" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" cols="" rows="3" class="form-control">{{ $products->note }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor" name="status"id="status" {{ $products->status == 1 ? 'checked': '' }} value="1">
                                            <label class="form-check-label cursor" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary btn-sm">Submit</button>
                                            <button type="reset" class="btn btn-space btn-secondary btn-sm">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
