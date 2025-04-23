<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create(); // Assuming you have a Customer model and factory

        // Log in as the user
        $this->actingAs($user);

        $response = $this->post(route('orders.store'), [
            'order_date' => now()->format('d/m/Y H:i:s'),
            'total_price' => 100.00,
            'customer_id' => $customer->id,
        ]);

        // Assert that the order was created and the response redirects to the show page
        $response->assertRedirect(route('orders.show', Order::first()->id));

        // Check if the order is in the database
        $this->assertDatabaseHas('orders', [
            'total_price' => 100.00,
            'customer_id' => $customer->id,
        ]);
    }

    /** @test */
    public function it_can_show_an_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        // Log in as the user
        $this->actingAs($user);

        // Visit the order show page
        $response = $this->get(route('orders.show', $order->id));

        // Assert that the order details are displayed
        $response->assertOk();
        $response->assertSee($order->total_price);
        $response->assertSee($order->customer_id);
    }

    /** @test */
    public function it_can_update_an_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        // Log in as the user
        $this->actingAs($user);

        $response = $this->patch(route('orders.update', $order->id), [
            'order_date' => now()->format('d/m/Y H:i:s'),
            'total_price' => 150.00,
            'customer_id' => $order->customer_id,
        ]);

        // Assert that the order was updated and the response redirects to the show page
        $response->assertRedirect(route('orders.show', $order->id));

        // Check if the order is updated in the database
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'total_price' => 150.00,
        ]);
    }

    /** @test */
    public function it_can_delete_an_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create();

        // Log in as the user
        $this->actingAs($user);

        // Send a delete request to the order destroy route
        $response = $this->delete(route('orders.destroy', $order->id));

        // Assert that the response redirects to the order index page
        $response->assertRedirect(route('orders.index'));

        // Assert that the order is soft-deleted
        $this->assertSoftDeleted('orders', [
            'id' => $order->id,
        ]);
    }
}
