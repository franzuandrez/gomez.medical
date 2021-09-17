<?php

namespace App\Services\v1\Inventory;

use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Inventory\InventoryManagementHeaderNewDto;
use App\Models\Employee;
use App\Models\PhysicalInventoryHeader;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class InventoryManagementHeaderNewService implements ServiceInterface
{


    private $dto;

    public function __construct(InventoryManagementHeaderNewDto $dto)
    {
        $this->dto = $dto;

    }


    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof InventoryManagementHeaderNewDto) {
            throw new InvalidArgumentException(
                'InventoryMovementService needs to receive a InventoryMovementDto.'
            );
        }
        return new InventoryManagementHeaderNewService($dto);


    }

    public function execute()
    {

        $header = new PhysicalInventoryHeader();
        $header->start_date = Carbon::make($this->dto->getStartDate());
        $header->end_date = Carbon::now();
        $header->type = $this->dto->getType();
        $header->status = 1;
        $header->done_by = Employee::whereLoginId(\Auth::id())->first()->employee_id;
        $header->comments = 'none';
        $header->save();

        return $header->toArray();


    }
}
