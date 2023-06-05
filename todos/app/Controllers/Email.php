<?php

namespace App\Controllers;

class Email extends BaseController
{

   public function send() {

    $email = \Config\Services::email();

    $email->setFrom('pedro.correia@lernende.bfo-vs.ch', 'Pedrocas');
    $email->setTo('pedro.correia@lernende.bfo-vs.ch');

    $email->setSubject('Email Test');
    $email->setMessage('Testing the email class.');

    $email->send();

    if (! $email->send()) {
        log_message("debug", "Email::Send - Something went wrong while sending an email");
    }
   }
}
