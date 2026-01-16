<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Laravel\Sanctum\Sanctum;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_cart_merges_duplicates()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 100]);
        
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/cart/items', [
            'product_id' => $product->id,
            'qty' => 1
        ]);
        
        $response->assertStatus(200);
        
        $this->postJson('/api/cart/items', [
            'product_id' => $product->id,
            'qty' => 2
        ]);
        
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'qty' => 3
        ]);
    }

    public function test_checkout_fails_when_insufficient_stock()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 5]);
        
        Sanctum::actingAs($user);
        
        // Manual cart setup
        $cart = Cart::create(['user_id' => $user->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'qty' => 10,
            'price_at_time' => 100
        ]);
        
        $response = $this->postJson('/api/cart/checkout');
        
        $response->assertStatus(400); // Expect Bad Request
        
        // Verify state unchanged
        $this->assertDatabaseHas('cart_items', ['product_id' => $product->id]); 
        $this->assertEquals(5, $product->fresh()->stock);
    }
}
