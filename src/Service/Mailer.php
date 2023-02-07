<?php

namespace App\Service;

use App\Entity\MailerData;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class Mailer
{
    public function __construct(private MailerInterface $mailer, private LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function send(MailerData $data)
    {
        try {
            $email = (new Email())
                ->from($_ENV['EMAIL_SENDER'])
                ->to($data->getEmail())
                ->subject('for submitted Company Symbol = '.$data->getCompanySymbol().' => Company’s Name = '.$data->getCompanyName())
                ->text('From '.$data->getStartDate().' to '.$data->getEnddate());

            //Need to uncomment the line below
            // $this->mailer->send($email);
            return $email;

        } catch (\Exception $exception) {
            $this->logger->warning(get_class($exception) . ': ' . $exception->getMessage() . ' in ' . $exception->getFile()
                . ' on line ' . $exception->getLine());
        }
    }
}