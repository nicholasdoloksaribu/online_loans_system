<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class customersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customers::all();
        return response()->json(['message'=>'Succesfully fetched users', 'data'=> $customers],200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $customer = Customers::create($request->all());
        return response()->json(['message'=>'users sucessfully created','data'=> $customer],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customer)
    {
        return response()->json(['message'=>'sucessfully fetched users', 'data'=> $customer],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customers $customer)
    {
        //
        $customer->update($request->all());
        return response()->json(['message'=>'Users sucessfully updated', 'data'=> $customer],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customers $customer)
    {
        $customer->delete();
        return response()->json(['message'=>'users sucessfully deleted'],200);
    }
}