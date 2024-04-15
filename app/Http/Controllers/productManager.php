<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productManager extends Controller
{
    public function index()
    {
        $perPage = request()->input('perPage', 3); // По умолчанию показывать 3 элемента на странице
        $userId = auth()->id();

        if (auth()->check() && auth()->user()->is_admin) {
            $products = Product::paginate(5);
            return view('admin.products.index', compact('products'));
        } elseif (auth()->check() && auth()->user()->is_seller) {
            $products = Product::where('user_id', $userId)->paginate($perPage); // Используем полученное значение perPage
            return view('controlViews.index', compact('products'));
        } else {
            $products = Product::where('user_id', $userId)->paginate($perPage); // Используем полученное значение perPage
            return view('welcome', compact('products'));
        }
    }


    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Для создания товара необходимо войти в систему.');
        }

        if (auth()->user()->is_admin) {
            $sellers = User::where('is_seller', true)->get();
            return view('admin.products.create', compact('sellers'));
        } elseif (auth()->user()->is_seller) {
            $sellers = auth()->user();
            return view('controlViews.create');
        } else {
            return redirect()->route('main')->with('error', 'У вас нет прав на создание товара.');
        }
    }


    public function edit(Product $product)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return view('admin.products.edit', compact('product'));
        } elseif (auth()->check() && auth()->user()->is_seller) {
            if ($product->user_id === auth()->id()) {
                return view('controlViews.edit', compact('product'));
            } else {
                return redirect()->route('main')->with('error', 'У вас нет доступа к этому товару.');
            }
        } else {
            return redirect()->route('main');
        }
    }

    public function sellerIndex()
    {
        $perPage = request()->input('perPage', 3);
        $userId = auth()->id();
        $products = Product::where('user_id', $userId)->paginate($perPage);
        return view('controlViews.index', compact('products'));
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('controlViews.index')->with('success', 'Товар был удалён');
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->except(['image']));

        if ($request->hasFile('image')) {
            if ($product->images()->exists()) {
                $product->images->each(function($image) {
                    Storage::delete($image->path);
                    $image->delete();
                });
            }

            $path = $request->file('image')->store('public/images');
            $product->images()->create(['url' => Storage::url($path)]);
        }
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.products.index')->with('success', 'Товар успешно обновлен.');
        } elseif (auth()->check() && auth()->user()->is_seller) {
            return redirect()->route('products.index')->with('success', 'Товар успешно обновлен.');
        } else {
            return redirect()->route('/')->withErrors("Не удалось обновить товар");
        }
    }

    public function show(Product $product)
    {
        return view('product', compact('product'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seller_id' => 'required|exists:users,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->user_id = $request->seller_id;

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен.');
    }

    protected function handleProductImages(Request $request, Product $product)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $product->images()->create(['url' => Storage::url($path)]);
            }
        }

        if ($request->has('image_urls')) {
            foreach ($request->image_urls as $imageUrl) {
                if (!empty($imageUrl)) {
                    $product->images()->create(['url' => $imageUrl]);
                }
            }
        }
    }
}
