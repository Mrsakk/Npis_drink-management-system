<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $cartService;
    protected $telegramService;

    public function __construct(CartService $cartService, TelegramService $telegramService)
    {
        $this->cartService = $cartService;
        $this->telegramService = $telegramService;
    }

    public function placeOrder(StoreOrderRequest $request)
    {
        $cartItems = $this->cartService->getCartItems();
        
        if (empty($cartItems)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        $subtotal = $this->cartService->getSubtotal();
        $total = $subtotal;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => Order::generateOrderNumber(),
            'student_name' => $request->student_name,
            'building' => $request->building,
            'room_number' => $request->room_number,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method ?? 'cash',
            'status' => 'pending',
            'subtotal' => $subtotal,
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        $this->telegramService->sendOrderNotification($order);
        $this->cartService->clear();

        return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if (Auth::id() !== $order->user_id && !Auth::user()->isAdmin()) {
            return redirect()->route('home');
        }

        return view('store.order-success', compact('order'));
    }
}