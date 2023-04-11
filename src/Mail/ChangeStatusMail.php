<?php

namespace App\Mail;

use Symfony\Component\Mime\Email;

class ChangeStatusMail extends Email
{

    public function __construct($from)
    {
        parent::__construct();
        $this->from($from);
        $this->subject('Changement de contrat');
        $this->html('<p>Bonjour,</p><p>Votre statut de contrat viens de changer</p>');
    }
}
