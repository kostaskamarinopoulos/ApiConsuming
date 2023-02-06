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
    // #[Assert\Type(\DateType::class)]
    public $startDate;

    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('today')]
    // #[Assert\Type(\DateType::class)]
    public $endDate;

    #[Assert\NotBlank]
    // #[Assert\Type(\EmailType::class)]
    public $email;

}