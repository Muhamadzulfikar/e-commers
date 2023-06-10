<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::all();
        return view('shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingRequest $request)
    {
        $validatedData = $request->validated();
        Shipping::create($validatedData);
        return redirect()->back()->with('success', 'Shipping berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRequest $request, $id)
    {
        $validatedData = $request->validated();
        $shipping = Shipping::findOrFail($id);
        $shipping->update($validatedData);
        return redirect()->back()->with('success', 'Shipping berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();

        return redirect()->back()->with('success', 'Shipping berhasil dihapus');
    }
}
