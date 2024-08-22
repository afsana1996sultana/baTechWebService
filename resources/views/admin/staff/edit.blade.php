@extends('admin.layouts.master')

@section('main-content')
<style>
    .form-group.from_group_mobile {
        display: flex;
    }

    .form-group.from_group_mobile label {
        width: 250px;
    }

    @media (max-width: 576px) {
        .form-group.from_group_mobile label {
            width: 215px;
        }

        input#password_confirmation,
        input#phone {
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
                <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <h5 class=" float-left">Staff Update</h5>
                            <a href="{{ route('staff.index') }}" class=" btn btn-primary float-right btn-sm">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('staff.update', $staff->id) }}" method="post" id="basicform" data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="city">Name <small class="text-danger">*</small></label>
                                            <input id="name" type="text" name="name" value="{{ $staff->name }}" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="email">Email <small class="text-danger">*</small></label>
                                            <input id="email" type="email" name="email" value="{{ $staff->email }}" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="phone">Mobile Number <small class="text-danger">*</small></label>
                                            <input id="phone" type="text" name="phone" value="{{ $staff->phone }}" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="password">Password <small class="text-danger">*</small></label>
                                            <input id="password" type="password" name="password" value="{{ old('password') }}" data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="password_confirmation">Confirm Password <small class="text-danger">*</small></label>
                                            <input id="password_confirmation" type="password" name="password_confirmation" {{ old('password_confirmation') }} data-parsley-trigger="change" required="" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group from_group_mobile">
                                            <label for="image">Profile Image </label>
                                            <input id="imageUpload" type="file" name="image" data-parsley-trigger="change" autocomplete="off" class="form-control">
                                        </div>
                                        @if($staff->image)
                                            <img src="{{ asset($staff->image) }}" id="imagePreview" alt="Header Logo" class="custom-img">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" id="imagePreview" alt="Header Logo" class="custom-img">
                                        @endif
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
<script>
    $(document).ready(function() {
        $('#imageUpload').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#imagePreview').attr('src', event.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });
    });
</script>
@endpush
