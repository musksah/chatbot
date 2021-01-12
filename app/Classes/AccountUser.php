<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;
use App\Classes\CustomResponse;
use App\Models\User;
use App\Models\Session;
use App\Models\SavingAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if ($user) {
            return CustomResponse::do(false, 'The email already exists.');
        } else {
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

    public function create($email, $password, $botman_id)
    {
        $user = User::create([
            'name' => '',
            'email' => $email,
            'password' => $password,
            'botman_id' => $botman_id
        ]);
        $save = $user->save();
        $user_id = $user->id;
        $this->startSession($user_id);
        $saving_account = SavingAccount::create([
            'value' => 0,
            'user_id' => $user_id
        ]);
        return $save;
    }

    public function startSession($user_id, $botman_id = null)
    {
        if ($botman_id != null) {
            $user = User::where('id', $user_id)->update(['botman_id' => $botman_id]);
        }
        $session = Session::where('user_id', $user_id)->first();
        if ($session) {
            $session = Session::where('user_id', $user_id)->update(['active' => 1]);
        } else {
            $session = Session::create([
                'active' => 1,
                'user_id' => $user_id
            ]);
        }
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

    public function process_login($credentials, $botman_id)
    {
        $email = $credentials['email'];
        $user = User::where('email', $email)->first();
        if (!$user) {
            return CustomResponse::do(false, 'The credentials are invalid.');
        }
        $password = $credentials['password'];
        if (Hash::check($password, $user->password, [])) {
            $this->startSession($user->id, $botman_id);
            return CustomResponse::do(true, 'Valid credentials.');
        } else {
            return CustomResponse::do(false, 'The credentials are invalid.');
        }
    }

    public static function isLogin($botman_id)
    {
        $user = User::where('botman_id', $botman_id)->first();
        if ($user) {
            return CustomResponse::do(true, 'You are not log in. To deposite you have to log in. Please type "log in"', ['user_id' => $user->id]);
            // Session::where('user_id', $user['id'])->first();
        } else {
            return CustomResponse::do(false, 'You are not log in. To deposite you have to log in. Please type "log in"');
        }
    }
}
