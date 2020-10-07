<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram;

class MainController extends Controller
{
    public function __invoke(Request $request){
        Telegram::commandsHandler(true);
        $updates = Telegram::getWebhookUpdates();

//        Log::info($updates->message->from->id);
        return "ok";
    }
}
