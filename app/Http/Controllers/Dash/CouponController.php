<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return CouponResource::collection($coupons);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(Coupon::validationRules());
        $coupon = Coupon::create($validatedData);
        return response()->json(new CouponResource($coupon), 201);
    }

    public function show($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }

        return response()->json(new CouponResource($coupon));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }
        $validatedData = $request->validate(Coupon::validationRules($coupon));
        $coupon->update($validatedData);
        return response()->json(new CouponResource($coupon));
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found'], 404);
        }

        $coupon->delete();

        return response()->json(['message' => 'Coupon deleted']);
    }

    public function searchByCode(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        $now = Carbon::now();
        $code = $request['code'];
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found.'], 404);
        }

        if ($now < $coupon->start_date || $now > $coupon->end_date) {
            return response()->json(['error' => 'Coupon is not valid at this time.'], 400);
        }

        return response()->json(['discount_percentage' => $coupon->discount_percentage]);
    }
}
