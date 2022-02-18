<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Purchasing\PurchasingEditProductPriceDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PurchaseEditProductResource;
use App\Models\PurchaseOrderDetail;
use App\Services\v1\Purchasing\PurchasingEditProductPriceService;
use Illuminate\Http\Request;

class PurchaseEditProductController extends Controller
{


    public function update($id, Request $request)
    {
        $values = $request->all();
        $values['detail_id'] = $id;
        $dto = new PurchasingEditProductPriceDto($values);
        $service = PurchasingEditProductPriceService::make($dto);
        $detail = $service->execute();
        return new PurchaseEditProductResource(PurchaseOrderDetail::find($detail['id']));

    }


}
