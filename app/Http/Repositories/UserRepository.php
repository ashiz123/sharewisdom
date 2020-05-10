<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    public function __construct()
    {
       
    }

    public function register($attributes)
    {
        $validator = Validator::make($attributes->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }


        $input = $attributes->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input);   //storing data in database

        return $user;
       
        //for response
        // $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        // $success['user'] =  $user;
        // return response()->json(['success'=>$success], $this-> successStatus); 
    }


    public function login($attributes)
    {
        If(Auth::attempt(['email' => $attributes->email, 'password' => $attributes->password]))
            {
                $user = Auth::user();
                return $user;
            }
           
     }


     public function details()
     {
        $user = Auth::user(); 
        return $user;
     }


  

}
