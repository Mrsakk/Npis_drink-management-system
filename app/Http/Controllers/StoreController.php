<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $featuredProducts = Product::active()->with('category')->take(12)->get();
        $categories = Category::active()->with('products')->get();

        return view('store.home', compact('featuredProducts', 'categories'));
    }

    public function shop(Request $request)
    {
        $query = Product::active()->with('category');

        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->orderBy('name')->paginate(12);
        $categories = Category::active()->get();

        return view('store.shop', compact('products', 'categories'));
    }

    public function categories()
    {
        $categories = Category::active()->with('products')->get();

        return view('store.categories', compact('categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->active()->paginate(12);

        return view('store.category', compact('category', 'products'));
    }

    public function cart()
    {
        $cartItems = $this->cartService->getCartItems();
        $subtotal = $this->cartService->getSubtotal();

        return view('store.cart', compact('cartItems', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        $this->cartService->addItem($product, $quantity);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request)
    {
        $this->cartService->updateQuantity($request->product_id, $request->quantity);

        return redirect()->route('cart')->with('success', 'Cart updated!');
    }

    public function removeFromCart(Request $request)
    {
        $this->cartService->removeItem($request->product_id);

        return redirect()->route('cart')->with('success', 'Item removed from cart!');
    }

    public function checkout()
    {
        $cartItems = $this->cartService->getCartItems();

        if (empty($cartItems)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        $subtotal = $this->cartService->getSubtotal();
        $user = Auth::user();

        return view('store.checkout', compact('cartItems', 'subtotal', 'user'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->with('items')->orderBy('created_at', 'desc')->paginate(10);

        return view('store.orders', compact('orders'));
    }

    public function about()
    {
        return view('store.about');
    }

    public function cartCount()
    {
        return response()->json([
            'count' => $this->cartService->getTotalItems(),
        ]);
    }
}
