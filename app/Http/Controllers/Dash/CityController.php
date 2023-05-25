<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Octw\Aramex\Aramex;

class CityController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ar');
        $cities = City::paginate(10);
        if (count($cities) > 0) {
            return CitiesResource::collection($cities);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such cities'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
            'price' => 'required|numeric'
        ]);

        $data = $request->all();

        City::create($data);

        return response()->json([
            'success' => true,
            'message' => 'city has been added successfully'
        ], 200);
    }

    public function show($id)
    {
        $city = City::find($id);
        if ($city) {
            return response()->json([
                'success' => true,
                'city' => new CitiesResource($city)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such city'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);
        if ($city) {
            $request->validate([
                'name' => 'required',
                'name_en' => 'required',
                'price' => 'required|numeric'
            ]);
            $data = $request->all();
            $city->update($data);
            return response()->json([
                'success' => true,
                'message' => 'city has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such city'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $city = City::find($id);
        if ($city) {
            $city->delete();
            return response()->json([
                'success' => true,
                'message' => 'city has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such city'
            ], 404);
        }
    }

    public function fetchAramexCities(){
        $cities = Aramex::fetchCities('SA');
        if (! $cities) {
            return response()->json([
                'success' => false,
                'message' => 'there is an error with aramex services'
            ], 404);
        }
        return $cities;
    }
}
