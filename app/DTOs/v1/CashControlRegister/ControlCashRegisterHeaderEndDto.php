<?php

namespace App\DTOs\v1\CashControlRegister;

use App\DTOs\v1\BaseAbstractDto;

class ControlCashRegisterHeaderEndDto extends BaseAbstractDto
{

    private $ended_at;
    private $supervised_id;
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEndedAt()
    {
        return $this->ended_at;
    }

    /**
     * @return mixed
     */
    public function getSupervisedId()
    {
        return $this->supervised_id;
    }


    protected function configureValidatorRules(): array
    {
        return [
            'ended_at' => 'required',
            'supervised_id' => 'required',
            'id' => 'required'
        ];
    }

    protected function map(array $data): bool
    {

        $this->ended_at = $data['ended_at'];
        $this->supervised_id = $data['supervised_id'];
        $this->id = $data['id'];

        return true;
    }
}
