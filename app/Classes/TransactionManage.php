<?php

namespace App\Classes;

use App\Models\SavingAccount;
use App\Classes\CustomResponse;
use App\Models\Transaction;

class TransactionManage
{
    public function __construct()
    {
        return "construct function was initialized.";
    }

    public static function register($user_id, $id_type_transaction)
    {
        $saving_account = SavingAccount::where('user_id', $user_id)->first();
        if ($saving_account) {
            Transaction::create([
                'saving_account_id' => $saving_account->id,
                'type_transaction_id' => $id_type_transaction,
            ]);
        }
        return CustomResponse::do(false, 'Saving account don\'t find it.');
    }
}
