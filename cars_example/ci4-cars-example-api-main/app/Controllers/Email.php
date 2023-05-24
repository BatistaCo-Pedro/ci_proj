<?php

namespace App\Controllers;

class Email extends BaseController
{

   public function send() {

    $email = \Config\Services::email();

    $email->setFrom('pedrocorreiabatista@gmail.com', 'Pedro');
    $email->setTo('pedrocorreiabatista@gmail.com');

    $email->setSubject('Email Test');
    $email->setMessage('Testing the email class.');

    $email->send();

    if (! $email->send()) {
        log_message("debug", "merde");
    }
   }
}
