<?php


namespace App\Services\v1;


use App\Services\v1\DTOs\BaseAbstractDto;

Interface ServiceInterface
{
    public static function make(BaseAbstractDto $dto): ServiceInterface;

    public function execute();
}
