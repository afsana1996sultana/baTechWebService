@extends('admin.layouts.master')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                <h4>Information Data</h4>
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
                                <h5 class=" float-left">All Information Data</h5>
                                <a class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#importExcel" style="color: #fff; margin-left: 5px;">Import</a>
                                <a class="btn btn-primary float-right btn-sm" id="all_print" style="color: #fff; margin-left: 5px;">Print</a>
                                <a class="btn btn-danger float-right btn-sm" id="all_delete" style="color: #fff; margin-left: 5px;">Delete</a>
                                <a class="btn btn-danger float-right btn-sm" id="all_clear" style="color: #fff;">All Clear</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th width="5%">SL</th>
                                                <th width="10%">Ref No</th>
                                                <th width="15%">Zone Name</th>
                                                <th width="15%">Business Name</th>
                                                <th width="15%">Owner Name</th>
                                                <th width="10%">Mob</th>
                                                <th width="30%">Business Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($information->isNotEmpty())
                                                @foreach($information as $key=> $item)
                                                    <tr id="item_ids{{ $item->id }}">
                                                        <td><input type="checkbox" class="select-checkbox" name="ids" value="{{ $item->id }}"></td>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $item->ref_no ?? "N/A" }}</td>
                                                        <td>{{ $item->zonename ?? "N/A" }}</td>
                                                        <td>{{ $item->businame ?? "N/A" }}</td>
                                                        <td>{{ $item->ownername ?? "N/A" }}</td>
                                                        <td>{{ $item->mob ?? "N/A" }}</td>
                                                        <td>{{ $item->busiadd ?? "N/A" }}</td>
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
    <!-- Modal -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importExcelLabel">Import Information Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('information.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="file" class="col-form-label" style="font-weight: bold;">Excel file:</label>
                            <input class="form-control" type="file" name="file" id="file">
                            @error('file')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="mb-4">A file should be a CSV file with columns named ref_no, zonename, businame, ownername, mob and busiadd.</p>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Select/Deselect all checkboxes
            $('#select-all').click(function() {
                var checked = $(this).prop('checked');
                $('.select-checkbox').prop('checked', checked);
            });

            // Deselect 'Select All' if any checkbox is unchecked
            $('.select-checkbox').change(function() {
                if(!$(this).prop('checked')) {
                    $('#select-all').prop('checked', false);
                }

                // Check 'Select All' if all checkboxes are checked
                if ($('.select-checkbox:checked').length === $('.select-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });
        });
    </script>

    <script>
        $(function() {
            // Handle print button click event
            $("#all_print").click(function(e) {
                e.preventDefault();
                var all_ids = [];

                // Collect all selected checkbox ids
                $('input:checkbox[name=ids]:checked').each(function() {
                    all_ids.push($(this).val());
                });

                // Send AJAX request to print and delete selected items
                $.ajax({
                    url: "{{ route('information.Print') }}",
                    type: "GET",
                    data: {
                        ids: all_ids,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Response:', response);
                        if(response.redirect_url) {
                            // Open the URL in a new tab
                            window.open(response.redirect_url, '_blank');
                        }

                        // Remove printed items from the list
                        $.each(all_ids, function(index, id) {
                            $('#item_ids' + id).remove();
                        });

                        // Reload the current window after a delay to ensure the new tab opens
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                });
            });
        });

        // Delete selected rows
        $('#all_delete').on('click', function() {
            var ids = [];
            $('.select-checkbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length === 0) {
                alert('Please select at least one information data to clear.');
                return;
            }

            if (confirm('Are you sure you want to clear the selected information?')) {
                $.ajax({
                    url: '{{ route('information.delete') }}', // Update with your delete route
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: ids
                    },
                    success: function(response) {
                        $.each(ids, function(index, id) {
                            $('#item_ids' + id).remove();
                        });
                        alert(response.message);
                        window.location.reload(); // Reload the window after deletion
                    },
                    error: function(xhr) {
                        alert('An error occurred while deleting the information.');
                    }
                });
            }
        });

        $('#all_clear').click(function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete all data?')) {
                $.ajax({
                    url: '{{ route("information.delete.all") }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    },
                    error: function(response) {
                        alert('An error occurred while deleting data.');
                    }
                });
            }
        });
    </script>
@endsection



