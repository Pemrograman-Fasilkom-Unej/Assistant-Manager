<?php

namespace App\Console\Commands\Telegram;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class ResetPasswordCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "resetpassword";

    /**
     * @var string Command Description
     */
    protected $description = "Reset Password your Assistant Manager Account";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $telegram_id = $this->update->message->from->id;
        $user = User::where('telegram_id', $telegram_id)->first();
        if ($user) {
            $pass = Str::random(8);
            $user->update([
                'password' => Hash::make($pass)
            ]);

            $this->replyWithMessage([
                'text' => "Selamat 🎉🎉🎉 \n" .
                    "Password anda berhasil di reset! \n" .
                    "Password anda yang baru adalah : $pass"
            ]);
        } else {
            $this->replyWithMessage([
                'text' => 'Akun anda tidak teregistrasi di sistem kami'
            ]);
        }
    }
}
