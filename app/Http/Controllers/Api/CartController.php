<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartItems()
    {
        if (Auth::user()->cart) {

            $cart = Cart::where('user_id', Auth::user()->id)->first();
            $items = CartItem::where('cart_id', $cart->id)->get();

            if (count($items) > 0) {
                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();
                $count = 0;
                foreach ($items as $item) {
                    $count += $item['quantity'];
                }
                return response()->json([
                    'success' => true,
                    'subTotal' => $cart['subTotal'],
                    'total' => $cart['total'],
                    'items' => $count,
                    'products' => CartResource::collection($items)
                ], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Your cart is empty!'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Your cart is empty!'], 200);
        }
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if ($product) {
            if (Auth::user()->cart) {

                $selectedItem = CartItem::where('cart_id', Auth::user()->cart->id)->where('title', $product->title)->where('description', $product->description)->where('amount', $product->amount)->first();

                if ($selectedItem) {
                    $selectedItem->old_price += $selectedItem->old_price / $selectedItem->quantity;
                    $selectedItem->new_price += $selectedItem->new_price / $selectedItem->quantity;
                    $selectedItem->quantity += 1;
                    $selectedItem->save();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
                }

                $item['title'] = $product->title;
                $item['description'] = $product->description;
                $item['amount'] = $product->amount;
                $item['image'] = count($product->images) > 0 ? $product->images[0]->image : null;
                $item['old_price'] = $product->old_price;
                $item['new_price'] = $product->new_price;
                $item['cart_id'] = Auth::user()->cart->id;

                CartItem::create($item);

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            } else {

                $cart['user_id'] = Auth::user()->id;
                Cart::create($cart);

                $item['title'] = $product->title;
                $item['description'] = $product->description;
                $item['amount'] = $product->amount;
                $item['image'] = $product->image;
                $item['old_price'] = $product->old_price;
                $item['new_price'] = $product->new_price;
                $item['cart_id'] = Auth::user()->cart->id;

                CartItem::create($item);

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['success' => true, 'message' => 'Item Added to your cart successfully'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such product'], 200);
        }
    }

    public function addQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item) {
            if ($item->carts->user->id == Auth::user()->id) {

                $item->old_price += $item->old_price / $item->quantity;
                $item->new_price += $item->new_price / $item->quantity;
                $item->quantity += 1;
                $item->save();

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['success' => true, 'message' => 'quantity increased successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
        }
    }

    public function rmQuantity($id)
    {
        $item = CartItem::find($id);

        if ($item) {

            if ($item->carts->user->id == Auth::user()->id) {

                if ($item->quantity == 1 || $item->quantity == 0) {
                    $item->delete();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'item removed form cart successfully'
                    ], 200);
                } else {

                    $item->old_price -= $item->old_price / $item->quantity;
                    $item->new_price -= $item->new_price / $item->quantity;
                    $item->quantity -= 1;
                    $item->save();

                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    $items = CartItem::where('cart_id', $cart->id)->get();

                    $cart['subtotal'] = 0;
                    $cart['total'] = 0;
                    foreach ($items as $item) {
                        $cart['subtotal'] +=  $item['old_price'];
                        $cart['total'] +=  $item['new_price'];
                    }
                    $cart->save();

                    return response()->json(['success' => true, 'message' => 'quantity decreased successfully'], 200);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
        }
    }

    public function removeItem($id)
    {
        $item = CartItem::find($id);
        if ($item) {
            if ($item->carts->user->id == Auth::user()->id) {
                $item->delete();

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $items = CartItem::where('cart_id', $cart->id)->get();

                $cart['subtotal'] = 0;
                $cart['total'] = 0;
                foreach ($items as $item) {
                    $cart['subtotal'] +=  $item['old_price'];
                    $cart['total'] +=  $item['new_price'];
                }
                $cart->save();

                return response()->json(['success' => true, 'message' => 'item removed form cart successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'you dont have the right to do this'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'there is no such item'], 200);
        }
    }
}
