<?php


namespace App\DTOs\v1\Inventory;


use App\DTOs\v1\BaseAbstractDto;

class InventoryMovementDto extends BaseAbstractDto
{


    private $product_id;
    private $batch;
    private $best_before;
    private $quantity;
    private $location_id;
    private $type_movement;

    /**
     * @return mixed
     */
    public function getTypeMovement()
    {
        return $this->type_movement;
    }

    /**
     * @return mixed
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @return mixed
     */
    public function getBatch()
    {
        return $this->batch;
    }

    /**
     * @return mixed
     */
    public function getBestBefore()
    {
        return $this->best_before;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'product_id' => 'required',
            'batch' => 'required',
            'best_before' => 'required',
            'quantity' => 'required',
            'type_movement' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->product_id = $data['product_id'];
        $this->batch = $data['batch'];
        $this->best_before = $data['best_before'];
        $this->quantity = $data['quantity'];
        $this->location_id = $data['location_id'];
        $this->type_movement = $data['type_movement'];

        return true;
    }
}
