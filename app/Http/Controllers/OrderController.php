<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.$order_items' => ['required', 'order_items_rule'],
     */
    public function index()
    {
        $orders = Order::all();
        return response($orders,201);
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
     *
     */
    // Schema::create('orders', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('order_number')->unique();
    //     $table->unsignedBigInteger('customer_id');
    //     $table->dateTime('order_date');
    //     $table->string('order_status');
    //     $table->timestamps();
    //     $table->string('customer_name');
    //     $table->string('customer_phone',30)->nullable();
    //     $table->string('customer_email')->unique();
    //     $table->string('customer_address')->nullable();
    //     $table->integer('total');
    //     $table->json('order_items');
    //     $table->foreign('customer_email')->references('email')->on('customers')->onDelete('cascade');
    //      $table->foreign('customer_name')->references('name')->on('customers')->onDelete('cascade');
    //     $table->foreign('customer_phone')->references('phone')->on('customers')->onDelete('cascade');
    //     $table->foreign('customer_address')->references('address')->on('customers')->onDelete('cascade');
    //     $table->foreign('customer_id')->references('id')->on('users');
    // });
    public function store(Request $request)
    {
        $data=$request->validate( [
            // 'order_number' => 'required|string',
            // 'order_date' => 'date',
            'order_status' => 'string|in:pending,processing,completed',
            'customer_name' => 'string|max:255',
            'customer_phone' => 'nullable|string|max:30',
            'customer_email' => 'required|email',
            'customer_address' => 'nullable|string|max:255',
            'total' => 'required|integer',
            'order_items' => 'required|order_items_rule',
        ]);

        // dd($request->input('order_items'));

        $order=Order::create([
            'order_number' => Str::uuid(),
            'order_date' => Carbon::now(),
            'order_status' => $data['order_status'],
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'],
            'total'=>$data['total'],
            'customer_address'=>$data['customer_address'],
            'order_items'=>json_encode($data['order_items'])
        ]);
        return response()->json([$order],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(['message'=>'Order retrieved successfully','order'=>$order],201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $data=$request->validate( [

            'order_status' => 'required|in:pending,processing,completed',
            // 'customer_name' => 'required|string|max:255',
            // 'total' => 'required|integer',
            // 'order_items' => 'required|order_items_rule',
        ]);
        $order->update($data);
        return response()->json([
            'message'=>'Order updated successfully',
        'order'=>$order],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'message'=>'Order deleted successfully',
        ],201);
    }
}
