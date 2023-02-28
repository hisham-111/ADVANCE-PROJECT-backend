<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAllUser() 
    {
        $user= user::all();
        return response()->json(['user' => $user,]);
    }


    public function getUser(Request $request, $id) 
    {
        try {
            $user = user::findOrFail($id == 'user');
    
            return response()->json(['message' => $user,]);

        } catch (\Exception $err) {
            return response()->json(['error' => 'USER NOT FOUND',] , 404); 
        }
    }






    public function CreateUser(Request $request ){
        try {

        $user = new user;
        
    
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $password = $request->input('password');

        $user->fullname = $fullname;
        $user->email = $email;
        $user->password = $password;

        $user->save();

        return response()->json([
            'message' => 'user created successfully!',
        ]);

    }catch (\Exception $err) {
        return response()->json(['message' => 'Error adding user: '. $err->getMessage(),], 500); 
    }
}
















            // public function update(Request $request, $id)
            // {
            //     $update = [
            //         "name"=>$request->name,
            //         "email"=>$request->email,
            //         "password"=>$request->password,
            //     ];
            //     User::where('id', $id)->update($update);
            //     $msg = "User Updated successful! ";
            //     return redirect('user')->with('msg', $msg);
            // }


        public function editUser(Request $request, $id)
        {
            try {
                $user = user::findOrFail($id);
                $inputs = $request->except('_method');
                $user->update($inputs);
                
                return response()->json([
                    'user' => $user,
                ]);

            }catch (\Exception $err) {
                return response()->json([
                    'message' => 'Error updating user: ' . $err->getMessage(), ], 500); 
            }
        }


        public function destroyUser(Request $request, $id)
        {
            $user =  user::find($id);
            $user->delete();

            return response()->json([
            'message' => 'user deleted Successfully!',
        ]);


        }
}
