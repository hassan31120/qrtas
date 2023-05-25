<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::where('is_special', 0)->paginate(10);
        if (count($products) > 0) {
            return ProductsResource::collection($products);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such products'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'title_en' => 'required',
            'description' => 'required',
            'description_en' => 'required',
            'amount' => 'required',
            'new_price' => 'required|numeric',
            'old_price' => ['nullable', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($value !== null && $value != 0 && $value < $request->input('new_price')) {
                    $fail('حقل السعر القديم يجب أن يكون أكبر من السعر الجديد أو يساوي الصفر.');
                }
            },],
            'sub_id' => 'required',
        ]);

        $data = $request->all();
        $product = Product::create($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $file = $image;
                $path = 'storage/products/' . date('Y') . '/' . date('m') . '/';
                $name = $path . time() . '-' . $file->getClientOriginalName();
                $file->move($path, $name);
                Product_Image::create([
                    'product_id' => $product->id,
                    'image' => $name
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'product has been added successfully'
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'success' => true,
                'product' => new ProductsResource($product)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such product'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $request->validate([
                'title' => 'required',
                'title_en' => 'required',
                'description' => 'required',
                'description_en' => 'required',
                'amount' => 'required',
                'new_price' => 'required|numeric',
                'old_price' => ['nullable', 'numeric', function ($attribute, $value, $fail) use ($request) {
                    if ($value !== null && $value != 0 && $value < $request->input('new_price')) {
                        $fail('حقل السعر القديم يجب أن يكون أكبر من السعر الجديد أو يساوي الصفر.');
                    }
                },],
                'sub_id' => 'required',
            ]);

            $data = $request->all();

            $product->update($data);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $file = $image;
                    $path = 'storage/products/' . date('Y') . '/' . date('m') . '/';
                    $name = $path . time() . '-' . $file->getClientOriginalName();
                    $file->move($path, $name);
                    Product_Image::create([
                        'product_id' => $product->id,
                        'image' => $name
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'product has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such product'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'product has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such product'
            ], 404);
        }
    }

    public function delImage($id)
    {
        $product = Product_Image::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'product has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such product'
            ], 404);
        }
    }

    public function subProducts($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $products = Product::where('sub_id', $sub->id)->paginate(10);
            return ProductsResource::collection($products);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such subcategory'
            ], 404);
        }
    }

    public function catProducts($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $subs = SubCategory::where('cat_id', $cat->id)->get();
            if (count($subs) > 0) {
                $products = collect();
                foreach ($subs as $sub) {
                    $subProducts = Product::where('sub_id', $sub->id)->get();
                    $products = $products->merge($subProducts);
                }
                return response()->json([
                    'success' => true,
                    'products' => ProductsResource::collection($products)
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'there is no such subcategories or products in this category'
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such category'
            ], 404);
        }
    }
}
