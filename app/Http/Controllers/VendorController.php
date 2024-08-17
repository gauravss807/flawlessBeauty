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
        $title = 'Vendors - Flawless Beauty';

        $vendors = Vendor::get();

        return view('admin.vendors.listing',compact('title','vendors'));
    }

    /**
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
            'vendor_name' => 'required',
            'vendor_email' => 'required|email|unique:vendors,email',
            'vendor_role' => 'required',
            'salon_name' => 'required',
            'salon_phone' => 'required|min:10|max:10',
            'salon_address' => 'required',
            'salon_city' => 'required',
            'salon_state' => 'required',
            'salon_country' => 'required',
            'status' => 'required'
        ];

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails())
        {
            return response()->json(['status' => false,'errors'=>$validate->messages()]);
        }

        dd('gadsfadsfklvlahfljn');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
