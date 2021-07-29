<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionBinsResource extends JsonResource
{

    public function toArray( $request)
    {
        return [
            'bin_id' => $this->bin_id,
            'name' => $this->name
        ];
    }
}
