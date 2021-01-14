<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Classes\AccountUser;


class ConversationLogIn extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionLogIn()
    {
        $this->ask('Do you want to log in?', function (Answer $answer) {
            // Save result
            $this->response_question = $answer->getText();
            if (strpos('yes', $this->response_question) !== false || strpos('Yes', $this->response_question) !== false) {
                $this->questionEmailPassword();
            } else {
                $this->say('That\'s okay.');
            }
        });
    }

    /**
     * Recollect Email 
     */
    public function questionEmailPassword()
    {
        $this->ask('Type your email and password like this example. Example:"user password"', function (Answer $answer) {
            $account_user = new AccountUser();
            // Save result
            // $this->say('Fuck you');
            // die;
            $botman_id = $this->bot->getUser()->getId();
            $this->email_password = $answer->getText();
            $data_response = AccountUser::getUserPasswordFromQuestion(trim($this->email_password));
            if($data_response['ok'] == false){
                return $this->say($data_response['message']);
            }
            $credentials = $data_response['data'];
            $email = $credentials['email'];
            $password = $credentials['password'];
            // Validating input email
            $login = $account_user->processLogin($credentials, $botman_id);
            // print_r($login);
            // die;
            if($login['ok'] || $login['ok'] == 1){
                $this->say('User has successfully logged.');
            }else{
                $this->say('Invalid credentials.');
            }
            
        });
    }

    /**
     * Recollect Password 
     */
    public function questionPassword($email)
    {
        $this->ask('Type your password: ', function (Answer $answer) {
            // Save result
            $this->password = $answer->getText();
            $response = AccountUser::validatePassword($this->password);    
            if ($response['ok'] == true) {
                // $user = AccountUser::create($this->email , $this->password);
                // print_r('email: '.$this->email);
                // print_r('password: '.$this->password);
            } else {
                $this->say($response['message']);
                $this->initialQuestionLogIn();
            }
        });
    }

    

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionLogIn();
    }
}
