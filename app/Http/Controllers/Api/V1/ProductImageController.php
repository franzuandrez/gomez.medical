<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    //

    public function destroy($id)
    {
        //TODO refactor into a service
        $image = ProductPhoto::findOrFail($id);
        $image->delete();

        $deleted = \Storage::disk('s3')->delete('products/' . $image->file_name);
        if ($deleted === TRUE) {
            return response($id, 202);
        }
        return response(["message" => "File not found"], 500);
    }
}
