<?php


namespace App\Services\v1\DTOs;


use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;
abstract class BaseAbstractDto
{
    public function __construct(array $data)
    {

        $validator = Validator::make(
            $data,
            $this->configureValidatorRules()
        );

        if (!$validator->validate()) {

            throw new InvalidArgumentException(
                'Error: ' . $validator->errors()->first()
            );
        }

        if (!$this->map($data)) {
            throw new InvalidArgumentException('The mapping failed.');
        }
    }

    abstract protected function configureValidatorRules(): array;

    abstract protected function map(array $data): bool;


}
