<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCartRequest;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $shoppingCarts = ShoppingCart::with('product')->where('user_id', $userId)->get();
        return view('shopping_cart.index', compact('shoppingCarts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShoppingCartRequest $request)
    {
        $validatedData = $request->validated();
        ShoppingCart::create($validatedData);

        Alert::success('Product berhasil ditambahkan kedalam keranjang')->flash();
        return redirect()->to(url("product/{$request->product_id}"));
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shoppingCart = ShoppingCart::findOrFail($id);
        return view('shopping_cart.edit', compact('shoppingCart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShoppingCartRequest $request, $id)
    {
        $validatedData = $request->validated();
        $shoppingCart = ShoppingCart::findOrFail($id);
        $shoppingCart->update($validatedData);
        return redirect()->back()->with('success', 'Product berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shoppingCart = ShoppingCart::findOrFail($id);
        $shoppingCart->delete();

        return redirect()->back()->with('success', 'Shopping Cart berhasil dihapus');
    }
}
