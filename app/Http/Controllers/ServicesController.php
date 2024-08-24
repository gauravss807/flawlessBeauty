<?php

namespace App\Http\Controllers;

use App\Models\{Services,ServiceCategory};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = 2;
        $title = "Services - Flawless Beauty";
        $services = Services::paginate($per_page);
        return view('admin.services.listing',compact('title','services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Create Service - Flawless Beauty";
        return view('admin.services.addEditService',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category' => 'required',
            'service_name' => 'required',
            'service_description' => 'required',
            'service_duration' => 'required',
            'service_price'=> 'required|numeric', 
            'status' => 'required',
        ];        

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validate->messages()]);
        }

        if(!empty($request->id))
        {
            Services::find($request->id)->update($request->all());
            return response()->json(['status'=>true,'message'=>'Service Updated Successfully','redirect'=>route('service.listing')]);

        }
        else
        {
            Services::create($request->all());
            return response()->json(['status'=>true,'message'=>'Service Created Successfully','redirect'=>route('service.listing')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Service - Flawless Beauty';
        $service = Services::find($id);
        return view('admin.services.addEditService',compact('title','service'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(empty($request->id))
        {
            return response()->json(['status'=>false,'message'=>'Data Not Found']);
        }

        Services::find($request->id)->delete();

        return response()->json(['status'=>true,'message'=>'Service Deleted Successfully.']);
    }

    public function hotDealListing($id)
    {
        $services = Services::find($id);
        $title = 'Hot Deals - '. $services->service_name . '- Flawless Beauty';
        return view('admin.services.hotDeals.listing',compact('title','services'));
    }
}
