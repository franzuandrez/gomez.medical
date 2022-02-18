<?php

namespace App\Http\Controllers\v1;

use App\DTOs\v1\Inventory\InventoryMovementDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\InventoryResource;
use App\Models\InventoryMovement;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseOrderHeader;
use App\Services\v1\Inventory\InventoryMovementService;
use Illuminate\Http\Request;

class PurchaseLocateProductsController extends Controller
{
    //


    public function update(Request $request, $id)
    {


        $purchaseDetail = PurchaseOrderDetail::findOrFail($id);
        $quantity = $purchaseDetail->stocked_quantity + $request->quantity;

        if ($quantity <= $purchaseDetail->received_quantity) {
            $purchaseDetail->stocked_quantity = $quantity;
            $purchaseDetail->save();
            $values = $request->all();
            $values['type_movement'] = 'purchase';
            $inventoryAddDto = new InventoryMovementDto(
                $values
            );
            $inventoryAddService = InventoryMovementService::make($inventoryAddDto);
            $inventory = $inventoryAddService->execute();

            $isPending = PurchaseOrderDetail::where('purchase_order_id', $purchaseDetail->purchase_order_id)
                ->whereColumn('received_quantity', '<>', 'stocked_quantity')
                ->exists();

            if (!$isPending) {
                $header = PurchaseOrderHeader::find($purchaseDetail->purchase_order_id);
                $header->markAsCompleted();
            }
            return new InventoryResource(InventoryMovement::find($inventory['id']));
        }

        return response()
            ->json([
                "message" => "Quantity Exceeds"
            ], 500);


    }
}
