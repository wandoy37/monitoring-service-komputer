<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Last data
        $lastService = Service::all()->count();
        $lastService++;

        $service = Service::create([
            'code_service' => 'SRV-' . date('Ymd') . '-' . str_pad($lastService, 4, '0', STR_PAD_LEFT),
            'status_service' => 'registration',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'device' => $request->device,
            'keluhan' => $request->keluhan,
            'store' => $request->store,
        ]);

        return response()->json([
            'message' => "Service saved successfully!",
            'service' => $service,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json([
            'service' => $service
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'device' => $request->device,
            'keluhan' => $request->keluhan,
            'store' => $request->store,
            'status_service' => $request->status_service,
        ]);

        return response()->json([
            'message' => "Service updated successfully!",
            'service' => $service
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'message' => "Service deleted successfully!",
        ], 200);
    }
}
