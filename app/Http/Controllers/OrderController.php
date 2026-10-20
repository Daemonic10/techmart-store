<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function store(Request $request)
    {
        $validate = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'shiping_addres' => 'required',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            return back()->with('error', 'Stok kurang dari quantity');
        };

        $subtotal = $product->price * $request->qty;

        $order = Order::create([
            'invoice_code' => 'INV-'. rand(100,999),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'shiping_addres' => $request->shiping_addres,
            "total_amount" => $subtotal,
            'status' => 'pending'
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        $product->decrement('stock', $request->qty);

        return redirect()->back()->with('success','');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validate = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'shiping_addres' => 'required',
            'total_amount' => 'required',
            'invoice_code' => 'required',
            'status' => 'required',
        ]);

        $order->update($validate);
        return redirect()->route('order.index')->with('success','');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
