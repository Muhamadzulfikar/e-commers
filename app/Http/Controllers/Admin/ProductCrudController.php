<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Prologue\Alerts\Facades\Alert;

class ProductCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation{
        update as traitUpdate;
    }
    use DeleteOperation{
        destroy as traitDestroy;
    }
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Product::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('Product',  'Products');
    }

    protected function setupListOperation()
    {
       $this->crud->addColumns([
            [
                'label' => 'Nama Product',
                'name' => 'product_name',
                'type' => 'text',
            ],
            [
                'label' => 'Harga Product',
                'name' => 'product_price',
                'type' => 'text',
            ],
            [
                'label' => 'Deskripsi Singkat',
                'name' => 'short_description',
                'type' => 'text',
            ],
            [
                'label' => 'Berat Barang dalam satuan gram',
                'name' => 'weight',
                'type' => 'text',
            ],
        ]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProductRequest::class);
        $this->crud->addFields([
            [   // select_from_array
                'name' => 'product_category_id',
                'label' => "Kategori Produk",
                'type' => 'select_from_array',
                'options' => ProductCategory::pluck('product_type', 'id')->toArray(),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'label' => 'Nama Product',
                'name' => 'product_name',
                'type' => 'text',
               'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'label' => 'Harga Product',
                'name' => 'product_price',
                'type' => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'label' => 'Deskripsi Singkat',
                'name' => 'short_description',
                'type' => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'label' => 'Berat Barang dalam satuan gram',
                'name' => 'weight',
                'type' => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                // Upload File
                'name' => 'image_product',
                'label' => 'Image',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
             [
                'name' => 'description',
                'label' => 'Deskripsi Produk',
                'type' => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ]
                ],
            ],
        ]);
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        // Upload image
        if ($request->hasFile('image_product')) {
            $image = $request->file('image_product');
            $image->storeAs('public/product', $image->hashName());
            $validatedData['image_product'] = $image->hashName();
        }

        Product::create($validatedData);

        Alert::success('Product berhasil ditambahkan')->flash();
        return redirect()->to(url('admin/product'));
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function update(ProductRequest $request, $id)
    {
        // Update image if provide
        $validatedData = $request->validated();
        $product = Product::findOrFail($id);
        if ($request->hasFile('image_product')) {
            //delete old image
            Storage::delete('public/product/' . $product->image);

            //upload new image
            $image = $request->file('image_product');
            $image->storeAs('public/product', $image->hashName());

            $validatedData['image_product'] = $image->hashName();

            $product->update($validatedData);
        }

        Alert::success('Product berhasil diupdate')->flash();
        return redirect()->to(url('admin/product'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::query()->where('id', $id)->first();
            //delete image
            Storage::delete('public/product/' . $product->image_product);
           $response = $this->traitDestroy($id);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors($exception->getMessage())
                ->withInput(request()->all());
        }

        DB::commit();
        Alert::success('Product berhasil dihapus')->flash();
        return redirect()->to(url('admin/product'));
    }
}
