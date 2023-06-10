<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesInvoiceRequest;
use App\Models\SalesInvoice;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesInvoiceRequest $request)
    {
        // Generate invoice number
        $invoiceNumber = date('Ymd') . '/inv' . str_pad(SalesInvoice::count() + 1, 4, '0', STR_PAD_LEFT);

        // Get user ID from logged in user
        $userId = Auth::id();

        // Get shopping cart IDs for the current user
        $shoppingCartIds = ShoppingCart::where('user_id', $userId)->pluck('id')->toArray();

        // Store sales invoice for each shopping cart
        foreach ($shoppingCartIds as $shoppingCartId) {
            SalesInvoice::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => $userId,
                'shopping_cart_id' => $shoppingCartId,
                'shipping_id' => $request->shipping_id,
            ]);
        }

        return redirect()->back()->with('success', 'Sales Invoice berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(SalesInvoice $salesInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $salesInvoice = SalesInvoice::findOrFail($id);
        return view('sales_invoice.edit', compact('salesInvoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalesInvoiceRequest $request, $id)
    {
        $salesInvoice = SalesInvoice::findOrFail($id);
        $salesInvoice->shipping_id = $request->shipping_id;
        $salesInvoice->save();

        return redirect()->back()->with('success', 'Sales Invoice berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $salesInvoice = SalesInvoice::findOrFail($id);
        $salesInvoice->delete();

        return redirect()->back()->with('success', 'Sales Invoice berhasil dihapus');
    }
}
