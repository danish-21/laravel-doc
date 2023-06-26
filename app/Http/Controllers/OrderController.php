<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Paytm;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function create(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'cart_id' => 'required|exists:carts,id',
                'payment_option' => 'required|in:CASH_ON_DELIVERY,CARD,UPI',
            ]);

            // Generate payment amount based on your business logic
            $paymentAmount = $this->generatePaymentAmount($request->cart_id);

            // Create the order
            $order = Order::create([
                'user_id' => $request->user_id,
                'cart_id' => $request->cart_id,
                'total_amount' => $paymentAmount,
                'payment_option' => $request->payment_option,
                'shipping_address_id' => 1,
                'billing_address_id' => 1
            ]);

            // Create order details (if applicable)
            $this->createOrderDetails($order->id, $request->cart_id);

            // Process payment and create payment record
            $payment = Paytm::create([
                'name' => $request->user()->name,
                'mobile' => $request->user()->phone,
                'email' => $request->user()->email,
                'status' => 0,
                'amount' => $paymentAmount,
                'order_id' => $order->id,
            ]);
            if ($request->payment_option === 'UPI') {
                // Process UPI payment
                // Implement your UPI payment logic here

                // Update the payment status to indicate success
                $payment = Paytm::find($order->id);
                $payment->status = 1;
                $payment->save();
            } elseif ($request->payment_option === 'CARD') {
                // Process card payment
                // Implement your card payment logic here

                // Update the payment status to indicate success
                $payment = Paytm::find($order->id);
                $payment->status = 1;
                $payment->save();
            }

            // Additional payment processing logic can be added here

            // Delete the cart and its details
            $cart = Cart::find($request->cart_id);
            $cart->cart_details()->delete();
            $cart->delete();

            return ResponseHelper::createOrUpdateResponse($order);
        } catch (AppException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function generatePaymentAmount($cartId)
    {
        // Retrieve the cart items from the cartId and calculate the total amount
        $cart = Cart::find($cartId);

        if (!$cart) {
            // Handle the case when the cart is not found
            throw new AppException('Cart not found.');
        }

        $totalAmount = 0;

        foreach ($cart->cart_details as $item) {
//            dd($item);
            // Calculate the amount for each item (e.g., based on price and quantity)
            $itemAmount =  $item->product->price * $item->quantity;


            $totalAmount += $itemAmount;
        }

        return $totalAmount;
    }
    protected function createOrderDetails($orderId, $cartId)
    {
        // Retrieve the cart items from the cartId
        $cart = Cart::find($cartId);

        if (!$cart) {
            // Handle the case when the cart is not found
            throw new AppException('Cart not found.');
        }

        foreach ($cart->cart_details as $item) {
            // Create order details for each cart item
            OrderDetail::create([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }
    }

}
