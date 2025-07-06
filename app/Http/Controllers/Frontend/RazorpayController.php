<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use App\Models\Order;

use Illuminate\Support\Facades\Log;


class RazorpayController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function paymentSuccess(Request $request)
    {
        // Log the incoming request
        // \Log::info('🎯 Razorpay Callback Payload:', $request->all()); 

        $order = Order::where('order_number', $request->order_id)->first();

        // \Log::info('🎯 Find order in the database:', $order->toArray());

        $order->payment_status = 'paid';
        $order->order_status = 'confirmed';
        // $order->payment_id = $request->razorpay_payment_id;
        $order->save();

        return response()->json(['status' => 'success']);
    }
    public function retry(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->first();

        \Log::info('🎯 Find new order in the database:', $order->toArray());

        $req_area = $request->area;
        $area_check = $request->filled('area');

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $rzpOrder = $api->order->create([
            'receipt' => 'RETRY_' . $order->order_id,
            'amount' => $order->total_amount * 100,
            'currency' => 'INR'
        ]);
        
        \Log::info('🎯 Find razor order:', $rzpOrder->toArray());

        return response()->json([
            'status' => 'success',
            'message' => 'Your order has been placed!',
            'req_area' => $req_area,
            'area_check' => $area_check,
            'order_number' => $order->order_number,
            'razorpay_order_id' => $rzpOrder['id'],
            'amount' => $order->total_amount * 100, // Again, paise
        ]);
    }
}
