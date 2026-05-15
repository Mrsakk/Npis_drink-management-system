<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'type', 'message', 'recipient', 'is_sent', 'response'
    ];

    protected $casts = [
        'is_sent' => 'boolean',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}