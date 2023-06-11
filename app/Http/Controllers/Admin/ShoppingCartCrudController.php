<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShoppingCartRequest;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ShoppingCartCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(ShoppingCart::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/shopping-cart');
        $this->crud->setEntityNameStrings('Shopping Cart', 'Shopping Carts');
        $this->crud->with(['user', 'product']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
         $this->crud->addColumns([
            [
                'label' => 'Nama Product',
                'name' => 'product.product_name',
                'type' => 'text',
            ],
            [
                'label' => 'Nama Pembeli',
                'name' => 'user.name',
                'type' => 'text',
            ],
            [
                'label' => 'Jumlah Subtotal Barang',
                'name' => 'quantity_sub_product',
                'type' => 'text',
            ],
             [
                'label' => 'Harga Subtotal Barang',
                'name' => 'product.product_price',
                'type' => 'text',
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ShoppingCartRequest::class);

       $this->crud->addFields([
           [   // select_from_array
                'name' => 'product_id',
                'label' => "Nama Produk",
                'type' => 'select_from_array',
                'options' => Product::pluck('product_name', 'id')->toArray(),
            ],
             [   // select_from_array
                'name' => 'user_id',
                'label' => "Nama Pembeli",
                'type' => 'select_from_array',
                'options' => User::pluck('name', 'id')->toArray(),
            ],
            [
                'label' => 'Jumlah Subtotal Barang',
                'name' => 'quantity_sub_product',
                'type' => 'text',
            ],
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }
}
