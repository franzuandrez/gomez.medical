<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Purchasing\PurchaseHeaderFinishPriceEditionDto;
use App\Http\Controllers\Controller;
use App\Services\v1\Purchasing\PurchaseHeaderFinishPriceEditionService;
use Illuminate\Http\Request;

class PurchaseHeaderFinishPriceEditionController extends Controller
{
    //


    public function update($id)
    {
        $values['header_id'] = $id;
        $dto = new PurchaseHeaderFinishPriceEditionDto($values);
        $service = PurchaseHeaderFinishPriceEditionService::make($dto);
        $service->execute();
        return response("", 201);
    }
}
