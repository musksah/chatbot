<?php

namespace App\Conversations;

use App\Models\User;
use App\Classes\AccountUser;
use App\Classes\TransactionManage;
use App\Classes\SavingAccountManage;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ConversationAccountBalance extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionAccountBalance()
    {
        $this->ask('Do you want to know you account balance?', function (Answer $answer) {
            // Save result
            $botman_id = $this->bot->getUser()->getId();
            // print_r($botman_id);
            // die;
            $islogin = AccountUser::isLogin($botman_id);
            $user_id = $islogin['data']['user_id'];
            if ($islogin['ok'] == false) {
                $this->say($islogin['message']);
            } else {
                $this->response_question = $answer->getText();
                if (strpos('yes', $this->response_question) !== false || strpos('Yes', $this->response_question) !== false) {
                    $balance = SavingAccountManage::getAccountBalance($user_id);
                    if($balance['ok']){
                        TransactionManage::register($user_id, 3);
                        $this->say('The current account balance is: '.$balance['data']['value']);
                    }else{
                        $this->say($balance['message']);
                    }
                } else {
                    $this->say('That\'s okay.');
                }
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionAccountBalance();
    }
}
