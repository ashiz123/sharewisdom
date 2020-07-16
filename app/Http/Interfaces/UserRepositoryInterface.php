<?php



namespace App\Http\Interfaces;
use App\Models\User;



interface UserRepositoryInterface
{
    public function register($attributes);

    public function login($attributes);

    public function details();

    public function googleLogin($attributes);

    public function googleRegister($attributes);
}