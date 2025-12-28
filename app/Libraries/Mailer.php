<?php

namespace App\Libraries;

class Mailer
{
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }

    public function sendReceipt($to, $name, $pdfPath)
    {
        $message = view('emails/booking', [
            'name' => $name
        ]);

        $this->email->setTo($to);
        $this->email->setSubject('Your Receipt');
        $this->email->setMessage($message);
        $this->email->attach($pdfPath);

        return $this->email->send();
    }
}
