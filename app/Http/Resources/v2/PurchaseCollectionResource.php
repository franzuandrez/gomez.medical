<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            array_merge(parent::toArray($request), [
                'status' => $this->getStatusName($this->status)
            ]);
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
