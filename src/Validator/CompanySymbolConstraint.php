<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CompanySymbolConstraint extends Constraint {
    public string $validCompanySymbol = '"{{ string }}" is not in the API';
}