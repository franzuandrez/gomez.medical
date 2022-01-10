<?php

namespace App\Http\Controllers\api\v1;

use App\DTOs\v1\Printout\PrintoutPrintDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrintoutCollectionResource;
use App\Http\Resources\v1\PrintoutResource;
use App\Models\Printout;
use App\Models\Product;
use App\Services\v1\Printout\PrintoutPrintService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

class PrintoutController extends Controller
{
    //

    private function clear($name)
    {

        $name = str_replace(['-', '+'], '', $name);
        $name = str_replace('Á', 'A', $name);
        $name = str_replace('á', 'a', $name);
        $name = str_replace('Ñ', 'N', $name);
        $name = str_replace('ñ', 'n', $name);
        $name = str_replace('É', 'E', $name);
        $name = str_replace('é', 'e', $name);
        $name = str_replace('Í', 'I', $name);
        $name = str_replace('í', 'i', $name);
        $name = str_replace('Ó', 'O', $name);
        $name = str_replace('ó', 'o', $name);
        $name = str_replace('Ú', 'U', $name);
        return str_replace('ú', 'u', $name);
    }

    private function sku_from_long_name($name, $attribute)
    {
        $name = $this->clear($name);
        $attribute = $this->clear($attribute);
        $parts = explode(' ', $name);

        $sku = '';

        if (strlen($attribute) >= 5 && count($parts) > 1) {

            $sku = substr($parts[0], 0, 4) . '-' . substr($parts[1], 0, 3) . '-' . substr($attribute, 0, 3);

        }

        if (strlen($sku) < 12) {
            $sku = $this->sku_from_name($name . ' ' . $attribute);
        }

        return $sku;
    }

    private function sku_from_name_and_attr($name, $attribute)
    {
        $sku = '';
        $name = $this->clear($name);
        $attribute = $this->clear($attribute);
        if (strlen($name) >= 6) {
            $sku = substr($name, 0, 6) . '-' . substr($attribute, 0, 5);
        }
        if (strlen($attribute) >= 6 && $sku == '') {
            $sku = substr($name, 0, 5) . '-' . substr($attribute, 0, 6);
        }


        return $sku;
    }

    private function sku_from_name($name)
    {
        $name = $this->clear($name);
        $sku = '';
        $MAX_LENGTH = 12;
        $parts = explode(' ', $name);
        $selected_names = collect([]);
        foreach ($parts as $part) {
            if (strlen($part) >= 3) {
                $selected_names->add($part);
            }
        }
        $selected_lengths = $selected_names->map(function ($item) {
            return strlen($item);
        });
        $sum = $selected_lengths->sum();
        $max = $MAX_LENGTH - count($selected_lengths) + 1;
        $result = $selected_lengths->map(function ($item) use ($sum, $max) {
            return intval(round($item / $sum * $max));
        });
        for ($i = 0; $i < count($result); $i++) {
            $last_part = '';
            if ($i != count($result) - 1) {
                $last_part = '-';
            }
            $sku = $sku . substr($selected_names[$i], 0, $result[$i]) . $last_part;
        }

        if (strlen($sku) < $MAX_LENGTH) {

            if (strlen($sku) == 11) {
                $sku = $sku . 'A';
            } else {
                $temp = $MAX_LENGTH - 1 - strlen($sku);
                $sku = $sku . '-' . str_pad('1', $temp, '0', STR_PAD_LEFT);
            }


        }
        return $sku;

    }


    private function regenerate_skus()
    {
        $codes = Product::all();
        $bad_codes = collect([]);


        foreach ($codes as $code) {

            if (strlen($code->sku) != 12 || $code->color == 'NA' || $code->size == 'NA') {
                $bad_codes->add($code);
            }

        }
        foreach ($bad_codes as $code) {
            $sku = '';
            if ($code->color == 'NA' && $code->size != 'NA') {
                $sku = $this->sku_from_long_name($code->name, $code->size);
                if (strlen($sku) < 12) {
                    $sku = $this->sku_from_name_and_attr($code->name, $code->size);
                }
            }
            if ($code->color != 'NA' && $code->size == 'NA') {
                $sku = $this->sku_from_long_name($code->name, $code->color);
                if (strlen($sku) < 12) {
                    $sku = $this->sku_from_name_and_attr($code->name, $code->color);
                }
            }
            if ($code->color == 'NA' && $code->size == 'NA') {
                $sku = $this->sku_from_name($code->name);
            }

            $sku = strtoupper($sku);

            Product::where('product_id', $code->product_id)->update([
                'sku' => $sku
            ]);

        }


    }


    public function store(Request $request)
    {


        $printoutDto = new PrintoutPrintDto([
            'printouts' => $request->get('Printouts'),
        ]);

        $printoutService = PrintoutPrintService::make($printoutDto);
        $printoutService->execute();


        return response()->json([
            'success' => true,
            'message' => 'Printed correctly'
        ]);

    }

    public function show($id): AnonymousResourceCollection
    {


        $prints = Printout::select(
            'printouts.id',
            'printouts.product_id',
            'product.name',
            'product.description',
            'product.code',
            'product.sku',
            'printouts.quantity',
            'printouts.quantity_printed',
            'printouts.printed_by',
            'printouts.is_printed',
        )
            ->where('doc_id', $id)
            ->where('comments','<>','INVENTORY')
            ->join('product', 'product.product_id', '=', 'printouts.product_id')
            ->paginate(15);

        return PrintoutCollectionResource::collection($prints);

    }
}
