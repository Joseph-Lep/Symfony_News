<?php

namespace App\Newsletter;

use App\Entity\NewsletterEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailNotification
{
    public function __construct(
        private MailerInterface $mailer,
        private string $adminEmail
    ) {
    }

    public function sendConfirmationEmail(
        NewsletterEmail $newEmail
    ): void {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($newEmail->getEmail())
            ->subject('Inscription à la newsletter')
            ->text('Votre email ' . $newEmail->getEmail() . ' a bien été enregistré, merci');

        $this->mailer->send($email);
    }
}
