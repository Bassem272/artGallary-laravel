<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =User::all();
        return response()->json(['message'=>'all users are here','users'=>$users],
        201, ['Content-Type' => 'application/json;charset=UTF-8',], );

    }

    // find one item
    // public function showOne($id){
    //     $user = user::find($id);

    //     return response($user, 200, ['Content-Type => application/json;charset=UTF-8',], );
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
    }
    // public function getCsrfToken()
    // {
    //     $token = csrf_token(); // Generate the CSRF token
    //     Log::info('CSRF token: ' . $token);

    //     return response()->json(['csrf_token' => $token],201);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password'=>'string|required|min:8|max:16',
            'role'=>'required|string|in:admin,customer',
            'address'=>'required|string',
            'phone'=>'required|string',


        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'address' => $data['address'],
            'phone'=>$data['phone'],

        ]);
        $customer = null;
        if($data['role']==='customer'){
      $customer=Customer::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'address'=>$data['address'],
            'phone'=>$data['phone'],

        ]);

        }

        return response()->json([
        'message'=>'user created successfully',
        'user'=>$user,
        'customer'=>$customer],
        201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        // DISplay the specific resource
        return response()->json($user,
         200,
         ['Content-Type' => 'application/json;charset=UTF-8',] ,);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Update the specified resource in storage.
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|string|email',
            'password' => 'nullable|string|min:8|max:16', // You can use 'nullable' if password is optional
            'role' => 'required|string|in:admin,customer', // Ensure 'role' is one of these values
        ]);
        // Update user data
        $user->update($data);
        dd($user);

        // Check if the updated role is 'admin'
        if ($data['role'] === 'admin') {
            // Find and delete the associated customer
            $customer = Customer::where('name', $data['name'])->where('email', $data['email'])->first();
            if ($customer) {
                $customer->delete();
            }
        }

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    { $userName=$user->name;
        // delete specified user
        $user->delete();
        // delete the associated customer
        $customer = Customer::where('name', $user->name)->where('email', $user->email)->first();
        if ($customer) {
            $customer->delete();
        }
        return response()->json(['message' => 'user: '.$userName.' deleted success'], 200, ['Content-Type' => 'application/json;charset=UTF-8',], );
    }

    // we will upgrade the customer to admin
    public function upgrade(user $user){
        $user->update(['role'=>'admin']);
        return response()->json(['message'=>'user upgraded success','users'=>  $user], 200, ['Content-Type' => 'application/json;charset=UTF-8',], );
    }
}

