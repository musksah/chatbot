<?php
use App\Http\Controllers\ChatBotController;

$botman = resolve('botman');

$botman->hears('anderson', function ($bot) {
    $bot->reply('Anderson no sabe programar!');
});

$botman->hears('Hi', function ($bot) {
    $user = $bot->getUser();
    $id = $user->getId();
    $bot->reply('Hello! '.$id);
});

$botman->hears('.*log in.*',[ChatBotController::class,'startConversationLogIn']);

$botman->hears('.*sign up.*',[ChatBotController::class,'startConversationSignUp']);

$botman->hears('.*currency.*',[ChatBotController::class,'startConversationCurrency']);

$botman->hears('Start conversation', [ChatBotController::class,'startConversation']);

$botman->hears('.*deposite.*', [ChatBotController::class,'startConversationDeposite']);

$botman->hears('.*balance.*', [ChatBotController::class,'startConversationAccountBalance']);

$botman->hears('call me {name} the {adjective}', function ($bot, $name, $adjective) {
    $bot->reply('Hello '.$name.'. You truly are '.$adjective);
});
