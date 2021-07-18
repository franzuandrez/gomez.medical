<?php


namespace App\Services\v1;


use App\Models\Address;
use App\Models\AddressType;
use App\Models\BusinessEntity;
use App\Models\BusinessEntityAddress;
use App\Models\Vendor;
use DB;

class VendorService
{


    public function save(Vendor $vendor, Address $address, AddressType $addressType)
    {


        try {
            DB::beginTransaction();
            $business_entity = new BusinessEntity();
            $business_entity->vendor($vendor)->save();
            $business_entity->save();

            $business_entity_address = new BusinessEntityAddress();
            $business_entity_address->address($address)->save();
            $business_entity_address->addressType($addressType);
            $business_entity_address->businessEntity($business_entity);
            $business_entity->save();

            DB::commit();
            return $vendor;
        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }

    }

}
