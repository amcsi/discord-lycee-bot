<?php

namespace App\Console\Commands;

use App\DiscordHandlers\MessageHandler;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use Illuminate\Console\Command;
use function React\Promise\all;

class RunBotCommand extends Command
{
    protected $signature = 'bot:run';

    protected $description = 'Runs the bot';

    private MessageHandler $messageHandler;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $discord = app(Discord::class);
        $this->messageHandler = app(MessageHandler::class);

        $discord->on('ready', function (Discord $discord) {
            echo "Bot is ready.", PHP_EOL;

            // Listen for events here
            $discord->on('message', function (Message $message) {
                try {
                    $this->messageHandler->handle($message);
                } catch (\Throwable $exception) {
                    report($exception);
                }
            });
        });

        $discord->run();

        return 0;
    }
}
