<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Http\Resources\AuthenticationResource;
use App\Notifications\RegistrationSuccessful;
use Exception;

class UserController extends Controller 
{
public $successStatus = 200;

private $userRepository;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function __construct( UserRepositoryInterface $userRepository)
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
       
        return new AuthenticationResource($success);
       
    }   
    
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 

         $userRepo = $this->userRepository->register($request);
         $user['token'] =  $userRepo->createToken('MyApp')-> accessToken; 
         $user['user'] =  $userRepo;
        //  $user['details'] = $userRepo->userDetail;

        $userRepo->notify(new RegistrationSuccessful);
         return new AuthenticationResource($user);
        
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