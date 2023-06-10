<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $product = Product::query();
//        $products = collect();
//        $productTypes = ['saus', 'kecap', 'mie', 'kopi', 'gula', 'beras'];
//        foreach ($productTypes as $productType){
//            $products->push($product->whereHas('productCategory', function ($query) use ($productType) {
//                  $query->where('product_type', $productType);
//            })->limit(5)->get());
//        }
        $products = Product::all();

        return view('welcome', compact('products'));
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
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        // Upload image
        if ($request->hasFile('image_product')) {
            $image = $request->file('image_product');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image_product'] = $imageName;
        }

        Product::create($validatedData);

        return redirect()->back()->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('Product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $validatedData = $request->validated();
        $product = Product::findOrFail($id);

        // Update image if provided
        if ($request->hasFile('image_product')) {
            // Delete previous image
            $previousImage = public_path('images/' . $product->image_product);
            if (file_exists($previousImage)) {
                unlink($previousImage);
            }

            // Upload new image
            $image = $request->file('image_product');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image_product'] = $imageName;
        }

        $product->update($validatedData);

        return redirect()->back()->with('success', 'Product berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image
        $imagePath = public_path('images/' . $product->image_product);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product berhasil dihapus');
    }

    public function search(Request $request)
    {
        $productName = $request->input('product_name');

        $products = Product::where('product_name', 'like', '%' . $productName . '%')->get();

        return view('product.search', compact('products'));
    }
}
