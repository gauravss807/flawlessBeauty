@extends('admin.pages.dashboard')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Service @if(isset($id) && !empty($id))Edit @else Create @endif</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('service.listing') }}">Services</a></li>
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
                            <form id="service_form">
                                @csrf
                                <div class="mb-4 p-2">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-4">
                                            <label for="service_name">Service Name <span class="text-danger">*</span></label>
                                            <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter service name" value="{{ $service->service_name??'' }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="service_price">Service Price <span class="text-danger">*</span></label>
                                            <input type="text" name="service_price" id="service_price" class="form-control" placeholder="Enter service price" value="{{ $service->service_price??'' }}">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="service_duration">Service Duration <span class="text-danger">*</span></label>
                                            <input type="number" id="service_duration" name="service_duration" min="0" step="1" class="form-control" value="{{ $service->service_duration??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        
                                        <div class="form-group col-md-12">
                                            <label for="service_description">Service Description <span class="text-danger">*</span></label>
                                            <textarea name="service_description" id='service_description' class="form-control" rows="5">{{ $service->service_description??'' }}</textarea>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row mb-2">
                                        
                                        <div class="form-group col-md-4">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="">Select an option</option>
                                                <option value="active" @if(!empty($service) && $service->status == 'active') selected @endif>Active</option>
                                                <option value="inactive" @if(!empty($service) && $service->status == 'inactive') selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input type="hidden" value="{{ $service->id??'' }}" name="id">
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
        $('#submit_btn').on('click',function()
        {
            $('#service_form').find('.error').remove();

            $.ajax({
                url:"{{ route('service.store') }}",
                type: 'POST',
                data: $('#service_form').serialize(),
                success: function(result)
                {
                    if(result.status == false)
                    {

                        let $errors = result.errors;

                        $.each($errors,function(field,message)
                        {
                            $('#service_form').find('input[name="'+field+'"]').after('<span class="error">'+message+'</span>');
                            $('#service_form').find('textarea[name="'+field+'"]').after('<span class="error">'+message+'</span>');
                            $('#service_form').find('select[name="'+field+'"]').after('<span class="error">'+message+'</span>');
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