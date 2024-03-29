<?php


namespace App\Services\v1\Product;


use App\Models\ProductPhoto;
use App\DTOs\v1\BaseAbstractDto;
use App\DTOs\v1\Product\ProductAddImagesDto;
use App\Services\v1\ServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use InvalidArgumentException;


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


        $images_saved = collect([]);
        $this->delete_previous_images();
        foreach ($this->dto->getImages() as $imageKey => $image) {

            $image_extension = $image->clientExtension();
            $name_without_spaces = preg_replace('/\s+/', '-', $this->dto->getProductName());
            $name = $name_without_spaces . '-' . Carbon::now()->unix() . '-' . $imageKey . '.' . $image_extension;
            $img = Image::make($image->getRealPath());
            $img->stream(); // <-- Key point
            Storage::disk('s3')->put('products/' . $name, $img, 'public');
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

    private function delete_previous_images()
    {
        $images = ProductPhoto::where('product_id', $this->dto->getProductId())
            ->get();

        ProductPhoto::destroy($images->map(function ($item) {
            return $item->product_photo_id;
        }));

        $images->map(function ($item) {
            \Storage::disk('s3')->delete('products/' . $item->file_name);
        });

    }
}
