<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Exception;

class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function __construct( UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function login(Request $request){ 


        $validator = Validator::make($request->all(), [ 
            
            'email' => 'required|email', 
            'password' => 'required', 
           
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);      
        }
        $user = $this->userRepository->login($request);

        
        if($user == "")
        {
            return response()->json(['error' => 'User unauthenticated'], 403);
        }
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['user'] =  $user;
        return new UserResource($success);
       
    }   
    
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 

         $user = $this->userRepository->register($request);
         $success['token'] =  $user->createToken('MyApp')-> accessToken; 
         $success['user'] =  $user;

         return new UserResource($success);
        
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = $this->userRepository->details();
        return new UserResource($user);

    } 
}