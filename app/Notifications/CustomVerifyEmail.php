<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    public function via($notifiable) // specifica che la notifica deve essere inviata tramite mail (return mail)
    {
        return ['mail'];
    }

    protected function verificationUrl($notifiable) // crea url temporaneo per la verifica
    {
        return URL::temporarySignedRoute(
            'verification.verify', // rotta di verifica email di laravel
            Carbon::now()->addMinutes(60), // il link scade dopo 60 minuti
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())] // passa i parametri necessari, id utente e email hashata per sicurezza
        );
    }

    public function toMail($notifiable) // genera contenuto mail da inviare
    {
        $verificationUrl = $this->verificationUrl($notifiable); // link di verifica

        return (new MailMessage)
            ->subject('Verifica la tua email')
            ->view('emails.verify-email-custom', [ // view dell'email custom
                'url' => $verificationUrl, // passa il link di verifica generato prima
                'notifiable' => $notifiable, // utente o modello destinatario
            ]);
    }
}
