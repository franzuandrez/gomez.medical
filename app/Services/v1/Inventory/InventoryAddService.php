<?php


namespace App\Services\v1\Inventory;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Inventory\InventoryAddDto;
use App\Models\Bin;
use App\Models\InventoryMovement;
use App\Models\InventoryMovementType;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class InventoryAddService implements ServiceInterface
{


    private $dto;

    public function __construct(InventoryAddDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof BaseAbstractDto) {
            throw new InvalidArgumentException(
                'InventoryAddService needs to receive a BaseAbstractDto.'
            );
        }
        return new InventoryAddService($dto);

    }

    public function execute()
    {

        $location = Bin::find($this->dto->getLocationId());
        $inventory = new InventoryMovement();
        $inventory->product_id = $this->dto->getProductId();
        $inventory->batch = $this->dto->getBatch();
        $inventory->best_before = $this->dto->getBestBefore();
        $inventory->quantity = $this->dto->getQuantity();
        $inventory->bin_id = $location->bin_id;
        $inventory->position_id = $location->position_id;
        $inventory->level_id = $location->position->level_id;
        $inventory->rack_id = $location->position->level->rack_id;
        $inventory->corridor_id = $location->position->level->rack->corridor_id;
        $inventory->section_id = $location->position->level->rack->corridor->section_id;
        $inventory->warehouse_id = $location->position->level->rack->corridor->section->warehouse_id;
        $inventory->movement_type_id = InventoryMovementType::where('factor', '>', 0)
            ->first()->movement_type_id;
        $inventory->save();


        return $inventory->toArray();

    }
}
