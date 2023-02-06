<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Service\Client;

class CompanySymbolConstraintValidator extends ConstraintValidator
{
    public function __construct(private Client $client)
    {
        $this->client = $client;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof CompanySymbolConstraint) {
            throw new UnexpectedTypeException($constraint, CompanySymbolConstraint::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->isValidSymbol($value)) {
            $this->context->buildViolation($constraint->validCompanySymbol)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

    #[Cache(public: true, maxage: 1)]
    private function isValidSymbol($value): bool {
        $items = $this->client->fetch([]);

        foreach($items as $item) {
            if($item['Symbol'] === $value) {
                return true;
            } 
        }
        
        return false;
    }
}
