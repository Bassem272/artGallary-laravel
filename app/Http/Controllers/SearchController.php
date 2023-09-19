<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller

{
    public function search(Request $request){


        $product=Product::where('name','like','%'.$request->name.'%')->get();
  if ($product){

 return response()->json(['message'=>'product found','products'=>$product],200,);

  }else{

 return response()->json(['message'=>'product not found'],404,);
  }
        // dd($product);
        // dd($request->json("name"));Product::all();


    }





}
