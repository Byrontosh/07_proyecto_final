<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUserNotification extends Notification
{
    use Queueable;

    private string $username;
    private string $user_role;
    private string $password;

    public function __construct(string $user, string $user_role, string $password)
    {
        $this->username = $user;
        $this->user_role = $user_role;
        $this->password = $password;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        $login_url = url('/login');
        return (new MailMessage)
            ->subject('Successful user registration')
            ->line('Welcome' . " $this->username")
            ->line('You have been registered in the system with the role of' . " $this->user_role")
            ->line('The generated password is:' . " $this->password")
            ->line('You can now login by selecting the following option')
            ->action('Login', $login_url)
            ->line('Remember: change your password when you verify your email and login to the system.');
    }

}
