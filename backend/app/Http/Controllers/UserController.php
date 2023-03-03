<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

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


        // register
        public function register(Request $request ){
            try {

            $user = new User;
            $fullname = $request->input('fullname');
            $email = $request->input('email');
        
            $password = Hash::make($request->input('password'));
            $request->validate([
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
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

        // login

        public function login(Request $request)
        {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response([
                    'message' => 'Invalid credentials!'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user = Auth::user();

            $token = $user->createToken('token')->plainTextToken;

            $cookie = cookie('jwt', $token, 60 * 24); // 1 day

            return response([
                'message' => $token
            ])->withCookie($cookie);
        }

        // logout
        public function logout()
        {
            $cookie = Cookie::forget('jwt');

            return response([
                'message' => 'Success'
            ])->withCookie($cookie);
        }

        public function user()
        {
            return Auth::user();
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
                $request->validate([
                    'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                    'password' => 'required|string|min:8|max:16',
                ]);


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
