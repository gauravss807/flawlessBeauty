@extends('admin.pages.dashboard')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Hot Deals</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('service.listing') }}">Services</a></li>
                                    <li class="breadcrumb-item active">Hot Deals</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <div class="search-box me-2 mb-2 d-inline-block">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="Search...">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="text-sm-end">
                                            <a href="{{route('service.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add Hot Deals</a>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-check">
                                        <thead class="table-light">
                                            <tr>
                                                <!-- <th style="width: 20px;" class="align-middle">
                                                    <div class="form-check font-size-16">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th> -->
                                                <th class="align-middle">Service ID</th>
                                                <th class="align-middle">Service Name</th>
                                                <th class="align-middle">Service Description</th>
                                                <th class="align-middle">Service Time</th>
                                                <th class="align-middle">Service Price</th>
                                                <th class="align-middle">Created At</th>
                                                <th class="align-middle">Status</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                 

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Flawless Beauty.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by abc
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('.delete_service').on('click',function()
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("service.delete") }}',
                            type: 'DELETE',
                            data: {
                                id: $(this).attr('data_id'),
                                _token: '{{ csrf_token() }}' 
                            },
                            success: function(response) {
                                if(response.status == true)
                                {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                }
                                else
                                {
                                    Swal.fire(
                                        response.message,
                                        'error'
                                    );
                                }
                                
                            },
                            error: function(xhr) {
                                // Handle error
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the vendor.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection