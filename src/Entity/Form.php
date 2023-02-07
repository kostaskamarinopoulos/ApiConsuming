<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\CompanySymbolConstraint;
use App\Validator as AcmeAssert;

class Form
{
    #[Assert\NotBlank]
    #[AcmeAssert\CompanySymbolConstraint]
    private $companySymbol;

    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('today')]
    public $startDate;

    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('today')]
    public $endDate;

    #[Assert\NotBlank]
    private $email;

    public function setCompanySymbol($companySymbol): void
    {
        $this->companySymbol = $companySymbol;
    }

    public function getCompanySymbol(): string
    {
        return $this->companySymbol;
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