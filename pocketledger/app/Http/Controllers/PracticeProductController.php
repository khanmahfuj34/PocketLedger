<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PracticeProduct;
use App\Http\Resources\PracticeProductResource;
class PracticeProductController extends Controller
{
    //// All products with pagination
    public function index()
    {
        $products = PracticeProduct::paginate(10);

        return PracticeProductResource::collection($products);
    }
    // Single product by ID
    public function show(int $id)
    {
        $product = PracticeProduct::findOrFail($id);

        return new PracticeProductResource($product);
    }
}
