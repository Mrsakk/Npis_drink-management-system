<?php

namespace App\Services;

use App\Models\Order;
use App\Models\TelegramNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected string $botToken;

    protected string $chatId;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN'));
        $this->chatId = config('services.telegram.chat_id', env('TELEGRAM_CHAT_ID'));
    }

    public function sendOrderNotification(Order $order): bool
    {
        $message = $this->formatOrderMessage($order);

        $telegramNotification = TelegramNotification::create([
            'order_id' => $order->id,
            'type' => 'telegram',
            'message' => $message,
            'recipient' => $this->chatId,
            'is_sent' => false,
        ]);

        if (empty($this->botToken) || empty($this->chatId)) {
            $telegramNotification->update(['response' => 'Bot token or chat ID not configured']);
            Log::warning('Telegram notification skipped: Bot token or chat ID not configured');

            return false;
        }

        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id' => $this->chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);

            $responseData = $response->json();
            $telegramNotification->update([
                'is_sent' => $response->successful(),
                'response' => json_encode($responseData),
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            $telegramNotification->update(['response' => $e->getMessage()]);
            Log::error('Telegram notification failed: '.$e->getMessage());

            return false;
        }
    }

    protected function formatOrderMessage(Order $order): string
    {
        $itemsList = [];
        foreach ($order->items as $item) {
            $itemsList[] = "📦 <b>{$item->product_name}</b>\n   └─ <code>Qty: {$item->quantity}</code> | ៛" . number_format($item->subtotal, 2);
        }
        $itemsText = implode("\n", $itemsList);

        $message = "🚨 <b>NEW ORDER DETECTED</b> 🚨\n";
        $message .= "─────────────────────\n";
        $message .= "🔢 <b>ORDER:</b> <code>#{$order->order_number}</code>\n";
        $message .= "👤 <b>Name:</b> {$order->student_name}\n";
        $message .= "📍 <b>Location Building: </b><code>{$order->building}</code> | Room: <b>{$order->room_number}</b>\n";
        $message .= "📞 <b>Phone:</b> <code>{$order->phone}</code>\n";
        $message .= "─────────────────────\n";
        $message .= "🛒 <b>RESOURCE LIST:</b>\n{$itemsText}\n";
        $message .= "─────────────────────\n";
        $message .= "💰 <b>TOTAL VALUE:</b> <b>៛" . number_format($order->total, 2) . "</b>\n";
        
        if ($order->payment_method) {
             $message .= "💳 <b>PAYMENT:</b> <code>" . strtoupper(str_replace('_', ' ', $order->payment_method)) . "</code>\n";
        }

        if ($order->notes) {
            $message .= "\n📝 <b>BRIEFING:</b> <i>{$order->notes}</i>\n";
        }
        
        $message .= "\n⚡ <i>Awaiting Operational Response...</i>";
        $message .= "\n<b><i>Thank you for using our service!</i></b>";


        return $message;
    }
}
