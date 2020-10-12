<?php

namespace App\Notifications;

use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class UpdateAssignmentNotification extends Notification
{
    use Queueable;
    private $assignment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $assignment = $this->assignment;
        $url = route('dashboard.student.assignment.show', $assignment);

        $message = "Halo! 👋 \n" .
            'Tugas *'. $assignment->title .'* di kelas *' . $assignment->classroom->title . "* telah diubah oleh \n" .
            'Silahkan cek lagi tugas dan kerjakan sebelum *' . $assignment->deadline->format('d F Y - H:i') . "* ⏳ \n" .
            'Good Luck ✨';


        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content($message)
            ->button('Lihat Tugas', $url);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
