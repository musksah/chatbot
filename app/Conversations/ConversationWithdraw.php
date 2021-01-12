<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Classes\AccountUser;

class ConversationSignUp extends Conversation
{
    /**
     * First question
     */
    public function initialQuestionSignUp()
    {
        $this->ask('To create an account you should give us username and a secure password. Do you agree?', function (Answer $answer) {
            // Save result
            $this->response_question = $answer->getText();
            if (strpos('yes', $this->response_question) !== false) {
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
            // Save result
            $account_user = new AccountUser();
            $this->email_password = $answer->getText();
            $data_response = AccountUser::getUserPasswordFromQuestion(trim($this->email_password));
            if($data_response['ok'] == false){
                return $this->say($data_response['message']);
            }
            $credentials = $data_response['data'];
            $email = $credentials['email'];
            $password = $credentials['password'];
            // Validating input password
            $response_vp = AccountUser::validatePassword($password);
            if ($response_vp['ok'] == true) {
                $user = $account_user->create($email, $password);
                if($user){
                    return $this->say('Your user account was created and you are logged in.');
                }else{
                    return $this->say('An error occurred in the process.');
                }
            } else {
                $this->say($response_vp['message']);
                return $this->initialQuestionSignUp();
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
                $this->initialQuestionSignUp();
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->initialQuestionSignUp();
    }
}
