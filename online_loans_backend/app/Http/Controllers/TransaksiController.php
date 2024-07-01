<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with('customer:id,nama_peminjam', 'service')->get();
return response()->json(['message' => 'Successfully fetched transaksi', 'data'
=> $transaksis], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'tgl_pinjam' => 'required|date_format:Y-m-d',
        'tgl_pengembalian' => 'required|date_format:Y-m-d',
        'status' => 'required|in:pending,processing,completed,canceled',
]);
$transaksi = Transaksi::create($request->all());
return response()->json(['message' => 'Transaksi successfully created', 'data' =>
$transaksi], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['customer', 'service']);
return response()->json(['message' => 'Successfully fetched Transaksi', 'data' =>
$transaksi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
'customer_id' => 'sometimes|required|exists:customers,id',
'service_id' => 'sometimes|required|exists:services,id',
'tgl_pinjam' => 'sometimes|required|date_format:Y-m-d',
'tgl_pengembalian' => 'sometimes|required|date_format:Y-m-d',
'status' =>'sometimes|required|in:pending,processing,completed,canceled',
]);

$transaksi->update($request->all());
return response()->json(['message' => 'Transaksi successfully updated', 'data' =>
$transaksi]);
    
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
return response()->json(['message' => 'Transaksi successfully deleted'], 200);
    }
}
