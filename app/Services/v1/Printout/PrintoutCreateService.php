<?php

namespace App\Services\v1\Printout;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Printout\PrintoutCreateDto;
use App\Models\Printout;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;
class PrintoutCreateService implements ServiceInterface
{


    private $dto;


    public function __construct(PrintoutCreateDto $dto)
    {
        $this->dto = $dto;
    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PrintoutCreateDto) {
            throw new InvalidArgumentException(
                'PrintoutCreateService needs to receive a PrintoutCreateDto.'
            );
        }
        return new PrintoutCreateService($dto);
    }

    public function execute()
    {

        $printout = new Printout();
        $printout->quantity = $this->dto->getQuantity();
        $printout->product_id = $this->dto->getProductId();
        $printout->doc_id = $this->dto->getDocId();
        $printout->comments = $this->dto->getComments();
        $printout->save();

        return $printout->toArray();
    }
}
