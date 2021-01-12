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
            if ($islogin['ok'] == false) {
                $this->say($islogin['message']);
            } else {
                $this->response_question = $answer->getText();
                if (strpos('yes', $this->response_question) !== false) {
                    $balance = SavingAccountManage::getAccountBalance($islogin['data']['user_id']);
                    $this->say("The account balance is: {$balance}");
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
