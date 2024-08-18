@extends('admin.pages.dashboard')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Vendor @if(isset($id) && !empty($id))Edit @else Create @endif</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('vendor.listing') }}">Vendors</a></li>
                                <li class="breadcrumb-item active">@if(isset($id) && !empty($id))Edit @else Create @endif</li>
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
                            <form id="vendor_form">
                                @csrf
                                <h5>Vendor Details</h5>
                                <div class="mb-4 p-2">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="vendor_name">Vendor Name <span class="text-danger">*</span></label>
                                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter vendor name" value="{{ $vendor->vendor_name??'' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="vendor_email">Vendor Email <span class="text-danger">*</span></label>
                                            <input type="email" name="vendor_email" id="vendor_email" class="form-control" placeholder="Enter vendor email" value="{{ $vendor->vendor_email??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="vendor_gender">Vendor Gender</label>
                                            <select id="vendor_gender" class="form-select" name="vendor_gender">
                                                <option value="">Select an option</option>
                                                <option value="male" @if(isset($vendor) && $vendor->vendor_gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if(isset($vendor) && $vendor->vendor_gender == 'female') selected @endif>Female</option>
                                                <option value="other" @if(isset($vendor) && $vendor->vendoer_gender == 'other') selected @endif>Other</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="vendor_phone">Vendor Phone</label>
                                            <input type="text" name="vendor_phone" id="vendor_phone" class="form-control" placeholder="Enter phone" value="{{ $vendor->vendor_phone??'' }}">
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label for="vendor_address">Vendor Address</label>
                                            <input type="text" name="vendor_address" id="vendor_address" class="form-control" placeholder="Enter address" value="{{ $vendor->vendor_address??'' }}">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="vendor_role">Vendor Role <span class="text-danger">*</span></label>
                                            <select id="vendor_role" class="form-select" name="vendor_role">
                                                <option value="">Select an option</option>
                                                <option value="owner" @if(isset($vendor) && $vendor->vendor_role == 'owner') selected @endif>Owner</option>
                                                <option value="manager" @if(isset($vendor) && $vendor->vendor_role == 'manager') selected @endif>Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h5>Salon Details</h5>
                                <div class="mb-4 p-2">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_name">Salon Name <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_name" id="salon_name" class="form-control" placeholder="Enter salon name" value="{{ $vendor->salon_name??'' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="salon_email">Salon Email</label>
                                            <input type="email" name="salon_email" id="salon_email" class="form-control" placeholder="Enter salon email" value="{{ $vendor->salon_email??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_phone">Salon Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_phone" id="salon_phone" class="form-control" placeholder="Enter phone" value="{{ $vendor->salon_phone??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_website">Salon Website</label>
                                            <input type="text" name="salon_website" id="salon_website" class="form-control" placeholder="Enter salon website" value="{{ $vendor->salon_website??'' }}">
                                        </div>

                                        <div class="form-group col-md-9">
                                            <label for="salon_address">Salon Address <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_address" id="salon_address" class="form-control" placeholder="Enter salon address" value="{{ $vendor->salon_address??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_city">Salon City <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_city" id="salon_city" class="form-control" placeholder="Enter salon name" value="{{ $vendor->salon_city??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_state">Salon State <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_state" id="salon_state" class="form-control" placeholder="Enter salon state" value="{{ $vendor->salon_state??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_country">Salon Country <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_country" id="salon_country" class="form-control" placeholder="Enter salon country" value="{{ $vendor->salon_country??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_postal_code">Salon Postal Code</label>
                                            <input type="text" name="salon_postal_code" id="salon_postal_code" class="form-control" placeholder="Enter salon postal code" value="{{ $vendor->salon_postal_code??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_establish_date">Salon Establish Date</label>
                                            <input type="text" name="established_date" id="salon_establish_date" class="form-control" placeholder="Enter salon established date" value="{{ $vendor->established_date??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="">Select an option</option>
                                                <option value="active" @if(isset($vendor) && $vendor->status == 'active') selected @endif>Active</option>
                                                <option value="inactive" @if(isset($vendor) && $vendor->status == 'inactive') selected @endif>Inactive</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" value="{{ $vendor->id??'' }}" name="id">
                                    <button type="button" class="btn btn-primary" id="submit_btn">Submit</button>
                                </div>
                            </form>
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
        $('#salon_establish_date').datepicker({
            format:'yyyy-mm-dd',
            endDate:new Date()
        });

        $('#submit_btn').on('click',function()
        {
            $('#vendor_form').find('.error').remove();

            $.ajax({
                url:"{{ route('vendor.store') }}",
                type: 'POST',
                data: $('#vendor_form').serialize(),
                success: function(result)
                {
                    if(result.status == false)
                    {

                        let $errors = result.errors;

                        $.each($errors,function(field,message)
                        {
                            $('#vendor_form').find('input[name="'+field+'"]').after('<span class="error">'+message+'</span>');
                            $('#vendor_form').find('select[name="'+field+'"]').after('<span class="error">'+message+'</span>');
                        });
                    }
                    else
                    {
                        window.location.href = result.redirect;
                    }
                }
            });
        });
    });
</script>
@endsection