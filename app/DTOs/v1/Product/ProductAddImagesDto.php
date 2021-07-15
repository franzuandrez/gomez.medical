<?php


namespace App\Services\v1\DTOs\Product;


use App\Services\v1\DTOs\BaseAbstractDto;

class ProductAddImagesDto extends BaseAbstractDto
{


    private $images;
    private $product_name;
    private $product_id;
    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }



    protected function configureValidatorRules(): array
    {

        return [
            'images' => 'required|array',
            'product_name' => 'required',
            'product_id' => 'required',
        ];
    }

    protected function map(array $data): bool
    {

        $this->images = $data['images'];
        $this->product_name = $data['product_name'];
        $this->product_id = $data['product_id'];
        return true;
    }
}
