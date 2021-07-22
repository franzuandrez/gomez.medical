<?php


namespace App\DTOs\v1\BusinessEntity;


use App\DTOs\v1\BaseAbstractDto;

class BusinessEntityCreateDto extends BaseAbstractDto
{


    protected function configureValidatorRules(): array
    {

        return [

        ];
    }

    protected function map(array $data): bool
    {


        return true;
    }
}
