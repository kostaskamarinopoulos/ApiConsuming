<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\CompanySymbolConstraint;
use App\Validator as AcmeAssert;

class Form
{
    #[Assert\NotBlank]
    #[AcmeAssert\CompanySymbolConstraint]
    public $companySymbol;

    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('today')]
    public $startDate;

    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('today')]
    public $endDate;

    #[Assert\NotBlank]
    public $email;

}