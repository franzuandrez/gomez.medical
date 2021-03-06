<?php


namespace App\Services\v1\Product;


use App\Models\ProductPhoto;
use App\Services\v1\DTOs\BaseAbstractDto;
use App\Services\v1\DTOs\Product\ProductAddImagesDto;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductAddImagesService implements ServiceInterface
{


    private $dto;

    public function __construct(ProductAddImagesDto $dto)
    {


        $this->dto = $dto;
    }

    public static function make(BaseAbstractDto $dto): ServiceInterface
    {
        if (!$dto instanceof ProductAddImagesDto) {
            throw new InvalidArgumentException(
                'ProductAddImagesService needs to receive a ProductAddImagesDto.'
            );
        }
        return new ProductAddImagesService($dto);
    }

    public function execute(): array
    {
        // TODO: Implement execute() method.

        $images_saved = collect([]);

        foreach ($this->dto->getImages() as $imageKey => $image) {
            $content = file_get_contents($image);

            $image_extension = $image->clientExtension();
            $name_without_spaces = preg_replace('/\s+/', '-', $this->dto->getProductName());
            $name = $name_without_spaces . '-' . Carbon::now()->unix() . '.' . $image_extension;
            Storage::disk('s3')->put('products/' . $name, $content, 'public');
            $url = Storage::disk('s3')->url('products/' . $name);
            $product_photo = new ProductPhoto();
            $product_photo->product_id = $this->dto->getProductId();
            $product_photo->file_name = $name;
            $product_photo->path = $url;
            $product_photo->save();
            $images_saved->push($product_photo);
        }

        return $images_saved->toArray();

    }
}
