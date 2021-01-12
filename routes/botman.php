<?php
use App\Http\Controllers\ChatBotController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('.*log in.*',[ChatBotController::class,'startConversationSignUp']);

$botman->hears('.*sign up.*',[ChatBotController::class,'startConversationSignUp']);

$botman->hears('.*currency.*',[ChatBotController::class,'startConversationCurrency']);

$botman->hears('Start conversation', [ChatBotController::class,'startConversation']);

$botman->hears('call me {name} the {adjective}', function ($bot, $name, $adjective) {
    $bot->reply('Hello '.$name.'. You truly are '.$adjective);
});
