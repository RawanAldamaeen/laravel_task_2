<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $services = Service::latest()->get();
            return Datatables::of($services)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editService">Edit</a>';
   
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteService">Delete</a>';

                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('services');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::updateOrCreate(['id' => $request->service_id],
                ['name' => $request->name, 'detail' => $request->detail]);        
   
        return response()->json(['success'=>'Service saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::find($id)->delete();
     
        return response()->json(['success'=>'Service deleted successfully.']);
    }
}

