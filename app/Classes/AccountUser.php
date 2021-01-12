<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;
use App\Classes\CustomResponse;
use App\Models\User;

class AccountUser
{
    public function __construct()
    {
        return "construct function was initialized.";
    }

    public static function validateEmail($email)
    {
        if (strlen($email) < 5) {
            return CustomResponse::do(false, 'The email has to contain atleast five characters.');
        }
        $user = User::where('email', $email)->first();
        if($user){
            return CustomResponse::do(false, 'The email already exists.');     
        }else{
            return CustomResponse::do(true, 'Valid email.');     
        }
    }

    public static function validatePassword($password)
    {
        if (strlen($password) < 8) {
            return CustomResponse::do(false, 'The password has to contain atleast eight characters.');
        }
        return CustomResponse::do(true, 'Valid password.');
    }

    public static function create($email, $password)
    {
        $user = User::create([
            'name' => '',
            'email' => $email,
            'password' => $password,
        ]);
        return $user->save();
    }

    public static function login(){
        
    }

    public static function getUserPasswordFromQuestion($str_resp_signup)
    {
        $arr_signup = explode(" ", $str_resp_signup);
        // die;
        // Format Validations
        if (count($arr_signup) != 2) {
            return CustomResponse::do(false, 'I couldn\'t understand that format.');
        } else {
            $email = $arr_signup[0];
            $password = $arr_signup[1];
            $data = [
                'email' => $email,
                'password' => $password
            ];
            return CustomResponse::do(true, 'I couldn\'t understand that format.', $data);
        }
    }
}
