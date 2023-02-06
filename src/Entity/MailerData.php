<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\CompanySymbolConstraint;
use App\Validator as AcmeAssert;

class MailerData
{
    public string $companyName;
    public string $companySymbol;
    public string $endDate;
    public string $startDate;
    public string $email;

    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanySymbol($companySymbol): void
    {
        $this->companySymbol = $companySymbol;
    }

    public function getCompanySymbol(): string
    {
        return $this->companySymbol;
    }

    public function setEnddate($endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEnddate(): string
    {
        return $this->endDate;
    }

    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}