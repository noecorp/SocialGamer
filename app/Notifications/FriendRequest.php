<?php

namespace App\Notifications;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendRequest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('Social gamer: Zaproszenie do znajomych')
                    ->greeting('Witaj!')
                    ->line('Masz nowe aproszenie do znajomych od '.Auth::user()->name)
                    ->action('Zobacz profil użytkownika', $_ENV['APP_URL'].'/users/'.Auth::id())
                    ->line('Dziękuję za korzystanie z mojej aplikacji!');
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
            'message' => 'Masz zaproszenie do znajomych od użytkownika: '. Auth::user()->name,
            'from_user_id' => Auth::id(),
            'from_user_name' => Auth::user()->name,
        ];
    }
}
