<?php


namespace App\Services\v1\DTOs\Product;


use App\Services\v1\DTOs\BaseAbstractDto;

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
    private $weight = 0;





    protected function configureValidatorRules(): array
    {
        return [
            'sku' => 'required',
            'name' => 'required',
            'description' => 'required',
            'color' => 'required',
            'size' => 'required',
            'product_subcategory_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->color = $data['color'];
        $this->size = $data['size'];
        $this->product_subcategory_id = $data['product_subcategory_id'];

        return true;
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
     * @return int
     */
    public function getWeight(): int
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


}
