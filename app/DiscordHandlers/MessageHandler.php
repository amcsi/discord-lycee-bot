<?php
declare(strict_types=1);

namespace App\DiscordHandlers;

use Discord\Discord;
use Discord\Parts\Channel\Message;

class MessageHandler
{
    public function handle(Message $message)
    {
        if (!$message->content) {
            echo "Message content is empty. Perhaps something is wrong with the message reading permissions.\n";
            return;
        }
        if (!preg_match('/^\s*!LO-(\d{4})\s*$/i', $message->content, $matches)) {
            return;
        }

        $cardId = 'LO-' . $matches[1];

        $replyContent = "https://lycee-tcg.eu/cards?cardId=$cardId";

        if (!$message->channel->is_private) {
            $message->channel->sendMessage($replyContent);
        } else {
            $message->author->sendMessage($replyContent);
        }
    }
}
