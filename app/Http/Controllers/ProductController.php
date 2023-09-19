<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// App\Models\Product::where('name','Sherman Kuhlman')->first();

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(
            $products,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //   $data = $request->validate([
    //     'name' => 'required|string',
    //     'price' => 'required|numeric',
    //     'description' => 'required|string',
    //     'category_id' => 'required|numeric',
    //     'image' => 'required|string',
    //     'stock' => 'required|numeric',
    //     'status' => 'required|string',


    //   ]);
    //   $product = Product::create(
    //     [
    //       'name' => $data['name'],
    //       'price' => $data['price'],
    //       'description' => $data['description'],
    //       'category_id' => $data['category_id'],
    //       'image' => $data['image'],
    //       'stock' => $data['stock'],
    //       'status' => $data['status'],
    //     ]
    //   );

    //   return response()->json(['message'=>'Product created successfully', 'product'=>$product],201,
    //   ['Content-Type'=>'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    //);


    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|numeric|nullable',
            'image' => 'required|string|nullable',
            'stock' => 'required|numeric',
            'status' => 'required|string|nullable',


        ]);
        //  dd($data);
        $product = Product::create(
            [
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'image' => $data['image'],
                'stock' => $data['stock'],
                'status' => $data['status'],
            ]
        );
        // dd($product);

        return response()->json(
            [
                'message' => 'Product created successfully',
                'product' => $product
            ],
            201,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $product=Product::find($product->id);

        return
            response()->json(
                ['message' => 'Product found', 'product' => $product],
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            );
    }
    public function search(Request $request)
    {
        $name = $request->json('name');

        // $name=$request->name;
        // $name = $request->input('name');
        dd($name);
        // $product = Product::where('name', 'LIKE', '%'.$name.'%')->get();
        try {
            // $product = Product::where('name', $keyword)->get();
            $product = Product::where('name', 'LIKE', '%' . $name . '%')->collate('utf8_general_ci')->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // $product = Product::where('name', $keyword)->get();
        dd($product);


        return response()->json(
            ['message' => 'Product found', 'product' => $product],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            // 'name' => 'required|string|max:255',
            // 'description' => 'required|string',
            // 'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            // 'image' => 'required|string|max:2048',
            'stock' => 'required|numeric',
            'status' => 'required|string|max:255',


        ]);
        $product->update(
            $data
        );

        return response()->json(
            ['message' => 'Product updated successfully', 'updatedProduct' => $product],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(
            ['message' => 'Product deleted successfully'],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        );
    }
}
