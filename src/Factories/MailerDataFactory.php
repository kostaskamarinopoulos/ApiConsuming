<?php

namespace App\Factories;

use App\Entity\MailerData;
use App\Service\Client;

class MailerDataFactory {

    public function __construct(private Client $client)
    {
        $this->client = $client;
    }

    public function create($data)
    {
        $mailerData = new MailerData();
        $mailerData->setCompanyName($this->companyNameMapper($data->companySymbol));
        $mailerData->setCompanySymbol($data->companySymbol);
        $mailerData->setEndDate($data->endDate->format('Y-m-d'));
        $mailerData->setStartDate($data->startDate->format('Y-m-d'));
        $mailerData->setEmail($data->email);

        return $mailerData;
    }

    public function companyNameMapper($companySymbol) 
    {
        $items = $this->client->fetch([]);

        foreach($items as $item) {
            if($item['Symbol'] === $companySymbol) {
                return $item['Company Name'];
            } 
        }
    }
}