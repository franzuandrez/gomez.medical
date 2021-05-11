<?php

namespace Database\Seeders;

use App\Models\Bin;
use App\Models\BusinessEntity;
use App\Models\BusinessEntityAddress;
use App\Models\ContactType;
use App\Models\Corridor;
use App\Models\CreditCard;
use App\Models\Customer;
use App\Models\Department;
use App\Models\EmailAddress;
use App\Models\Employee;
use App\Models\InventoryMovement;
use App\Models\InventoryMovementType;
use App\Models\Person;
use App\Models\PersonCreditCard;
use App\Models\PersonPhone;
use App\Models\PhoneNumberType;
use App\Models\Position;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCostHistory;
use App\Models\ProductListPriceHistory;
use App\Models\ProductPhoto;
use App\Models\ProductSubcategory;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseOrderHeader;
use App\Models\Rack;
use App\Models\RackLevel;
use App\Models\SalesOrderDetail;
use App\Models\SalesOrderHeader;
use App\Models\SalesPerson;
use App\Models\SalesReason;
use App\Models\SalesReasonHeaderSalesReason;
use App\Models\SectionLocation;


use App\Models\ShipMethod;
use App\Models\SpecialOffer;
use App\Models\UnitMeasure;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $addresses = \App\Models\Address::factory(50)->create();
        $addresses_type = \App\Models\AddressType::factory(5)->create();
        $products = Product::factory()
            ->has(
                ProductCostHistory::factory()
                    ->count(1),
                'costHistory'
            )
            ->has(
                ProductListPriceHistory::factory()
                    ->count(1),
                'listPriceHistory'
            )
            ->has(
                ProductPhoto::factory()
                    ->count(1),
                'photos'
            )
            ->count(5);

        $movementsTypes = InventoryMovementType::factory()
            ->count(3)
            ->create();

        \App\Models\Warehouse::factory(1)
            ->has(
                SectionLocation::factory()
                    ->has(
                        Corridor::factory()
                            ->has(
                                Rack::factory()
                                    ->has(
                                        RackLevel::factory()
                                            ->has(
                                                Position::factory()
                                                    ->has(
                                                        Bin::factory()
                                                            ->has(
                                                                InventoryMovement::factory()
                                                                    ->state(
                                                                        function (array $attributes, Bin $bin) use ($products) {
                                                                            return [
                                                                                'position_id' => $bin->position_id,
                                                                                'level_id' => $bin->position->level_id,
                                                                                'rack_id' => $bin->position->level->rack_id,
                                                                                'corridor_id' => $bin->position->level->rack->corridor_id,
                                                                                'section_id' => $bin->position->level->rack->corridor->section_id,
                                                                                'warehouse_id' => $bin->position->level->rack->corridor->section->warehouse_id
                                                                            ];
                                                                        }
                                                                    )
                                                                    ->for($products->createOne(), 'product')
                                                                    ->for($movementsTypes->first(), 'movementType')
                                                                    ->count(1), 'inventoryMovements'
                                                            )
                                                            ->count(1), 'bins'

                                                    )
                                                    ->count(3)
                                                , 'positions'
                                            )
                                            ->count(5), 'levels'
                                    )
                                    ->count(8), 'racks'
                            )
                            ->count(1), 'corridors'
                    )
                    ->count(2), 'sections'
            )
            ->create();


        $customers = Customer::factory()
            ->count(1);
        $sales_people = SalesPerson::factory()
            ->count(1);

        $business_entities = BusinessEntity::factory(10)
            ->has(
                BusinessEntityAddress::factory()
                    ->for(
                        $addresses_type->random(1)->first(), 'addressType'
                    )
                    ->for(
                        $addresses->random(1)->first(), 'address'
                    )
                    ->count(2), 'businessEntityAddress')
            ->has(
                EmailAddress::factory()->count(1), 'emailAddress'
            )
            ->has(
                Person::factory()->count(1), 'person'
            )
            ->has(
                $sales_people, 'salesPerson'
            )
            ->has(
                $customers, 'customer'
            )
            ->create();


        ContactType::factory(5)->create();
        $credit_card = CreditCard::factory(15)->create();


        Department::factory(8)->create();
        $employees = Employee::factory(50)->create();

        PersonCreditCard::factory(1)
            ->for($business_entities->first(), 'businessEntity')
            ->for($credit_card->first(), 'creditCard')
            ->create();

        PhoneNumberType::factory(2)
            ->has(
                PersonPhone::factory()
                    ->for($business_entities->first(), 'businessEntity')
                    ->count(5),
                'phoneNumbers'
            )
            ->create();


        ProductCategory::factory(5)
            ->has(
                ProductSubcategory::factory()
                    ->has(
                        $products, 'products'
                    )
                    ->count(5),
                'subcategories'
            )
            ->create();


        $vendors = Vendor::factory()
            ->count(3)
            ->for($business_entities->last())
            ->create();

        UnitMeasure::factory()
            ->count(3)
            ->create();


        $offers = SpecialOffer::factory()
            ->count(3)
            ->create();

        $shipMethods = ShipMethod::factory()
            ->count(3)
            ->create();

        $sales_reasons = SalesReason::factory()
            ->count(5)
            ->create();

        SalesOrderHeader::factory()
            ->count(3)
            ->for($customers->create()->first())
            ->for($sales_people->create()->first())
            ->for($addresses->first(), 'billAddress')
            ->for($addresses->first(), 'shipAddress')
            ->for($shipMethods->first(), 'shipMethod')
            ->has(
                SalesOrderDetail::factory()
                    ->for(
                        $products->createOne(), 'product'
                    )
                    ->for(
                        $offers->random()->first(), ''
                    )
                    ->count(5), 'salesOrderDetail'
            )
            ->has(
                SalesReasonHeaderSalesReason::factory()
                    ->for($sales_reasons->first(), 'salesReason')
                    ->count(1), 'salesReasons'
            )
            ->create();

        PurchaseOrderHeader::factory()
            ->count(10)
            ->for($employees->first(), 'employee')
            ->for($vendors->first(), 'vendor')
            ->for($shipMethods->first(), 'shipMethod')
            ->has(PurchaseOrderDetail::factory()
                ->for($products->createOne())
                ->count(3), 'purchaseOrderDetail')
            ->create();

    }
}
