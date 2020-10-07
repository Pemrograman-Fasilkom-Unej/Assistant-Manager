<?php

namespace App\Console\Commands\Telegram;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "register";

    /**
     * @var string Command Description
     */
    protected $description = "Register your telegram id to our system";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $telegram_id = $this->update->message->from->id;
        $nim = Str::of($this->update->message->text)->explode(' ')->toArray()[1];

        if (User::where('telegram_id', $telegram_id)->first()) {
            $this->replyWithMessage([
                'text' => "Maaf, akun telegram anda sudah terdaftarkan"
            ]);
            return;
        }

        $user = User::where('username', $nim)->first();

        if ($user) {
            $pass = Str::random(8);
            $user->update([
                'telegram_id' => $telegram_id,
                'password' => Hash::make($pass),
                'activate_at' => now()
            ]);

            $message = "Selamat Datang $user->name 🎉 \n" .
                "Password anda untuk login ke " . env('APP_URL') . " : $pass \n" .
                "Tolong simpan dan jangan bagikan password ini ke orang lain ❤️";
            $this->replyWithMessage(['text' => $message]);
        } else {
            $this->replyWithMessage([
                'text' => "Maaf, NIM tidak ditemukan \n Silahkan hubungi admin @miqdadyyy"
            ]);
        }
    }
}
