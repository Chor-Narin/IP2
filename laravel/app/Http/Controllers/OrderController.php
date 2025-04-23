<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show the form to create a new order.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $order = new Order();
        $order->order_date = $request->input('order_date');
        $order->total_price = $request->input('total_price');
        $order->customer_id = $request->input('customer_id');
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Update the specified order in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $order->order_date = $request->input('order_date');
        $order->total_price = $request->input('total_price');
        $order->customer_id = $request->input('customer_id');
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from the database.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('status', 'Order deleted successfully.');
    }
}
