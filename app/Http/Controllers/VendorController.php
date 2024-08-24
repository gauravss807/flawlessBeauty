<?php

namespace App\Http\Controllers;

use App\Models\{Vendor,Media};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = 2;
        $title = 'Vendors - Flawless Beauty';

        $vendors = Vendor::paginate($per_page);

        return view('admin.vendors.listing',compact('title','vendors','per_page'));
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Vendor - Flawless Beauty";
        return view('admin.vendors.addEditVendor',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'vendor_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'vendor_email' => 'required|email|unique:vendors,vendor_email,'.$request->id,
            'vendor_phone' => 'numeric|digits:10',
            'vendor_role' => 'required',
            'salon_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'salon_phone' => 'required|numeric|digits:10',
            'salon_address' => 'required',
            'salon_city' => 'required',
            'salon_state' => 'required',
            'salon_country' => 'required',
            'salon_location' => 'required',
            'status' => 'required'
        ];

        if(!empty($request->vendor_profile))
        {
            $rules = [
                'vendor_profile' => 'image|mimes:jpeg,png,pdf|max:2048',
            ];
        }

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails())
        {
            return response()->json(['status' => false,'errors'=>$validate->messages()]);
        }

        // dd($request->all());
        $data = $request->all();

        if(!empty($request->vendor_profile) && $request->hasFile('vendor_profile'))
        {
            $vendor_profile = $request->file('vendor_profile');
            $file_name_incl_extn = $vendor_profile->getClientOriginalName();
            $media = [
                'file_name_incl_extn' => $file_name_incl_extn,
                'file_name' => pathinfo($file_name_incl_extn,PATHINFO_FILENAME),
                'file_path' => '/uploads',
                'media_type' => $vendor_profile->getClientMimeType(),
                'category' => 'Vendor Profile',
            ];
            
            $vendor_profile->move(public_path('uploads'), $media['file_name_incl_extn']);

            $media_details = Media::create($media);
            $data['vendor_profile_id'] = $media_details->id;
        }

        if(!empty($request->salon_logo) && $request->hasFile('salon_logo'))
        {
            $salon_logo = $request->file('salon_logo');
            $file_name_incl_extn = $salon_logo->getClientOriginalName();
            $salon_logo_detail = [
                'file_name_incl_extn' => $file_name_incl_extn,
                'file_name' => pathinfo($file_name_incl_extn,PATHINFO_FILENAME),
                'file_path' => '/uploads',
                'media_type' => $salon_logo->getClientMimeType(),
                'category' => 'Salon Logo',
            ];
            
            $salon_logo->move(public_path('uploads'), $salon_logo_detail['file_name_incl_extn']);

            $m_detail = Media::create($salon_logo_detail);
            $data['salon_logo_id'] = $m_detail->id;
        }
        
        if(!empty($request->id))
        {
            Vendor::find($request->id)->update($data);
            return response()->json(['status'=>true,'redirect'=>route('vendor.listing'),'message'=>'Vendor Updated Successfully']);
        }
        {
            Vendor::create($data);
            return response()->json(['status'=>true,'redirect'=>route('vendor.listing'),'message'=>'Vendor Created Successfully']);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Vendor - Flawless Beauty';
        $vendor = Vendor::find($id);
        
        return view('admin.vendors.addEditVendor',compact('title','vendor'));
    }

    public function destroy(Request $request)
    {
        $vendor_detail = Vendor::find($request->id);
        if(!empty($vendor_detail))
        {
            $vendor_detail->delete();
            return response(['status'=>true,'message'=>'Vendor Deleted Successfully']);
        }
    }
}