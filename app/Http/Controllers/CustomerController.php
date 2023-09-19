<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        return response()->json([
            'message'=>'all customers in the database',
            'all Customers'=>$customers],201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$order_items' => ['required', 'order_items_rule'],

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
            'address'=>'required|string',
        ]);
        $customer=Customer::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],
        ]);
        return response()->json(['message'=>'customer created successfully','customer'=>$customer],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json(['message'=>'customer details','customer'=>$customer],201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data=$request->validate([

            'email'=>'required|email',
            'phone'=>'required|string',
            'address'=>'required|string',
        ]);
        $customer->update($data);
        return response()->json([
            'message'=>'customer updated successfully',
        'customer'=>$customer],
        201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message'=>'customer deleted successfully'],201);
    }
}
