<?php
use App\Http\Controllers\ChatBotController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('Hey bro', function ($bot) {
    $bot->reply('Hello Rt!');
});

$botman->hears('.*Log in.*', function ($bot) {
    $bot->reply('Nice to meet you!');
});

$botman->hears('.*currency.*',[ChatBotController::class,'startConversation']);

$botman->hears('Start conversation', [ChatBotController::class,'startConversation']);