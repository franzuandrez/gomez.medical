<?php


namespace App\DTOs\v1\Purchasing;


use App\DTOs\v1\BaseAbstractDto;

class PurchasingHeaderCreateDto extends BaseAbstractDto
{


    private $vendor_id;
    private $employee_id;

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendor_id;
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    protected function configureValidatorRules(): array
    {


        return [
            'vendor_id' => 'required',
            'employee_id' => 'required',
        ];

    }

    protected function map(array $data): bool
    {


        $this->employee_id = $data['employee_id'];
        $this->vendor_id = $data['vendor_id'];


        return true;
    }
}
