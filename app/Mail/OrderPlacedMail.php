<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        // Log when the mailable is constructed
        Log::info('📦 OrderPlacedMail constructed for order ID: ' . $order->id);
    }

    public function build()
    {
        try {
            Log::info('🛠 Building OrderPlacedMail for order ID: ' . $this->order->id);

            $mail = $this->subject('Your Order #' . $this->order->id . ' has been placed successfully!')
                ->markdown('user.emails.order-placed')
                ->with(['order' => $this->order]);

            Log::info('✅ OrderPlacedMail built successfully for order ID: ' . $this->order->id);

            return $mail;
        } catch (\Throwable $e) {
            Log::error('❌ Error building OrderPlacedMail: ' . $e->getMessage());
            throw $e;
        }
    }
}
