<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController  extends BaseController
{

    public function addToCart(Request $request)
    {
        try {
            $userId = Auth::id(); // Retrieve the authenticated user's ID

            // Retrieve the cart for the user
            $cart = Cart::where('user_id', $userId)->first();

            // If the cart doesn't exist, create a new one
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => $userId
                ]);
            }

            // Retrieve the products array from the request
            $products = $request->input('products');

            foreach ($products as $product) {
                // Retrieve the product ID and quantity
                $productId = $product['product_id'];
                $quantity = $product['quantity'];

                // Check if the product already exists in the cart details
                $cartDetail = CartDetail::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

                // If the product already exists, update the quantity
                if ($cartDetail) {
                    $cartDetail->quantity += $quantity;
                    $cartDetail->save();
                } else {
                    // If the product doesn't exist, create a new cart detail entry
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $quantity
                    ]);
                }
            }

            return response()->json('Products added to cart successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json('An error occurred while adding products to the cart', 500);
        }
    }
    public function getAllCartData(Request $request)
    {
        try {
            $userId = Auth::id(); // Retrieve the authenticated user's ID

            $query = Cart::with(['cart_details' => function ($query) use ($request) {
                // Check if the "search" query parameter is provided
                if ($request->has('search')) {
                    $search = $request->input('search');

                    // Apply the search filter on the product name
                    $query->whereHas('product', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
                }
            }, 'cart_details.product.product_images.file'])
                ->where('user_id', $userId)
                ->paginate();

            return ResponseHelper::paginationResponse($query);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json('An error occurred while retrieving cart data', 400);
        }
    }
    public function updateCartDetail(Request $request, $id)
    {
        try {
            // Retrieve the authenticated user's ID
            $userId = Auth::id();

            // Find the cart detail by its ID and check if it belongs to the authenticated user
            $cartDetail = CartDetail::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->find($id);

            if (!$cartDetail) {
                return response()->json('Cart detail not found', 404);
            }

            // Update the quantity
            $quantity = $request->input('quantity');

            if ($quantity == 0) {
                // If the quantity is 0, delete the cart detail
                $cartDetail->delete();
            } else {
                // Otherwise, update the quantity
                $cartDetail->quantity = $quantity;
                $cartDetail->save();
            }

            return ResponseHelper::createOrUpdateResponse($cartDetail);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json('An error occurred while updating cart detail', 400);
        }
    }




}
