<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart', []);

        // Проверяем, есть ли товар уже в корзине
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        return view('cart.show', compact('cart'));
    }
    public function clearCart()
    {
        session()->forget('cart');

        return response()->json(['message' => 'Корзина успешно очищена!']);
    }

    function placeOrder()
    {
        return redirect()->route('orders.place');
    }
}
