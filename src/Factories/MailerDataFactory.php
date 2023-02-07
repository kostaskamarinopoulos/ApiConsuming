<?php

namespace App\Factories;

use App\Entity\MailerData;
use App\Service\Client;
use App\Entity\Form;

class MailerDataFactory {

    public function __construct(private Client $client)
    {
        $this->client = $client;
    }

    public function create(Form $data): MailerData
    {        
        $mailerData = new MailerData();
        $mailerData->setCompanyName($this->companyNameMapper($data->getCompanySymbol()));
        $mailerData->setCompanySymbol($data->getCompanySymbol());
        $mailerData->setEndDate($data->endDate->format('Y-m-d'));
        $mailerData->setStartDate($data->startDate->format('Y-m-d'));
        $mailerData->setEmail($data->getEmail());

        return $mailerData;
    }

    public function companyNameMapper(string $companySymbol): string
    {
        $items = $this->client->fetch([]);

        foreach($items as $item) {
            if($item['Symbol'] === $companySymbol) {
                return $item['Company Name'];
            } 
        }
    }
}