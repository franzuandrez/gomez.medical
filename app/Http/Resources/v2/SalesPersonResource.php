<?php

namespace App\Http\Resources\v2;

use App\Models\BusinessEntity;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesPersonResource extends JsonResource
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
            'sales_quota' => $this->sales_quota,
            'bonus' => $this->bonus,
            'commission_pct' => $this->commission_pct,
            'business_entity' => new BusinessEntityResource($this->businessEntity),
            'person' => $this->businessEntity->person
        ];
    }
}
