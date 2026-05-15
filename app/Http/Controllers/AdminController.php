<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $todayOrders = Order::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact(
            'pendingOrders',
            'totalOrders',
            'totalRevenue',
            'todayOrders'
        ));
    }

    public function orders(Request $request)
    {
        $query = Order::with('items', 'user');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('order_number', 'like', '%'.$request->search.'%')
                ->orWhere('student_name', 'like', '%'.$request->search.'%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load('items', 'user');

        return view('admin.order-show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated!',
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated!');
    }

    public function products(Request $request)
    {
        $query = Product::with('category');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->orderBy('name')->paginate(20);
        $categories = Category::active()->get();

        return view('admin.products', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::active()->get();

        return view('admin.product-form', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $slug = Str::slug($request->name);

        $data['slug'] = Product::where('slug', $slug)
            ->exists() ? $slug.'-'.time() : $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product created!',
                'redirect' => route('admin.products'),
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product created!');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::active()->get();

        return view('admin.product-form', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $slug = Str::slug($request->name);

        $data['slug'] = Product::where('slug', $slug)
            ->where('id', '!=', $product->id)
            ->exists() ? $slug.'-'.time() : $slug;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } elseif ($request->remove_image ?? false) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
                $data['image'] = null;
            }
        }

        $product->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product updated!',
                'redirect' => route('admin.products'),
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted!',
            ]);
        }

        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }

    public function categories(Request $request)
    {
        $query = Category::query();

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $categories = $query->orderBy('sort_order')->paginate(20);

        return view('admin.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.category-form');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created!',
                'redirect' => route('admin.categories'),
            ]);
        }

        return redirect()->route('admin.categories')->with('success', 'Category created!');
    }

    public function editCategory(Category $category)
    {
        return view('admin.category-form', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        } elseif ($request->remove_image ?? false) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
                $data['image'] = null;
            }
        }

        $category->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category updated!',
                'redirect' => route('admin.categories'),
            ]);
        }

        return redirect()->route('admin.categories')->with('success', 'Category updated!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category deleted!',
            ]);
        }

        return redirect()->route('admin.categories')->with('success', 'Category deleted!');
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
        }

        $users = $query->orderBy('name')->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function telegramBroadcast()
    {
        return view('admin.telegram');
    }

    public function sendTelegramBroadcast(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $botToken = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN'));
        $chatId = config('services.telegram.chat_id', env('TELEGRAM_CHAT_ID'));

        if (empty($botToken) || empty($chatId)) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Telegram not configured!']);
            }

            return redirect()->back()->with('error', 'Telegram not configured!');
        }

        try {
            Http::withOptions(['verify' => false])
                ->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $request->message,
                    'parse_mode' => 'HTML',
                ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Broadcast sent successfully!',
                ]);
            }

            return redirect()->back()->with('success', 'Broadcast sent successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed: '.$e->getMessage()]);
            }

            return redirect()->back()->with('error', 'Failed: '.$e->getMessage());
        }
    }
}
