<?php
use App\Http\Controllers\ChatBotController;

$botman = resolve('botman');


$botman->hears('.*help.*',[ChatBotController::class,'startConversationHelp']);

$botman->hears('.*log in.*',[ChatBotController::class,'startConversationLogIn']);

$botman->hears('.*sign up.*',[ChatBotController::class,'startConversationSignUp']);

$botman->hears('.*exchange currency.*',[ChatBotController::class,'startConversationCurrency']);

$botman->hears('Start conversation', [ChatBotController::class,'startConversation']);

$botman->hears('.*deposite.*', [ChatBotController::class,'startConversationDeposite']);

$botman->hears('.*balance.*', [ChatBotController::class,'startConversationAccountBalance']);

$botman->hears('.*withdraw.*', [ChatBotController::class,'startConversationWithDraw']);

