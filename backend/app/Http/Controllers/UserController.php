<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class UserController extends Controller
{

    public function getAllUser() 
    {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }

    
   
    // public function index()
    // {
    //     $users = User::latest()->paginate(5);
    
    //     return view('user.index',compact('users'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }
     
    
    // public function create()
    // {
    //     return view('user.create');
    // }
    
   
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
    
    //     User::create($request->all());
     
    //     return redirect()->route('user.index')
    //                     ->with('success','User created successfully.');
    // }
     


    
    
    // public function show(User $user)
    // {
    //     return view('user.show',compact('user'));
    // } 
     
   
    // public function edit(User $user)
    // {
    //     return view('user.edit',compact('user'));
    // }
    
   
    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
    
    //     $user->update($request->all());
    
    //     return redirect()->route('users.index')
    //                     ->with('success','User updated successfully');
    // }
    
   
    // public function destroyUser(User $user)
    // {
    //     $user->delete();
    
    //     return redirect()->route('user.index')
    //      ->with('success','User deleted successfully');
    // } 

    
      
}
