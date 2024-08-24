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
                            <form id="vendor_form" enctype="multipart/form-data">
                                @csrf
                                <h5>Vendor Details</h5>
                                <div class="mb-4 p-2">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="vendor_name">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter vendor name" value="{{ $vendor->vendor_name??'' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="vendor_email">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="vendor_email" id="vendor_email" class="form-control" placeholder="Enter vendor email" value="{{ $vendor->vendor_email??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="vendor_gender">Gender</label>
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
                                            <label for="vendor_phone">Phone</label>
                                            <input type="text" name="vendor_phone" id="vendor_phone" class="form-control" placeholder="Enter phone" value="{{ $vendor->vendor_phone??'' }}">
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label for="vendor_address">Address</label>
                                            <input type="text" name="vendor_address" id="vendor_address" class="form-control" placeholder="Enter address" value="{{ $vendor->vendor_address??'' }}">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="vendor_role">Role <span class="text-danger">*</span></label>
                                            <select id="vendor_role" class="form-select" name="vendor_role">
                                                <option value="">Select an option</option>
                                                <option value="owner" @if(isset($vendor) && $vendor->vendor_role == 'owner') selected @endif>Owner</option>
                                                <option value="manager" @if(isset($vendor) && $vendor->vendor_role == 'manager') selected @endif>Manager</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="vendor_profile_image">Profile Photo</label>
                                            <div style="display: flex; align-items: center;">
                                                <input type="file" name="vendor_profile" class="form-control btn btn-primary" id="vendor_profile_image">
                                                <input type="hidden" name="vendor_profile_id" id="vendor_profile_id" value="{{$vendor->vendor_profile_id??''}}" >
                                                <div class="imgPrev col-md-3" style="margin-left: 20px;">
                                                    @php
                                                        $vendor_profile = App\Models\Media::find($vendor->vendor_profile_id);
                                                    @endphp
                                                    @if(!empty($vendor_profile->file_name_incl_extn))
                                                        <span class="delVendorProfile text-danger" data-img-id="{{ $vendor_profile->id ?? '' }}" style="position:absolute;">X</span>
                                                        <img src="{{ asset('/uploads/'.$vendor_profile->file_name_incl_extn) }}" class="mediaImg img-fluid vendor_profile_src">
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <h5>Salon Details</h5>
                                <div class="mb-4 p-2">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_name">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_name" id="salon_name" class="form-control" placeholder="Enter salon name" value="{{ $vendor->salon_name??'' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="salon_email">Email</label>
                                            <input type="email" name="salon_email" id="salon_email" class="form-control" placeholder="Enter salon email" value="{{ $vendor->salon_email??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_phone">Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_phone" id="salon_phone" class="form-control" placeholder="Enter phone" value="{{ $vendor->salon_phone??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_website">Website</label>
                                            <input type="text" name="salon_website" id="salon_website" class="form-control" placeholder="Enter salon website" value="{{ $vendor->salon_website??'' }}">
                                        </div>

                                        <div class="form-group col-md-9">
                                            <label for="salon_address">Address <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_address" id="salon_address" class="form-control" placeholder="Enter salon address" value="{{ $vendor->salon_address??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_city">City <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_city" id="salon_city" class="form-control" placeholder="Enter salon name" value="{{ $vendor->salon_city??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_state">State <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_state" id="salon_state" class="form-control" placeholder="Enter salon state" value="{{ $vendor->salon_state??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_country">Country <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_country" id="salon_country" class="form-control" placeholder="Enter salon country" value="{{ $vendor->salon_country??'' }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="salon_postal_code">Postal Code</label>
                                            <input type="text" name="salon_postal_code" id="salon_postal_code" class="form-control" placeholder="Enter salon postal code" value="{{ $vendor->salon_postal_code??'' }}">
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="form-group col-md-3">
                                            <label for="salon_establish_date">Establish Date</label>
                                            <input type="text" name="established_date" id="salon_establish_date" class="form-control" placeholder="Enter salon established date" value="{{ $vendor->established_date??'' }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="salon_location">Location <span class="text-danger">*</span></label>
                                            <input type="text" name="salon_location" id="salon_location" class="form-control" placeholder="Enter salon google map location" value="{{ $vendor->salon_location??'' }}">
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
                                

                                    <div class="form-group col-md-3">
                                        <label for="salon_logo">Salon Logo</label>
                                        <div style="display: flex; align-items: center;">
                                            <input type="file" name="salon_logo" class="form-control btn btn-primary" id="salon_logo">
                                            <input type="hidden" name="salon_logo_id" id="salon_logo_id" value="{{$vendor->salon_logo_id??''}}" >
                                            <div class="salonLogPrev col-md-3" style="margin-left: 20px;">
                                                @php
                                                    $salon_logo = App\Models\Media::find($vendor->salon_logo_id);
                                                @endphp
                                                @if(!empty($salon_logo->file_name_incl_extn))
                                                    <span class="delSalonLogo text-danger" data-img-id="{{ $salon_logo->id ?? '' }}" style="position:absolute;">X</span>
                                                    <img src="{{ asset('/uploads/'.$salon_logo->file_name_incl_extn) }}" class="mediaImg img-fluid salon_logo_src">
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- <div class="row mb-2">
                                    <div class="form-group col-md-3">
                                        <div class="mediaBox Multiple">
                                        <a href="javascript:void(0);" class="btn btn-primary Multiple WsUploadMedia"
                                            data-parent_id="{{ $data->id ?? '' }}" data-category="Product">
                                        Gallery Image </a>
                                        <input type="hidden" class="media_id" name="gallery_images_ids"
                                            value="{{ isset($data) ? $data->gallery_images_ids : old('gallery_images_ids') }}" />
                                        <div class="imgPrev">
                                            <ul class="MediaGall">
                                                @if (isset($data) && !empty($data->gallery_images_ids))
                                                @php
                                                $ids = explode(',', $data->gallery_images_ids);
                                                @endphp
                                                @if ($ids)
                                                @foreach ($ids as $id)
                                                @php
                                                $MediaUrl = getMediaUrl($id);
                                                @endphp
                                                @if (!empty($MediaUrl))
                                                <li data-id="{{ $id ?? '' }}"> <span
                                                    class="delMediaImg"
                                                    data-img-id="{{ $id ?? '' }}">X</span>
                                                    <img src="{{ $MediaUrl }}"
                                                    class="mediaImg img-fluid">
                                                </li>
                                                @endif
                                                @endforeach
                                                @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->

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

            var formData = new FormData($('#vendor_form')[0]);

            $.ajax({
                url:"{{ route('vendor.store') }}",
                type: 'POST',
                data: formData,
                contentType:false,
                processData:false,
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

        //this code for the vendor_profile 
        document.getElementById('vendor_profile_image').addEventListener('change', function(event) {
            const [file] = event.target.files;

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imagePreview = document.querySelector('.imgPrev img'); // Select the img inside the div with class imgPrev

                    if (imagePreview) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block'; // Show the image preview
                    } else {
                        // If no img element exists, create one
                        const newImage = document.createElement('img');
                        newImage.src = e.target.result;
                        newImage.classList.add('mediaImg', 'img-fluid');
                        document.querySelector('.imgPrev').appendChild(newImage);
                    }
                };

                reader.readAsDataURL(file); // Convert the file to a data URL
            }
        });

        $('.delVendorProfile').on('click',function(){
            $('#vendor_profile_id').val('');
            $('.vendor_profile_src').attr('src','');
        });

        //this code for the Salon Logo
        document.getElementById('salon_logo').addEventListener('change', function(event) {
            const [file] = event.target.files;

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imagePreview = document.querySelector('.salonLogPrev img'); // Select the img inside the div with class imgPrev

                    if (imagePreview) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block'; // Show the image preview
                    } else {
                        // If no img element exists, create one
                        const newImage = document.createElement('img');
                        newImage.src = e.target.result;
                        newImage.classList.add('mediaImg', 'img-fluid');
                        document.querySelector('.salonLogPrev').appendChild(newImage);
                    }
                };

                reader.readAsDataURL(file); // Convert the file to a data URL
            }
        });

        $('.delSalonLogo').on('click',function(){
            $('#salon_logo_id').val('');
            $('.salon_logo_src').attr('src','');
        });
    });
</script>
@endsection