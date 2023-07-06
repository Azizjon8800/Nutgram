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

        Nutgram::macro('sendHelloMessage', function() {
            return $this->sendMessage('Hello message!', ['chat_id' => 1153216 ]);
        });

        Message::macro('pin', function(array $opt = []) {
            return $this->pinChatMessage($this->chat->id, $this->message_id, $opt);
        });

        $message = $bot->sendHelloMessage();
        $message->pin();
        $bot->run();
    }
}
