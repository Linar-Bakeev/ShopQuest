<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'asc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Статус заказа успешно обновлен');
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;
        $products = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            $totalPrice += $item['price'] * $item['quantity'];
            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity']
            ];
        }

        $order = new Order([
            'user_id' => Auth::id(),
            'products' => $products,
            'total_price' => $totalPrice,
            'status' => 'Ожидает подтверждения'
        ]);

        $order->save();

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
