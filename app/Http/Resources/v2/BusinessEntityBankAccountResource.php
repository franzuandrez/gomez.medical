<?php

namespace App\Http\Resources\v2;

use App\Models\Bank;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessEntityBankAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'business_entity_id'=>$this->business_entity_id,
            'account_number'=>$this->account_number,
            'bank' => new BankResource($this->bank)
        ];
    }
}
