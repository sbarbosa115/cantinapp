<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Register extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     * Register constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Bienvenido a Cantinapp')
            ->line("{$this->user->name}, gracias por registrarte.")
            ->line('Desde ahora vas a poder ordenar tus comidas favoritas con anticipación y recogerlas en el momento que mas te convenga utilizando nuestra nueva e ingeniosa aplicación')
            ->line('No lineas, no esperas, solo has tu selección y te notificaremos cuando tu pedido este listo.')
            ->action('¿EMPEZAMOS?', route('home.index'))
            ->line('Estas a uno pocos clicks de tu comida.')
            ->salutation('Equipo Cantinapp.');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
