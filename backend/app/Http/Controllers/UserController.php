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


    public function getUser(Request $request, $id){
        try{
             $user =  user::find($id);
  
             return response()->json(['message' => $user,]);

        } catch(\Exception $err){
            return response()->json(['error' => 'USER NOT FOUND',] , 404); 

        }
      
    }



    public function CreateUser(Request $request ){
        try {

        $user = new User;
        
    
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $password = $request->input('password');
        $request->validate([
            'password' => 'required|string|min:8|max:16',
       ]);
        $isSuper = $request->input('isSuper' , true);

        $user->fullname = $fullname;
        $user->email = $email;
        $user->password = $password;
        $user->isSuper = $isSuper;
        $user->save();

        return response()->json([
            'message' => 'user created successfully!',
        ]);

    }catch (\Exception $err) {
        return response()->json(['message' => 'Error adding user: '. $err->getMessage(),], 500); 
    }
}




        public function editUser(Request $request, $id)
        {
            try {
                $user = User::findOrFail($id);
                $inputs = $request->except('_method');
                $user->update($inputs);

                //start_check if is admin
                $isSuper = $request->input('isSuper' , false);
                $user->isSuper = $isSuper;
                //end_check if is admin


                return response()->json([
                    'user' => $user,
                ]);
            }catch (\Exception $err) {
                return response()->json(['message' => 'Error updating user: ' . $err->getMessage(), ], 500); 
            }
        }

   
         
        public function destroyUser(Request $request, $id){
         
            $user =  User::find($id);
            $user->delete();
            return response()->json([
                'message' => 'User deleted Successfully!',
         
            ]);
        }

       
}
