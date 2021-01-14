<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Classes\AccountUser;
use App\Classes\SavingAccountManage;
use App\Models\User;

class ConversationWithDraw extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionWithDraw()
    {
        $this->ask('Do you want to withdraw money?', function (Answer $answer) {
            // Save result
            $botman_id = $this->bot->getUser()->getId();
            $islogin = AccountUser::isLogin($botman_id);
            if ($islogin['ok'] == false) {
                $this->say($islogin['message']);
            } else {
                $this->response_question = $answer->getText();
                if (strpos('yes', $this->response_question) !== false || strpos('Yes', $this->response_question) !== false) {
                    $this->questionQuantityWithDraw();
                } else {
                    $this->say('That\'s okay.');
                }
            }
        });
    }

    /**
     * Withdraw question 
     */
    public function questionQuantityWithDraw()
    {
        $this->ask('How much money do you want to withdraw? ', function (Answer $answer) {
            // Save result
            $botman_id = $this->bot->getUser()->getId();
            $islogin = AccountUser::isLogin($botman_id);
            $user_id = $islogin['data']['user_id'];
            $this->quantity = $answer->getText();
            $withdraw = SavingAccountManage::withdrawMoney($user_id, $this->quantity);
            if ($withdraw['ok']) {
                $this->say($withdraw['message']);
                $account_balance = SavingAccountManage::getAccountBalance($user_id);
                if($account_balance){
                    $this->say('Your new account balance is: '.$account_balance['data']['value']);
                }
            } else {
                $this->say($withdraw['message']);
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionWithDraw();
    }
}
