<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::all();
        return response()->json(['message' => 'Successfully fetched Services', 'data'=> $services], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = Services::create($request->all());
        return response()->json(['message' => 'Services successfully created', 'data'=> $service], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $service)
    {
        return response()->json(['message' => 'Successfully fetched Services', 'data'=> $service], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $service)
    {
        $service->update($request->all());
        return response()->json(['message' => 'Services successfully updated', 'data'=> $service], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $service)
    {
        $service->delete();
        return response()->json(['message' => 'Service successfully deleted'], 200);
    }
}