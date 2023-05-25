<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\SettingsResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        if ($settings) {
            return response()->json([
                'success' => true,
                'settings' => new SettingsResource($settings)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no settings'
            ], 200);
        }
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $request->validate([
            'about'     => 'required',
            'about_en'  => 'required',
            // 'contact'   => 'required',
            'terms'     => 'required',
            'terms_en'  => 'required',
            'privacy'   => 'required',
            'privacy_en'    => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'whatsapp' => 'required',
        ]);
        $data = $request->all();
        $setting->update($data);
        return response()->json([
            'success' => true,
            'message' => 'settings has been updated successfully'
        ], 200);
    }

    public function data()
    {
        Carbon::setLocale('ar');
        $users = User::where('userType', 'user')->get();
        $admins = User::where('userType', 'admin')->orWhere('userType', 'superadmin')->get();
        $cities = City::all();
        $cats = Category::where('is_special', 0)->get();
        $products = Product::where('is_special', 0)->get();
        $orders = Order::all();
        $latestProducts = Product::limit(4)->latest('id')->get();
        $latestOrders = Order::limit(4)->latest('id')->get();
        return response()->json([
            'success' => true,
            'admins' => count($admins),
            'users' => count($users),
            'cities' => count($cities),
            'products' => count($products),
            'cats' => count($cats),
            'orders' => count($orders),
            'latestProducts' => ProductsResource::collection($latestProducts),
            'latestOrders' => OrdersResource::collection($latestOrders),
        ], 200);
    }
}
