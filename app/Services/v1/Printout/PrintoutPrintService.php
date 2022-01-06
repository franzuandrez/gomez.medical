<?php

namespace App\Services\v1\Printout;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Printout\PrintoutPrintDto;
use App\Models\Printout;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class PrintoutPrintService implements ServiceInterface
{


    private $dto;


    public function __construct(PrintoutPrintDto $dto)
    {

        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof PrintoutPrintDto) {
            throw new InvalidArgumentException(
                'PrintoutPrintService needs to receive a PrintoutPrintDto.'
            );
        }
        return new PrintoutPrintService($dto);
    }

    public function execute()
    {

        $printouts = collect([]);
        foreach ($this->dto->getPrintouts() as $print) {
            $printout = Printout::find($print['Id']);
            $quantity_printed = $printout->quantity_printed;
            $new_quantity_printed = $quantity_printed + $print['Quantity_Printed'];
            if ($printout->quantity < $new_quantity_printed) {
                // TODO Refactor
                $diff = $new_quantity_printed - $printout->quantity;
                $new_printout = new Printout();
                $new_printout->quantity = $diff;
                $new_printout->quantity_printed = $diff;
                $new_printout->product_id = $printout->product_id;
                $new_printout->doc_id = $printout->doc_id;
                $new_printout->comments = "REPRINT";
                $new_printout->printed_by = $print['Printed_By'];
                $new_printout->is_printed = 1;
                $new_printout->save();
                $printouts->push($new_printout);
                //complete printed
                $printout->quantity_printed = $printout->quantity;
                $printout->is_printed = 1;

            } else {
                $printout->quantity_printed = $new_quantity_printed;
            }
            if ($printout->quantity == $new_quantity_printed) {
                $printout->is_printed = 1;
            }
            $printout->save();
            $printouts->push($printout);
        }

        return $printouts->toArray();

    }
}
