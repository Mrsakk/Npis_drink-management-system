<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $cartKey = 'shopping_cart';

    public function getCart(): array
    {
        return Session::get($this->cartKey, []);
    }

    public function addItem(Product $product, int $quantity = 1): array
    {
        $cart = $this->getCart();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        $this->saveCart($cart);
        return $cart;
    }

    public function updateQuantity(int $productId, int $quantity): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                unset($cart[$productId]);
            }
        }

        $this->saveCart($cart);
        return $cart;
    }

    public function removeItem(int $productId): array
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->saveCart($cart);
        return $cart;
    }

    public function clear(): void
    {
        Session::forget($this->cartKey);
    }

    public function getSubtotal(): float
    {
        $cart = $this->getCart();
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    public function getTotalItems(): int
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'];
        }

        return $total;
    }

    public function getCartItems(): array
    {
        return array_values($this->getCart());
    }

    protected function saveCart(array $cart): void
    {
        Session::put($this->cartKey, $cart);
    }
}