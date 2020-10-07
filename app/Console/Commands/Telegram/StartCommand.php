<?php

namespace App\Console\Commands\Telegram;

use App\Models\User;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start using telegram bot";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $helloMessage = "Halo 👋 !\n" .
            "Selamat datang di Assistant Manager Bot 🤖 !\n" .
            "Sistem ini dibuat oleh Laboratorium Pemrograman Fakultas Ilmu Komputer Universitas Jember 🏫\n" .
            "Bot ini terintegrasi langsung dengan Assistant Manager pada " . env('APP_URL') . "\n";

        $startMessage = "Silahkan melakukan register dengan cara mengirim perintah :\n" .
            "/register <nim kamu>";
        $this->replyWithMessage([
            'text' => $helloMessage
        ]);

        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $telegram_id = $this->update->message->from->id;
        $user = User::where('telegram_id', $telegram_id)->first();
        if (!$user) {
            $this->replyWithMessage([
                'text' => $startMessage
            ]);
        }
    }
}
