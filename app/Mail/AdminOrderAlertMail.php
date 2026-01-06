<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class AdminOrderAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('🛒 New Order Placed: #' . $this->order->id)
                    ->markdown('user.emails.admin-order-placed')
                    ->with(['order' => $this->order]);
    }
}
