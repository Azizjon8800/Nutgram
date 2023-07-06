<?php

namespace App\Http\Controllers\nutgram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Polling;
use SergiX44\Nutgram\Telegram\Types\Message\Message;

class NutController extends Controller
{
    public function show(): void
    {
        $bot = new Nutgram($_ENV['TELEGRAM_TOKEN']);
        $bot ->setRunningMode(Polling::class);

        $bot->onCommand('start', function(Nutgram $bot) {
            $bot->sendMessage('Ciao!');
        });

        $bot->onText('My name is {name}', function(Nutgram $bot, string $name) {
            $bot->sendMessage("Hi $name");
        });


        $bot->run();
    }
}
