<?php

namespace Tests\Feature;

use App\Models\SalesInvoice;
use App\Models\Shipping;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateInvoice()
    {
        $user = User::factory()->create();
        $shoppingCarts = ShoppingCart::factory()->count(5)->create();
        $shipping = Shipping::factory()->create();
        $invoiceNumber = date('Ymd') . '/inv' . str_pad(SalesInvoice::count() + 1, 4, '0', STR_PAD_LEFT);

        foreach ($shoppingCarts as $shoppingCart) {
            $response = $this->post('/sales-invoice', [
                'invoice_number' => $invoiceNumber,
                'user_id' => $user->id,
                'shopping_cart_id' => $shoppingCart->id,
                'shipping_id' => $shipping->id,
            ]);

            $response->assertRedirect();
            $this->assertDatabaseHas('sales_invoices', [
               'invoice_number' => $invoiceNumber,
                'user_id' => $user->id,
                'shopping_cart_id' => $shoppingCart->id,
                'shipping_id' => $shipping->id,
            ]);
        }
    }
}
