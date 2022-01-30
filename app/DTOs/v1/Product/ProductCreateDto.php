<?php


namespace App\DTOs\v1\Product;


use App\DTOs\v1\BaseAbstractDto;

class ProductCreateDto extends BaseAbstractDto
{

    private $sku;
    private $name;
    private $description;
    private $color;
    private $size;
    private $product_subcategory_id;
    private $code;
    private $instructions;
    private $weight;
    private $brand_id;
    private $size_unit_measure_code;
    private $weight_unit_measure_code;
    private $cost;
    private $list_price;

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getListPrice()
    {
        return $this->list_price;
    }


    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * @return mixed
     */
    public function getSizeUnitMeasureCode()
    {
        return $this->size_unit_measure_code;
    }

    /**
     * @return mixed
     */
    public function getWeightUnitMeasureCode()
    {
        return $this->weight_unit_measure_code;
    }


    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getInstructions()
    {
        return $this->instructions;
    }


    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getProductSubcategoryId()
    {
        return $this->product_subcategory_id;
    }

    protected function configureValidatorRules(): array
    {
        return [
            'sku' => 'required',
            'name' => 'required',
            'description' => 'required',
            'color' => 'required',
            'size' => 'required',
            'product_subcategory_id' => 'required',
            'brand_id' => 'required',
            'cost' => 'required',
            'price' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->code = $data['code'];
        $this->list_price = $data['price'];
        $this->cost = $data['cost'];
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->color = $data['color'];
        $this->size = $data['size'];
        $this->product_subcategory_id = $data['product_subcategory_id'];
        $this->brand_id = $data['brand_id'];
        $this->weight = $data['weight'];
        $this->size_unit_measure_code = $data['size_unit_measure_code'];
        $this->weight_unit_measure_code = $data['weight_unit_measure_code'];

        return true;
    }


}
