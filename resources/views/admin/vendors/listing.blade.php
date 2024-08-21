@extends('admin.pages.dashboard')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Vendors</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Vendors</li>
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
                                            <a href="{{route('vendor.create')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add Vendor</a>
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
                                                <th class="align-middle">Vendor ID</th>
                                                <th class="align-middle">Vendor Name</th>
                                                <th class="align-middle">Saloon Name</th>
                                                <th class="align-middle">Saloon Address</th>
                                                <th class="align-middle">Saloon Phone</th>
                                                <th class="align-middle">Created At</th>
                                                <th class="align-middle">Status</th>
                                                <th class="align-middle">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach($vendors as $vendor)
                                            <tr>
                                                <!-- <td>
                                                    <div class="form-check font-size-16">
                                                        <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                                        <label class="form-check-label" for="orderidcheck01"></label>
                                                    </div>
                                                </td> -->
                                                <td>{{ $vendor->id }}</td>
                                                <td>{{ $vendor->vendor_name }}</td>
                                                <td>{{ $vendor->salon_name }}</td>
                                                <td>{{ $vendor->salon_address .' '. $vendor->salon_city .' '. $vendor->salon_state .' '. $vendor->salon_country .' '. $vendor->salon_postal_code}}</td>
                                                <td>{{ $vendor->salon_phone }}</td>

                                                <td>{{ $vendor->created_at->format('d-m-Y H:i A') }}</td>
                                                <td>{{ ucwords($vendor->status) }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('vendor.edit',['id'=>$vendor->id]) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="javascript::void(0);" class="text-danger"><i class="mdi mdi-delete font-size-18 delete_vendor" data_id="{{ $vendor->id }}"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="pagination pagination-rounded justify-content-end mb-2">
                                    <!-- Previous Page Link -->
                                    @if ($vendors->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $vendors->previousPageUrl() }}" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    <!-- Pagination Links -->
                                    @for ($i = 1; $i <= $vendors->lastPage(); $i++)
                                        <li class="page-item {{ $vendors->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $vendors->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Next Page Link -->
                                    @if ($vendors->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $vendors->nextPageUrl() }}" aria-label="Next">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0);" aria-label="Next">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>

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
            $('.delete_vendor').on('click',function()
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
                            url: '{{ route("vendor.delete") }}',
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