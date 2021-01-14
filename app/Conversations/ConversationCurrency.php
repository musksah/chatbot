<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Classes\CurrencyExchange;

class ConversationCurrency extends Conversation
{
    private $currency_change;

    public function __construct()
    {
        $this->currency_change = new CurrencyExchange();
    }
    /**
     * First question
     */
    public function initialQuestionCurrency()
    {
        $this->ask('Do you want to exchange currency?', function (Answer $answer) {
            // Save result
            $this->response_currency = $answer->getText();
            if (strpos('yes', $this->response_currency) !== false || strpos('Yes', $this->response_question) !== false) {
                $this->currencyPickQuestion();
            } else {
                $this->say('That\'s okay.');
            }
        });
    }

    public function currencyPickQuestion()
    {
        $this->ask('Which currency do you want to convert? Let me know it like this example: "2000 cop to usd"', function (Answer $answer) {
            // Save result
            $currency_changec = new CurrencyExchange();
            $this->currency_format = $answer->getText();
            $response = $currency_changec->create($this->currency_format);
            $value = $response['value'];
            if ($response['completed']) {
                $this->say("The result in {$response['to_currency']} is: {$value}");
            } else {
                $this->say($value);
                $this->initialQuestionCurrency();
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionCurrency();
    }
}
