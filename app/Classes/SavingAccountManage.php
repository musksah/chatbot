<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;
use App\Models\SavingAccount;
use App\Classes\CustomResponse;
use Illuminate\Support\Facades\Auth;

class SavingAccountManage
{
    public function __construct()
    {
        return "construct function was initialized.";
    }

    public static function deposite($user_id, $value)
    {
        $saving_account = SavingAccount::where('user_id', $user_id)->first();
        if ($saving_account) {
            $old_value = $saving_account->value;
            $new_value = $value + $old_value;
            SavingAccount::where('user_id', $user_id)->update(['value' => $new_value]);
            return CustomResponse::do(true, 'Value deposited');
        }
        return CustomResponse::do(false, 'Saving account don\'t find it.');
    }

    public static function getAccountBalance($user_id)
    {
        $saving_account = SavingAccount::where('user_id', $user_id)->first();
        if ($saving_account) {
            return CustomResponse::do(true, 'Value deposited', ['value' => $saving_account->value]);
        }
        return CustomResponse::do(false, 'Saving account don\'t find it.');
    }

    public static function withdrawMoney($user_id, $value_withdraw)
    {
        $saving_account = SavingAccount::where('user_id', $user_id)->first();
        if ($saving_account) {
            if ($value_withdraw > $saving_account->value) {
                return CustomResponse::do(false, 'Insufficient funds.');
            } else {
                $new_value = $saving_account->value - $value_withdraw;
                // Update the account balance after withdraw
                SavingAccount::where('user_id', $user_id)->update(['value' => $new_value]);
                // Register the transaction
                TransactionManage::register($user_id,2);
                return CustomResponse::do(true, 'You has withdraw '.$new_value);
            }
        }
        return CustomResponse::do(false, 'Saving account don\'t find it.');
    }


    public static function process_login($credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateValue($value)
    {
        if (is_numeric($value) == false) {
            return CustomResponse::do(false, 'The input value is not correct.');
        }
        return CustomResponse::do(true, 'Correct value.');
    }
}
