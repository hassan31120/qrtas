<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetailsResource;
use App\Http\Resources\OrdersResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Octw\Aramex\Aramex;

class OrdersController extends Controller
{
    public function confirm_order(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'pay_status' => 'required',
        ]);
        $data = $request->all();
        $addresses = Auth::user()->addresses;
        for ($i = 0; $i < count($addresses); $i++) {
            $ad[] = $addresses[$i]->id;
        }
        if (in_array($data['address_id'], $ad)) {
            if (Auth::user()->cart->total > 0 && Auth::user()->cart->subTotal > 0) {

                $data['user_id'] = Auth::user()->id;
                $data['cart_id'] = Auth::user()->cart->id;
                Order::create($data);

                foreach (Auth::user()->cart->cartItems as $item) {
                    $detail['title'] = $item->title;
                    $detail['image'] = $item->image;
                    $detail['old_price'] = $item->old_price;
                    $detail['new_price'] = $item->new_price;
                    $detail['quantity'] = $item->quantity;
                    $detail['order_id'] = Auth::user()->orders[count(Auth::user()->orders) - 1]->id;
                    OrderDetail::create($detail);
                }

                $order = Order::where('id', Auth::user()->orders[count(Auth::user()->orders) - 1]->id)->first();
                $order->subTotal = Auth::user()->cart->subTotal;
                $order->total = Auth::user()->cart->total;
                $exp = $order->address->cities->price;
                if ($exp > 0) {
                    $order->grandTotal = $exp + $order->total;
                } else {
                    $order->grandTotal = null;
                }
                $order->save();
                $cart = Cart::where('user_id', Auth::user()->id)->first();
                CartItem::where('cart_id', $cart->id)->delete();
                $cart['subTotal'] = null;
                $cart['total'] = null;
                $cart['grandTotal'] = null;
                $cart->save();

                Notification::send($order->users, new OrderNotification($order));

                // $specificEmailAddress = 'info@lacabina-sa.com';
                // Notification::route('mail', $specificEmailAddress)
                //     ->notify(new OrderNotification($order));

                // $quantity = 0;
                // foreach ($order->orderDetails as $detail) {
                //     $quantity += $detail->quantity;
                // }

                // $callResponse = Aramex::createShipment([
                //     'shipper' => [
                //         'name' => 'Lacabine - السعودية Riyadh شارع رقم 151 حي ظهرة لبن 13761 الرياض',
                //         'email' => 'info@lacabina-sa.com',
                //         'phone' => '966530704610',
                //         'cell_phone' => '966530704610',
                //         'number' => '966530704610',
                //         'country_code' => 'SA',
                //         'city' => 'Riyadh',
                //         'zip_code' => '',
                //         'line1' => 'Jobran Alrobayya, Lacabina',
                //         'line2' => 'ضاحية لبن شارع الطائف',
                //         'line3' => '966530704610',
                //     ],

                //     'consignee' => [
                //         'name' => Auth::user()->name,
                //         'email' => Auth::user()->email,
                //         'phone' => Auth::user()->number,
                //         'cell_phone' => Auth::user()->number,
                //         'country_code' => 'SA',
                //         'city' => $order->address->cities->name_en,
                //         'zip_code' => '',
                //         'line1' => '_____' . $order->address->governorate,
                //         'line2' => '     ' . $order->address->title,
                //         'line3' => '     ' . $order->address->description,
                //     ],

                //     'shipping_date_time' => time(),
                //     'due_date' => time(),
                //     'comments' => 'No Comment',
                //     'pickup_location' => 'at reception',
                //     'pickup_guid' => '',
                //     'weight' => 1,
                //     'number_of_pieces' => $quantity,
                //     'description' => $order->pay_status,
                //     'product_group' => 'DOM',
                //     'product_type' => 'CDS',
                //     'payment_type' => 'P',
                //     'payment_option' => null,
                // ]);
                // if (!empty($callResponse->error)) {
                //     foreach ($callResponse->errors as $errorObject) {
                //         // handleError($errorObject->Code, $errorObject->Message);
                //         print_r($errorObject->Message);
                //         echo '<pre>';
                //     }
                // } else {
                //     // extract your data here, for example
                //     $shipmentId = $callResponse->Shipments->ProcessedShipment->ID;
                //     $labelUrl = $callResponse->Shipments->ProcessedShipment->ShipmentLabel->LabelURL;
                //     $order->shipment_link = $labelUrl;
                //     $order->shipment_id = $shipmentId;
                //     $order->save();
                //     return response()->json([
                //         'success' => true,
                //         'message' => 'your order is placed successfully',
                //         'shippment' => $labelUrl,
                //         'track' => $shipmentId,
                //         'order' => new OrdersResource($order),
                //     ], 200);
                // }

                return response()->json([
                    'success' => true,
                    'message' => 'your order is placed successfully',
                    'order' => new OrdersResource($order),
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'this address doesn\'t belong to you',
            ], 200);
        }
    }

    public function order_details($id)
    {
        $order = Order::find($id);
        $exp = (float) $order->address->cities->price;
        $details = OrderDetail::where('order_id', $id)->get();
        return response()->json([
            'success' => true,
            'total' => $order->total,
            'shipping_expenses' => $exp,
            'grand_total' => $order->grandTotal,
            'order' => DetailsResource::collection($details),
        ], 200);
    }

    public function user_orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        if (count($orders) > 0) {
            return response()->json([
                'success' => true,
                'order' => OrdersResource::collection($orders),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'you don\'t have any orders',
            ], 200);
        }
    }
}
