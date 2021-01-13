<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ConversationHelp extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionHelp()
    {
        $this->say('1. To Sign up type "sign up"');
        $this->say('2. To Log in type "log in"');
        $this->say('3. To deposite money in your account type "deposite"');
        $this->say('4. To withdraw money in your account type "withdraw"');
        $this->say('5. To exchange currencies type "exchange currency"');
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionHelp();
    }
}
