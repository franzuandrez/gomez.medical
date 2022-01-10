<?php


namespace App\Services\v1\Inventory;


use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Inventory\InventoryMovementDto;
use App\DTOs\v1\Printout\PrintoutCreateDto;
use App\Models\Bin;
use App\Models\InventoryMovement;
use App\Models\InventoryMovementType;
use App\Services\v1\Printout\PrintoutCreateService;
use App\Services\v1\ServiceInterface;
use InvalidArgumentException;

class InventoryMovementService implements ServiceInterface
{


    private $dto;

    public function __construct(InventoryMovementDto $dto)
    {
        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {

        if (!$dto instanceof InventoryMovementDto) {
            throw new InvalidArgumentException(
                'InventoryMovementService needs to receive a InventoryMovementDto.'
            );
        }
        return new InventoryMovementService($dto);

    }

    public function execute()
    {

        if (is_numeric($this->dto->getTypeMovement())) {
            $type_movement = InventoryMovementType::where('movement_type_id', '=', $this->dto->getTypeMovement())
                ->firstOrFail();
        } else {
            $type_movement = InventoryMovementType::where('internal_code', '=', $this->dto->getTypeMovement())
                ->firstOrFail();
        }


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
        $inventory->movement_type_id = $type_movement->movement_type_id;
        $inventory->save();

        $dtoPrintout = new PrintoutCreateDto([
            'quantity' => $inventory->quantity,
            'product_id' => $inventory->product_id,
            'comments' => 'INVENTORY',
            'doc_id' => $inventory->id
        ]);
        $servicePrintout = PrintoutCreateService::make($dtoPrintout);
        $servicePrintout->execute();

        return $inventory->toArray();

    }
}
