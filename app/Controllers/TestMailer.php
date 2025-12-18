<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Mailer;

class TestMailer extends BaseController
{
    public function send()
    {
        $mailer = new Mailer();

        // Use your email for testing
        $to = 'liyana.affandi2005@gmail.com';
        $name = 'Liyana';

        // Optional: create a simple PDF for attachment
        $pdfPath = WRITEPATH . 'lucky draw.pdf';
        file_put_contents($pdfPath, 'This is a test PDF content.');

        if ($mailer->sendReceipt($to, $name, $pdfPath)) {
            return "Email sent successfully!";
        } else {
            $email = \Config\Services::email();
            return "Failed to send email. Debug: " . $email->printDebugger();
        }
    }
}
