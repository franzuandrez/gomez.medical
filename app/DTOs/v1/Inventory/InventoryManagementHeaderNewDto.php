<?php

namespace App\DTOs\v1\Inventory;

use App\DTOs\v1\BaseAbstractDto;

class InventoryManagementHeaderNewDto extends BaseAbstractDto
{


    private $start_date;
    private $type;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    protected function configureValidatorRules(): array
    {

        return [
            'start_date' => 'required',
            'type' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->type = $data['type'];
        $this->start_date = $data['start_date'];

        return true;
    }
}
