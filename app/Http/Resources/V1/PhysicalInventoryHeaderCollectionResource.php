<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalInventoryHeaderCollectionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status === 0 ? 'Iniciado' : 'Terminado',
            'type' => $this->getTypeName($this->type),
            'comments' => $this->comments,
            'job_title' => $this->job_title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        ];
    }


    private function getTypeName($type)
    {

        if ($type === 'category') {
            return 'Categoria';
        }
        if ($type === 'subcategory') {
            return 'Subcategoria';
        }
        if ($type === 'product') {
            return 'Producto';
        }
        if ($type === 'location') {
            return 'Ubicacion';
        }
    }
}
