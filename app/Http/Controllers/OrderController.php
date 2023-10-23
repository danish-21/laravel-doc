<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Paytm;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{

    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'payment_option' => 'required|in:CASH_ON_DELIVERY,CARD,UPI',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            'billing_address_id' => 'required|exists:user_addresses,id',
        ]);
        $user = Auth::id();
        $order = Order::orderBy('id', 'desc')->first();
        $date = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');

        try {

            if (is_null($order)) {
                $order_num = 'MDR' . $date . $month . '0000000';
            } else {
                $order_num = 'MDR' . $date . $month . str_pad($order->id, 7, '0', STR_PAD_LEFT);
            }
            $cart=Cart::with(['cart_details'])->where('id',$request->cart_id)->first();
//dd($cart);
            if (is_null($cart)) {
                throw new AppException('cart item is not valid');
            }
            foreach ($cart->cart_details as $item) {
                $product = $item->product;
                if ($product->quantity < $item->quantity) {
                    throw new AppException('Product quantity not available');
                }
                // Update product quantity
                $product->quantity -= $item->quantity;
                $product->save();
            }

            // Retrieve user addresses
            $shippingAddress = UserAddress::find($request->shipping_address_id);
            $billingAddress = UserAddress::find($request->billing_address_id);

            if (is_null($shippingAddress)) {
                throw new AppException('Please provide a valid shipping address');
            }

            if (is_null($billingAddress)) {
                throw new AppException('Please provide a valid billing address');
            }

            // Generate payment amount based on your business logic
            $paymentAmount = $this->generatePaymentAmount($request->cart_id);

            // Determine the order status based on payment option
            $orderStatus = ($request->payment_option === AppConstants::PAYMENT_METHOD_COD) ? 0 : 1;

            // Create the order
            $order = Order::create([
                'user_id' => $user,
                'cart_id' => $cart->id,
                'total_amount' => $paymentAmount,
                'payment_option' => $request->payment_option,
                'status' => $orderStatus, // Set the order status
                'shipping_address_id' => $request->shipping_address_id,
                'billing_address_id' => $request->billing_address_id,
                'order_number' => $order_num
            ]);

            // Create order details (if applicable)
            $this->createOrderDetails($order->id, $request->cart_id);

            // Process payment and handle different payment options
            if ($request->payment_option === AppConstants::PAYMENT_METHOD_UPI) {
                // Process UPI Payment Method
                // Implement your UPI payment logic here
                $order->status = 1;
                $order->save();
            } elseif ($request->payment_option === AppConstants::PAYMENT_METHOD_CARD) {
                // Process card payment
                // Implement your card payment logic here

                // Update the order status to indicate payment success
                $order->status = 1;
                $order->save();
            } elseif ($request->payment_option === AppConstants::PAYMENT_METHOD_COD) {
                // For cash on delivery, no payment processing is needed, so no payment record is created.
                // Update the payment status in Paytm table
                Paytm::create([
                    'name' => $request->user()->name,
                    'mobile' => $request->user()->phone,
                    'email' => $request->user()->email,
                    'status' => 0,
                    'amount' => $paymentAmount,
                    'order_id' => $order->id,
                ]);
            }

            // Delete the cart and its details
            $cart = Cart::find($request->cart_id);
            $cart->cart_details()->delete();
            $cart->delete();

            return ResponseHelper::createOrUpdateResponse($order);
        } catch (AppException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
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
