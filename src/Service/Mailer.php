<?php

namespace App\Service;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{

    public function __construct(private MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send($data)
    {
        $email = (new Email())
            ->from($_ENV['EMAIL_SENDER'])
            ->to($data->email)
            ->subject('for submitted Company Symbol = '.$data->companySymbol.' => Company’s Name = '.$data->companyName)
            ->text('From '.$data->startDate.' to '.$data->endDate);

        //Need to uncomment the line below
        //$this->mailer->send($email);
    }
}