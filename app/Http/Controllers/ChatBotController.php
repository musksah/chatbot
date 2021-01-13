<?php

namespace App\Http\Controllers;

use App\Conversations\ConversationAccountBalance;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Conversations\ExampleConversation;
use App\Conversations\ConversationCurrency;
use App\Conversations\ConversationDeposite;
use App\Conversations\ConversationHelp;
use App\Conversations\ConversationSignUp;
use App\Conversations\ConversationLogIn;
use App\Conversations\ConversationWithDraw;

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

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationDeposite(BotMan $bot)
    {
        $bot->startConversation(new ConversationDeposite());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationAccountBalance(BotMan $bot)
    {
        $bot->startConversation(new ConversationAccountBalance());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationWithDraw(BotMan $bot)
    {
        $bot->startConversation(new ConversationWithDraw());
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public static function startConversationHelp(BotMan $bot)
    {
        $bot->startConversation(new ConversationHelp());
    }


}
