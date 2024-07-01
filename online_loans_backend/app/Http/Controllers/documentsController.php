<?php

namespace App\Http\Controllers;
use App\Models\Documents;
use Illuminate\Http\Request;

class documentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents::all();
        return response()->json(['message' => 'Successfully fetched Services', 'data'=> $documents], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $document = Documents::create($request->all());
        return response()->json(['message' => 'Services successfully created', 'data'=> $document], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $document)
    {
        return response()->json(['message' => 'Successfully fetched Services', 'data'=> $document], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documents $document)
    {
         $document->update($request->all());
        return response()->json(['message' => 'Services successfully updated', 'data'=> $document], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $document)
    {
        $document->delete();
        return response()->json(['message' => 'Service successfully deleted'], 200);
    }
}
