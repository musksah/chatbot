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

class ConversationDeposite extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionDeposite()
    {
        $this->ask('Do you to deposite money in your saving account?', function (Answer $answer) {
            // Save result
            $botman_id = $this->bot->getUser()->getId();
            // print_r($botman_id);
            // die;
            $islogin = AccountUser::isLogin($botman_id);
            if ($islogin['ok'] == false) {
                $this->say($islogin['message']);
            } else {
                $this->response_question = $answer->getText();
                if (strpos('yes', $this->response_question) !== false || strpos('Yes', $this->response_question) !== false) {
                    $this->questionQuantityMoney();
                } else {
                    $this->say('That\'s okay.');
                }
            }
        });
    }

    /**
     * Recollect Email 
     */
    public function questionQuantityMoney()
    {
        $this->ask('How much do you want to deposit?', function (Answer $answer) {
            // Save result
            $botman_id = $this->bot->getUser()->getId();
            $user_id = AccountUser::isLogin($botman_id)['data']['user_id'];
            $this->number = $answer->getText();
            $value = SavingAccountManage::validateValue($this->number);
            if ($value['ok'] == false) {
                $this->say($value['message']);
            }
            $deposite = SavingAccountManage::deposite($user_id, $this->number);
            TransactionManage::register($user_id, 1);
            $this->say($deposite['message']);
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionDeposite();
    }
}
