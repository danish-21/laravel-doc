<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    public function bulkCreate(ProductCreateRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Create an array to store the created products
        $createdProducts = [];

        foreach ($validatedData['products'] as $productData) {
            // Create a new product instance
            $product = new Product();
            $product->name = $productData['name'];
            $product->description = $productData['description'];
            $product->category_id = $productData['category_id'];
            $product->price = $productData['price'];
            // Save the product to the database
            $product->save();
            // Create the product images
            $productImage = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->file_id = $productData['file_id'];
            $productImage->save();


            // Add the created product to the array
            $createdProducts[] = $product;
        }
        // Return a response with the created products
        return $this->standardResponse('Products created successfully', $createdProducts, null, 200);

    }

    public function index(Request $request)
    {

        $query = $request->input('search');

            $products = Product::with(['category', 'product_images.file']);

        if (!empty($query)) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    // orWhereHas method, we can perform a nested query on the related category relationship to search for products based on the category name.
                    ->orWhereHas('category', function ($cq) use ($query) {
                        $cq->where('name', 'like', '%' . $query . '%');
                    });
            });
        }

        $products = $products->paginate();

        return ResponseHelper::paginationResponse($products);
    }

    public function show($id)
    {
        $product = Product::with(['product_images.file','category'])->find($id);

        if (!$product) {
            return $this->standardResponse('Product not found', null, null, 404);
        }

        return $this->standardResponse('Product retrieved successfully', $product, null, 200);
    }


}
