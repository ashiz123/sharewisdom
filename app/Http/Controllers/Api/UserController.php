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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;
use Google_Client;
use App\Helpers\GoogleApiValidate;
// require_once 'vendor/autoload.php';

class UserController extends Controller 
{
    
    public function __construct( UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public $successStatus = 200;

    private $userRepository;


    


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



    //need to refactor these functions.
    public function googleRegister(Request $request)
    {

        $client = new Google_Client(['client_id' => env("GOOGLE_CLIENT_ID")]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($request->id_token);
        
        if ($payload) {
        $userid = $payload['sub'];
        $user = User::where('id_token', $userid)->first();
        if ($user != null) {
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] =  $user;
            return new AuthenticationResource($success);
           
        }
            $user = new User;
            $user->id_token = $userid;
            $user->name = $payload['name'];
            $user->email = $payload['email'];
            $user->api_token = Hash::make($request->token);
            if($user->save())
            {
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['user'] = $user;
                $user->notify(new RegistrationSuccessful);
                return new AuthenticationResource($success);
            }
        }

        else {
        // Invalid ID token
        return response()->json('invalid id token');
        }
    }




    public function googleLogin(Request $request)
    {
      

        // Get $id_token via HTTPS POST.

        $client = new Google_Client(['client_id' => env("GOOGLE_CLIENT_ID")]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($request->id_token);
        
        if ($payload) {
        $userid = $payload['sub'];
        $user = User::where('id_token', $userid)->first();
        
        if ($user != null) {
             $success['token'] =  $user->createToken('MyApp')->accessToken; 
             $success['user'] =  $user;
             return new AuthenticationResource($success);
        }
            return response()->json('user not registered');
        }
         else {
        // Invalid ID token
        return response()->json('invalid token');
        }
        
    }

   

    
}