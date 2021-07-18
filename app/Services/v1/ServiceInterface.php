<?php


namespace App\Services\v1;


use App\DTOs\v1\BaseAbstractDto;

Interface ServiceInterface
{
    public static function make(BaseAbstractDto $dto): ServiceInterface;

    public function execute();
}
