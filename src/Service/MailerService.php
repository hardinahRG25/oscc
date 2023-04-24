<?php

namespace App\Service;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use App\Mail\ChangeStatusMail;


class MailerService
{
    private $logger;
    private $mailer;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public function sendEmail(
        Email $email
    ): void {
        $this->logger->notice('Send email using MailerService');
        $this->mailer->send($email);
    }
}
