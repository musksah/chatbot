<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Conversations\ExampleConversation;
use App\Conversations\ConversationCurrency;
use App\Conversations\ConversationSignUp;
use App\Conversations\ConversationLogIn;



class ChatBotController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationCurrency(BotMan $bot)
    {
        $bot->startConversation(new ConversationCurrency());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationSignUp(BotMan $bot)
    {
        $bot->startConversation(new ConversationSignUp());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationLogIn(BotMan $bot)
    {
        $bot->startConversation(new ConversationLogIn());
    }


}
