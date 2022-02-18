<?php

namespace App\Http\Resources\v2;


use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'purchase_order_id' => $this->purchase_order_id,
            'status' => $this->getStatusName($this->status) ,
            'order_date' => $this->order_date,
            'needs_admin_verification' => $this->needs_admin_verification,
            'is_paid' => $this->is_paid,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->tax_amount,
            'freight' => $this->freight,
            'total_due' => $this->total_due,
            'employee' => $this->employee,
            'vendor' => $this->vendor,
            'ship_method' => $this->shipMethod,
            'detail' =>PurchaseDetailResource::collection($this->purchaseOrderDetail),
        ];
    }

    private function getStatusName($status): string
    {


        switch ($status) {
            case 1:
                $name = "pendiente";
                break;
            case 2:
                $name = "recepcionada";
                break;
            case 3:
                $name = "rechazada";
                break;
            case 4:
                $name = "completada";
                break;
            default:
                $name = "";

        }

        return $name;

    }
}
