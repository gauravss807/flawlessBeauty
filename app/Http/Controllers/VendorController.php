<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
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

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails())
        {
            return response()->json(['status' => false,'errors'=>$validate->messages()]);
        }

        if(!empty($request->id))
        {
            Vendor::find($request->id)->update($request->all());
            return response()->json(['status'=>true,'redirect'=>route('vendor.listing'),'message'=>'Vendor Updated Successfully']);
        }
        {
            Vendor::create($request->all());
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