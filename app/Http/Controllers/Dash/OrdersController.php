<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function pending()
    {
        Carbon::setLocale('ar');
        $orders = Order::where('status', 'pending')->latest('id')->paginate(10);
        if (count($orders) > 0) {
            return OrdersResource::collection($orders);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such orders'
            ], 200);
        }
    }

    public function accepted()
    {
        Carbon::setLocale('ar');
        $orders = Order::where('status', 'accepted')->latest('id')->paginate(10);
        if (count($orders) > 0) {
            return OrdersResource::collection($orders);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such orders'
            ], 200);
        }
    }

    public function declined()
    {
        Carbon::setLocale('ar');
        $orders = Order::where('status', 'declined')->latest('id')->paginate(10);
        if (count($orders) > 0) {
            return OrdersResource::collection($orders);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such orders'
            ], 200);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => $request->status]);
            return response()->json([
                'success' => true,
                'message' => 'status has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such order'
            ], 404);
        }
    }

    public function order($id)
    {
        Carbon::setLocale('ar');
        $order = Order::find($id);
        if ($order) {
            return response()->json([
                'success' => true,
                'order' => new OrdersResource($order)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such order'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json([
                'success' => true,
                'message' => 'order has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such order'
            ], 404);
        }
    }
}
