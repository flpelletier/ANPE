<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{
    use Queueable;
      /**
     * The password reset token.
     *
     * @var string
     */
     public $token;

     /**
      * The callback that should be used to build the mail message.
      *
      * @var \Closure|null
      */
     public static $toMailCallback;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;

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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }
        return (new MailMessage)
        ->subject(Lang::get('Réinitialisation de votre mot de passe'))
        ->from('tplaravel284@gmail.com','Noreply - Lycée Pasteur Mond Roland')
        ->line(Lang::get('Vous recevez ce courriel parce que nous avons reçu une demande de réinitialisation du mot de passe de votre compte.'))
        ->action(Lang::get('Réinitialiser mon mot de passe'), url(config('http://tp_offre.test/OFFRE/public/').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
        ->line(Lang::get('Ce lien de réinitialisation du mot de passe expirera dans :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
        ->line(Lang::get('Si vous n\'avez pas demandé une réinitialisation du mot de passe, aucune autre action n\'est requise.'));
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
